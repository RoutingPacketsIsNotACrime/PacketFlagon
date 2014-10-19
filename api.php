<?php
    /*
    * Copyright (C) 2014 - Gareth Llewellyn
    *
    * This file is part of PacketFlagon - https://PacketFlagon.is
    *
    * This program is free software: you can redistribute it and/or modify it
    * under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 3 of the License, or
    * (at your option) any later version.
    *
    * This program is distributed in the hope that it will be useful, but WITHOUT
    * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
    * FOR A PARTICULAR PURPOSE. See the GNU General Public License
    * for more details.
    *
    * You should have received a copy of the GNU General Public License along with
    * this program. If not, see <http://www.gnu.org/licenses/>
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
    $RL = $memcache->get('RL-'.$_POST['api'].'-'.$_SERVER['REMOTE_ADDR']);
    if($RL == false)
    {
        $RL = 0;
    }
    $RL++;
    $memcache->set('RL-'$_POST['api'],$RL,0,15);
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

                case "register_shard":
                {
                    //We have to allow CORS for the javascript based auto-register script in setup.tpl
                    header("Access-Control-Allow-Origin: *");

                    $FQDN = mysql_real_escape_string($_POST['fqdn']);
                    $Contact = mysql_real_escape_string($_POST['contact']);

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
                            $Return['success'] = true;
                            $Return['apikey'] = $APIKey;
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
                    $PAC = $API->GetPACDetails($Hash);
                }
                break;
    
                case "update_pac":
                {
                    //Doesn't exist yet
                }
                break;

                case "push_to_s3":
                {
                    $S3Result = $API->PushToS3($Hash);
                }
                break;

                case "proxy_meta":
                {
                    $meta = $API->GetProxyMeta();
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
