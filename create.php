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

require_once('libs/Smarty.class.php');
require_once('libs/config.php');
require_once('libs/api.php');

//Initialize the template engine
$smarty = new Smarty();

$smarty->assign('FQDN',$FQDN);
$smarty->assign('TITLE',$ShardName);
$smarty->assign('PROTO',($ForceHTTPS ? 'https' : 'http'));
$smarty->assign('CREDIT',(empty($Credit) ? 'Anonymous' : $Credit));


if(isset($_GET['hash']) && !empty($_GET['hash']))
{
        $Hash = mysql_real_escape_string($_GET['hash']);

        $API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
        $PAC = $API->GetPACDetails($Hash);

        if($PAC['success'] == 'fail')
        {
            $smarty->assign('ERROR_TITLE','Error:');
            $smarty->assign('ERROR_TEXT','Clone attempt failed due to ' . $PAC['message']);
            $smarty->assign('ERROR',$smarty->fetch('view_error.tpl'));
        }
        else
        {
            $FriendlyName = $PAC['friendlyname'];
            $Description = $PAC['description'];
            $URLArray = $PAC['urls'];
            $URLs = "";

            foreach($URLArray as $URL)
            {
                $URLs .= $URL . ", ";
            }

            $URLs = substr($URLs,0,strlen($URLs) - 2);

            $Tor = $PAC['localproxy'];

            $smarty->assign('URLS',$URLs);
            $smarty->assign('FRIENDLYNAME',$FriendlyName);
            $smarty->assign('DESCRIPTION',$Description);
            $smarty->assign('TOR',$Tor);
        }
}

$smarty->display('create.tpl');
?>
