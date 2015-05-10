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

    require_once('libs/config.php');
    require_once('libs/api.php');

    $return = array();
    $return['success'] = "ok";
    $return['hash'] = "ABCDEFG";
    $return['message'] = 'Awesome!';

	$Purpose = $_POST['update'];
	$Hash = mysql_real_escape_string($_POST['hash']);
	$Password = "";

    $API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);

	if(empty($_POST['password']))
    {
        $Password = "";
    }
    else
    {
        $Password = md5($_POST['password']);
    }

	if($Purpose == "remove_url")
	{
        $URL = $_POST['url'];
        $return = $API->RemoveURLFromPAC($_POST['urls'],$Hash,$Password);

		/*$URL = $_POST['url'];
		$Query = "select urls from pac where hash = '$Hash' AND password = '$Password'";
		$result = mysql_query($Query);

		if(mysql_num_rows($result) == 0)
		{
			$return['success'] = "fail";
		        unset($return['hash']);
        		$return['message'] = 'Password does not match';			
		}
		else
		{
	        	$PAC = mysql_fetch_assoc($result);
        		$URLs = unserialize($PAC['urls']);

			foreach($URLs as $ID => $dbURL)
			{
				if($URL == $dbURL)
				{
					unset($URLs[$ID]);
					break;
				}
			}

			sort($URLs);

			$URLs = serialize($URLs);

			$Query = "update pac set urls = '$URLs' where hash = '$Hash' AND password = '$Password'";
			$result = mysql_query($Query);
		
			if(mysql_errno() == 0)
			{
				$return['hash'] = $Hash;
			}
			else
			{
				$return['success'] = "fail";
	        		unset($return['hash']);
		        	$return['message'] = mysql_error();
			}
		}*/

	}
	else if($Purpose == "add_url")
	{
        $return = $API->AddURLToPAC($_POST['urls'],$Hash,$Password);

		/*$URL = $_POST['url'];
                $Query = "select urls from pac where hash = '$Hash' AND password = '$Password'";
                $result = mysql_query($Query);

                if(mysql_num_rows($result) == 0)
                {
                        $return['success'] = "fail";
                        unset($return['hash']);
                        $return['message'] = 'Password does not match';
                }
                else
                {
			$PAC = mysql_fetch_assoc($result);
                        $URLs = unserialize($PAC['urls']);
			$URLsArray = explode(",", $_POST['urls']);

        		foreach($URLsArray as $URL)
        		{
                		$urlMeta = getHost($URL);
                		if(!empty($urlMeta))
                		{
                        		$URLs[] = $urlMeta;
                		}
			}
			sort($URLs);

			$URLs = serialize($URLs);
			$Query = "update pac set urls = '$URLs' where hash = '$Hash' and password = '$Password'";
                        $result = mysql_query($Query);

                        if(mysql_errno() == 0)
                        {
                                $return['hash'] = $Hash;
                        }
                        else
                        {
                                $return['success'] = "fail";
                                unset($return['hash']);
                                $return['message'] = mysql_error();
                        }
		}*/
	}
	else
	{
        $return['success'] = "fail";
        unset($return['hash']);
        $return['message'] = "Unrecognised method";
	}


	print(json_encode($return));
