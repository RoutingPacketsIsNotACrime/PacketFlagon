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
    //Initialize the template engine
    $smarty = new Smarty();

    if (file_exists('libs/config.php')) 
    {
	    require_once('libs/config.php');
        
        $smarty->assign('FQDN',$FQDN);
        $smarty->assign('TITLE',$ShardName);
        $smarty->assign('PROTO',($ForceHTTPS ? 'https' : 'http'));
        $smarty->assign('CREDIT',(empty($Credit) ? 'Anonymous' : $Credit));

        $smarty->display('index.tpl');
    }
    else
    {
        $smarty->assign('FQDN',getenv('HTTP_HOST'));
        $smarty->display('setup.tpl');
    }
?>
