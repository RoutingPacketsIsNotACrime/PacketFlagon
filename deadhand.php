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
	$hash = $_GET['hash'];

	$array = array('success' => false, 'counterhash' => md5(Date('Y-m-d') . $DeadHandSeed));

	if(md5(Date('Y-m-d') . $DeadHandSeed) == $hash)
	{
		$array['success'] = true;
	}
	else
	{
		$array['counterhash'] = 'FAIL';
	}

	header('X-DeadHand: ' . json_encode($array));

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>DeadHand Protocol</title>
</head>
<body>
<p>A dead hand protocol allows for <em>second strike</em> capabilities in the event of a decapitation strike by an adversary.</p>

<p>It is possible that extra-legal action will result in the seizure of RoutingPacketsIsNotACrime.uk or its servers.</p>

<p>In such an event the Dead Hand Protocol will initiate. Alternate domains will go live, DNS will re-route, backup protocols will shift, GPG revocations will be issued, any seized servers will burn <em>(pager + arduino + thermite == ash)</em>.</p>

<p>Monitor the Twitter hashtags #RoutingPacketsIsNotACrime and #PacketFlagon for new URLs/domains.</p>

<p>The system is automated and went live at 00:00:01 on 14/09/2014</p>
</body>
