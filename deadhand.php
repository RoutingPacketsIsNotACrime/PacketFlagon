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

<p>In such an event the Dead Hand Protocol will initiate. Alternate domains will go live, DNS will re-route, backup protocols will shift, GPG revocations will be issued, any seized servers will burn <em><a href="https://s53.xyz">s53.xyz</a> + Thermite == fun</em>.</p>

<p>Monitor the Twitter hashtags #RoutingPacketsIsNotACrime and #PacketFlagon for new URLs/domains.</p>

<p>The system is automated and went live at 00:00:01 on 14/09/2014</p>
</body>
