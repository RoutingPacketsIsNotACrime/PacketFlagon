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


$Hash = mysql_real_escape_string($_GET['hash']);


$API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
$PACDetails = $API->GetPACDetails($Hash);

if($PACDetails['success'] == 'fail')
{
    $smarty->assign('ERROR_TITLE','Error:');
    $smarty->assign('ERROR_TEXT','A problem was encountered fetching the PAC details:<br/>' . $PACDetails['message']);
    $smarty->assign('ERROR',$smarty->fetch('view_error.tpl'));
}
else
{
    $Description = $PACDetails['description'];
    $FriendlyName = $PACDetails['friendlyname'];
    $Tor = $PACDetails['localproxy'];
    $Ro = $PACDetails['ro'];
    $URLs = $PACDetails['urls'];
}


if(empty($Description))
        {
                $MetaDesc = "Details about $Hash";
        }
        else
        {
                $MetaDesc = $Description . "( $Hash )";
        }

        if(empty($FriendlyName))
        {
                $FriendlyName = "Custom PAC: $Hash";
        }

        if($Tor)
        {
                $TorIcon = 'fa-check-square-o';
                $ProxyIcon = 'fa-square-o';
        }
        else
        {
                $TorIcon = 'fa-square-o';
                $ProxyIcon = 'fa-check-square-o';
        }

        if($Ro)
        {
                $RoIcon = 'fa-check-square-o';
        }
        else
        {
                $RoIcon = 'fa-square-o';
        }


$SectionURLs = array();

foreach($URLs as $ID => $URL)
{
        $blocked = 'fa-arrows-h" style="color:green';
        $ToolTip = 'Not detected as blocked by blocked.org.uk';

        if($memcache->get($URL) == "blocked")
        {
                $blocked = 'fa-warning" style="color:red"';
                $ToolTip = 'Detected as blocked by at least 1 ISP by blocked.org.uk';
        }

        $SectionURLs[] = array('id' => $ID, 'url' => $URL, 'tooltip' => $ToolTip, 'blocked' => $Blocked);
}


$smarty->assign('HASH',$Hash);
$smarty->assign('FRIENDLYNAME',$FriendlyName);
$smarty->assign('DESCRIPTION',$Description);
$smarty->assign('METADESC', $MetaDesc);
$smarty->assign('TORICON',$TorIcon);
$smarty->assign('PROXYICON',$ProxyIcon);
$smarty->assign('ROICON',$RoIcon);
$smarty->assign('URLS',$SectionURLs);

$smarty->display('view.tpl');
?>
