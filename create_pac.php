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

    require_once('libs/Smarty.class.php');
    require_once('libs/config.php');
    require_once('libs/api.php');

	$return = array();

	$return['success'] = "ok";
	$return['hash'] = "ABCDEFG";
	$return['message'] = 'Awesome!';

	$MD5 = md5($_SERVER['REMOTE_ADDR'] . date('Y-m-d His'));

	$Name = htmlentities(mysql_real_escape_string($_POST['name']));
	$Desc = htmlentities(mysql_real_escape_string($_POST['desc']));
	$Password = "";
	$URLs = array();
	$UseTor = htmlentities(mysql_real_escape_string($_POST['use_tor_proxy']));
	$Ro = 0;

	if($UseTor == "yes")
	{
		$UseTor = 1;
	}
	else
	{
		$UseTor = 0;
	}

	if(empty($_POST['password']))
	{
		$Password = "";
		$Ro = 0;
	}
	else
	{
		$Password = md5($_POST['password']);
		$Ro = 1;
	}

	$URLsArray = explode(",", $_POST['urls']);

	foreach($URLsArray as $URL)
	{
                $urlMeta = getHost($URL);
                if(!empty($urlMeta))
                {
                        $URLs[] = strtolower($urlMeta);
                }
	}

	if(empty($URLs))
	{
        $return['success'] = "fail";
        $return['hash'] = "";
        $return['message'] = 'No URLs were recognised, please ensure all URLs are separated with a comma ( , )';
		
	}
	else
	{
		$URLs = serialize($URLs);

        if($ProxyShard)
        {
            $API = new API($PacketFlagonAPIKey,$FQDN);

            $return = $API->CreatePAC($Name,$Desc,$Password,$URLs,$UseTor);
        }
        else
        {
		    $Query = "insert into pac (hash,name,description,password,ro,urls,tor) VALUES ('$MD5', '$Name','$Desc','$Password',$Ro,'$URLs',$UseTor)";
		    $result = mysql_query($Query);	

		    if(mysql_errno() == 0)
		    {
			    $return['hash'] = $MD5;
			    $return['message'] = "Success!";
		    }
		    else
		    {
			    $return['hash'] = "";
			    $return['success'] = "fail";
			    $return['message'] = mysql_error();
		    }
        }
	}

	print(json_encode($return));
?>
