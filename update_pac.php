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
