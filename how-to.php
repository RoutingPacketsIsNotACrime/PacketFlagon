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

	//Initialize the template engine
	$smarty = new Smarty();

    $smarty->assign('FQDN',$FQDN);
    $smarty->assign('TITLE',$ShardName);
    $smarty->assign('PROTO',($ForceHTTPS ? 'https' : 'http'));
    $smarty->assign('CREDIT',(empty($Credit) ? 'Anonymous' : $Credit));

    
    if( $_GET['page'] == "configure-chrome" ||
        $_GET['page'] == "configure-firefox" ||
        $_GET['page'] == "configure-safari" ||
        $_GET['page'] == "configure-internet-explorer" ||
        $_GET['page'] == "create-tor-proxy")
    {
        $smarty->display($_GET['page'].'.tpl');
    }
    else if ($_GET['page'] == 'find-pac-frontends' ||
             $_GET['page'] == 'create-shard' ||
             $_GET['page'] == 'create-socks5-proxy')
    {
        $SUBTITLE = "";
        $INTRO = "";

        switch($_GET['page'])
        {
            case 'find-pac-frontends':
            {
                $SUBTITLE = 'Find Other ProxyShards (PAC serving front-ends)';
                $INTRO = '<span>Block one and another rises in its place</span><br/>If a domain is found to be blocked another is automatically registered and a new ProxyShard is created.<br/>Here\'s how to find them!';
                
                $smarty->assign('CONTENT', $smarty->fetch('howto-alternate-frontends.tpl'));
            }
            break;

            case 'create-shard':
            {
                $SUBTITLE = 'Create your own PacketFlagon ProxyShard';
                $INTRO = '<span>ProxyShards are leaf nodes</span> that use the central <span class="hue">PacketFlagon API</span> to manage, store &amp; serve PAC files on alternate domains to frustrate ISP blocking';
                $smarty->assign('CONTENT', $smarty->fetch('howto-create-shard.tpl'));
            }
            break;

            case 'create-socks5-proxy':
            {
                $SUBTITLE = 'Create a Local SOCKS5 Proxy';
                $INTRO = '<span>A SOCKS5 proxy</span> enables you to tunnel your browser <em>(and DNS)</em> traffic through a <span class="hue">remote server</span> that isn\'t subject to ISP censorship';
                $smarty->assign('CONTENT', $smarty->fetch('howto-socks5-tunnel.tpl'));
            }
            break;
        }

        $smarty->assign('SUBTITLE',$SUBTITLE);
        $smarty->assign('INTRO',$INTRO);
        $smarty->display('how-to-base.tpl');
    }
    else
    {
        $smarty->display('how-to-tor.tpl');
    }
?>
