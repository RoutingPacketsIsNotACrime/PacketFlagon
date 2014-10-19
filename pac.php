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

header("Content-Type: application/x-ns-proxy-autoconfig"); 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Thu, 23 Sep 2013 00:00:01 GMT");
header('X-Fuck-You-Censors: Wanna play a game of whack a mole?');

?>function FindProxyForURL(url, host) 
{    
<?php
	require('./db.php');	

    
    $Hash = mysql_real_escape_string($_GET['hash']);

    $Query = "select * from pac where hash = '$Hash'";
    $result = mysql_query($Query);
    $PAC = mysql_fetch_assoc($result);
    $details = unserialize($PAC['urls']);

    if(empty($details))
    {
        $details = array('wtfismyip.com');
    }

    $String = "";
    foreach($details as $Element)
    {
    	$String .= '"'.strtolower($Element).'"' . ',';
    }
    $String = substr($String,0,strlen($String) - 1);
    print("var list = new Array($String);\n\n");

    if(isset($_GET['proxy']))
    {
        $Proxy = $_GET['proxy'];
    }
    else
    {
	if($PAC['tor'] == 1)
    	{
        	$Proxy = "localhost";
    	}
	else
	{
		$rand = rand ( 0, 8);
		if($rand < 1)
		{
        		$Proxy = 'proxy-1-1.routingpacketsisnotacrime.uk';
		}
		else
		{
			$Proxy = 'proxy-1-2.routingpacketsisnotacrime.uk';
		}
	}
    }

    if(isset($_GET['port']))
    {
        $Port = $_GET['port'];
    }
    else
    {
	if($PAC['tor'] == 1)
    	{
        	$Port = 9050;
    	}
	else
	{
        	$Port = '8080';
	}
    }

    if(isset($_GET['type']))
    {
        $Type = $_GET['type'];
    }
    else
    {
	if($PAC['tor'] == 1)
    	{
		$Type = "SOCKS";
    	}
	else
	{
        	$Type = 'PROXY';
	}
    }
?>
    for(var i=0; i < list.length; i++)
    {
        if (shExpMatch(host, list[i]))
        {
           return "<?php echo $Type; ?> <?php echo $Proxy; ?>:<?php echo $Port; ?>";
        }
    }
    return "DIRECT";
}

