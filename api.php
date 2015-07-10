<?php
    /*
        Copyright (c) 2015, Brass Horn Communications
        All rights reserved.

        Redistribution and use in source and binary forms, with or without
        modification, are permitted provided that the following conditions are met:

        * Redistributions of source code must retain the above copyright notice, this
          list of conditions and the following disclaimer.

        * Redistributions in binary form must reproduce the above copyright notice,
          this list of conditions and the following disclaimer in the documentation
          and/or other materials provided with the distribution.

        * Neither the name of PacketFlagon nor the names of its
          contributors may be used to endorse or promote products derived from
          this software without specific prior written permission.

        THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
        AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
        IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
        DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
        FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
        DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
        SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
        CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
        OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
        OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
    */

//Fuck censorship
header('X-Fuck-You-Censors: Wanna play a game of whack a mole?');
header('Content-Type: application/json');

require_once('libs/config.php');
require_once('libs/api.php');

$Action = strtolower($_GET['action']);

$Return = array('success' => false);


if($ProxyShard)
{
    $Return['msg'] = "This server is a sharded end point and doesn't serve API requests";
    print(json_encode($Return));
    return;
}

$API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);

//Rate Limiting
if($Action == 'create' || $Action == 'create_pac' || $Action == 'push_to_s3' || $Action == 'add_url_to_pac' || $Action == 'remove_url_from_pac')
{
    $APIKey = $_POST['api'];

    if(empty($APIKey))
	$APIKey = "-";

    $RL = $memcache->get('RL-'.$_POST['api'].'-'.$_SERVER['REMOTE_ADDR']);
    if($RL == false)
    {
        $RL = 0;
    }
    $RL++;
    $memcache->set('RL-'.$_POST['api'],$RL,0,15);
    if($RL > 15)
    {
        $Return['msg'] = "This server is performing too many requests and has been limited";
        print(json_encode($Return));
        return;
    }
}


//Do authentication
$Auth = false;
switch($Action)
{
    case "acl":
    {
        $Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],'acl');
    }
    break;

    case "bw":
    {
        $Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],'bw');
    }
    break;

    case "create_pac":
    {
        $Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],$_POST['urls']);
    }
    break;

    case "get_pac":
    {
        $Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],$_POST['hash']);
    }
    break;

    case "push_to_s3":
    {
        $Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],$_POST['hash']);
    }
    break;

    case "proxy_meta":
    {
        $Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],date('d M H:i'));
    }
    break;

    case "add_url_to_pac":
    {
        //$Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],date('d M H:i'));
    }
    break;

    case "remove_url_from_pac":
    {
        //$Auth = $API->ConfirmAuth($_POST['auth'],$_POST['api'],date('d M H:i'));
    }
    break;

    case "create":
    {
        //There is no auth here
        $Auth = true;
    }
    break;

    default:
    {
        $Auth = false;
    }
    break;
}

//Lets check the auth result
if($Auth != true)
{
        $Return['error_code'] = 403;
        $Return['msg'] = "Authentication failed";
}
else
{
        switch($Action)
        {
                case "acl":
                {
                        $Query = "select * from pac";
                        $result = mysql_query($Query);

                        $URLs = array();
                        while($PAC = mysql_fetch_assoc($result))
                        {
                                $details = unserialize($PAC['urls']);

                                foreach($details as $ID => $URL)
                                {
                                        $URLs[strtolower($URL)] += 1;
                                }
                        }

                        arsort($URLs);
                        foreach($URLs as $URL => $Count)
                        {
                                /*if(stristr($URL,"www") !== false)
                                  {
                                  print($URL ."\n");
                                  }
                                  else
                                  {
                                  print('.'.$URL ."\n");
                                  }*/
                                print($URL ."\n");
                        }
                        //We're very naughty and breaking out early
                        return;

                }
                break;

                case "bw":
                {
                        $bw = explode(",",$_GET['bw']);
                        $total = 0;
                        foreach($bw as $bandwidth)
                        {
                                $total += $bandwidth;
                        }

                        $total = ($total / count($bw));
                        $memcache->set($_GET['host'],$total);

                        $Return['success'] = true;
                        $Return['bw'] = $total;
                }
                break;

		case "create":
                case "register_shard":
                {
                    //We have to allow CORS for the javascript based auto-register script in setup.tpl
                    header("Access-Control-Allow-Origin: *");

		    $jsonPOST = json_decode(file_get_contents('php://input'),true);
                    $FQDN = mysql_real_escape_string($_POST['fqdn']);
                    $Contact = mysql_real_escape_string($_POST['contact']);

		    //print_r($jsonPOST);

		    if(empty($FQDN) || $FQDN == "")
			$FQDN = mysql_real_escape_string($jsonPOST['domain']);

		   if(empty($Contact) || $Contact == "")
                        $Contact = mysql_real_escape_string($jsonPOST['contact']);

                    if(empty($FQDN) || empty($Contact))
                    {
                        header('HTTP/1.0 400 Bad Request');
                        $Return['message'] = 'A valid create request must contact a FQDN and a contact payload (even if it is fake)';
                    }
                    else
                    {
                        $APIKey = $API->RegisterShard($FQDN,$Contact);
                        if($APIKey['success'] !== false)
                        {
                            //$Return['success'] = true;
                            //$Return['apikey'] = $APIKey;
			    $Return = $APIKey;
                        }    
                        else
                        {
                            $Return['success'] = false;
                            $Return['message'] = $APIKey['message'];
                        }
                    }
                }
                break;

                case "create_pac":
                {
                    //Doesn't exist yet
                }
                break;
            
                case "get_pac":
                {
                    $PAC = $API->GetPACDetails($_POST['hash']);
		    $Return = $PAC;
		    $Return['success'] = true;
                }
                break;
    
                case "update_pac":
                {
                    //Doesn't exist yet
                }
                break;

                case "push_to_s3":
                {
                    $S3Result = $API->PushToS3($_POST['hash']);
                }
                break;

                case "proxy_meta":
                {
                    $Return = $API->GetProxyMeta();
                }
                break;

                case "add_url_to_pac":
                {
                    $Return = $API->AddURLToPAC($_POST['url'],$_POST['hash'],$_POST['password']);
                }
                break;

                case "remove_url_from_pac":
                {
                    $Return = $API->RemoveURLFromPAC($_POST['url'],$_POST['hash'],$_POST['password']);
                }
                break;

                default:
                {
                    header('HTTP/1.0 400 Bad Request');    
                    $Return['success'] = false;
                    $Return['message'] = 'There is no API action called ' . htmlentities($Action);
                }
                break; 
        }
}


print_r(json_encode($Return));
