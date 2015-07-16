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

        //Fuck censorship
        header('X-Fuck-You-Censors: Wanna play a game of whack a mole?');

        require_once('../../libs/config.php');

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php print($ShardName); ?> | Find Other ProxyShards (PAC serving front-ends)</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Find Other ProxyShards (PAC serving front-ends)">
<meta name="author" content="Brass Horn Communications @BrassHornComms">
<link href='//fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->
<link href="//<?php print($FQDN); ?>/css/bootstrap.css" rel="stylesheet">
<link href="//<?php print($FQDN); ?>/css/font-awesome.min.css" rel="stylesheet">
<link href="//<?php print($FQDN); ?>/css/theme.css" rel="stylesheet">
<link href="//<?php print($FQDN); ?>/css/colour.css" rel="stylesheet" type="text/css"/>
<link href="//<?php print($FQDN); ?>/css/zocial.css" rel="stylesheet" type="text/css"/>
<link rel="icon" type="image/ico" href="//<?php print($FQDN); ?>/img/favicon.ico">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>
<!--header-->
	<div class="header">
<!--menu-->
    <nav id="main_menu" class="navbar" role="navigation">
      <div class="container">
            <div class="navbar-header">
        <!--toggle-->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				<i class="fa fa-bars"></i>
			</button>
		<!--logo-->
			<div class="logo">
				<a href="http://<?php print($FQDN); ?>/"><img src="//<?php print($FQDN); ?>/img/logo.png" alt="" class="animated bounceInDown" /></a> 
			</div>
		</div>
           
            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav pull-right">
                <li><a href="http://<?php print($FQDN); ?>">Home</a> </li>
<li><a href="//<?php print($FQDN); ?>/about/">About</a> </li>
<li><a href="//<?php print($FQDN); ?>/create/">Create</a></li>
<li class="dropdown"><a href="javascript:{}">How-to...</a>
<ul class="dropdown-menu">
<li><a href="//<?php print($FQDN); ?>/how-to/configure-chrome/">Configure Chrome</a></li>
<li><a href="//<?php print($FQDN); ?>/how-to/configure-firefox/">Configure Firefox</a></li>
<li><a href="//<?php print($FQDN); ?>/how-to/configure-safari/">Configure Safari</a></li>
<li><a href="//<?php print($FQDN); ?>/how-to/configure-internet-explorer/">Configure IE</a></li>
<li><a href="//<?php print($FQDN); ?>/how-to/create-tor-proxy/">Create a local Tor Proxy</a></li>
<li><a href="//<?php print($FQDN); ?>/how-to/create-socks5-proxy/">Create a SOCKS5 Proxy</a></li>
<li><a href="//<?php print($FQDN); ?>/how-to/find-pac-frontends/">Find other ProxyShards</a></li>
<li><a href="//<?php print($FQDN); ?>/how-to/create-shard/">Create a ProxyShard</a></li>
</ul>
</li>

		        </ul>
	    </div>
				</div>
			</nav>
		</div>
	<!--//header-->
	
	<!--page--> 
	<div id="banner">
		<div class="container intro_wrapper">
			<div class="inner_content">
				<h1>Information wants to be free</h1>
					<h1 class="title">Find Other ProxyShards (PAC serving front-ends)</h1>
						<h1 class="intro">
                        <span>Block one and another rises in its place</span><br/>If a domain is found to be blocked another is automatically registered and a new ProxyShard is created.<br/>Here's how to find them!
						</h1>
					</div>
				</div>
			</div>
		<div class="container wrapper">
	<div class="inner_content">
	
		<div class="row pad30">
			<div class="col-md-9 pad15">
		    <span style="width:100%; text-align: center;"><img src="//<?php print($FQDN); ?>/img/hydra.jpg" alt="" title="Graphic depicting the mythical hydra" /></span>

<h2><span>Proactively Avoid Blocks using Amazon S3</span></h2>
<p>
    The easiest way to avoid an ISP blocking a particular ProxyShard causing you issues is to save a copy of your PAC file to Amazon's S3 file storage cloud.
</p>
<p>
    ISPs can't risk blocking S3 due to it's massive scale and use by lots of other websites. Since S3 URLs natively support SSL they can't inspect the HTTP Host header or GET path to block.
</p>
<p>
    To push your PAC file to S3 is easy;
    <ul>
        <li>Navigate to your PAC files view page <em>(e.g. https://routingpacketsisnotacrime.uk<strong>/view/</strong>b718ce9b276bc2f10af90fe1d5b33c0d )</em></li>
        <li>Look on the left hand side (or near the bottom on smaller screens) for the <strong>Push PAC to Amazon S3</strong> section</li>
        <li>Click the <button type="button" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> &nbsp; Push to S3</button> button</li>
        <li>Done! After a short delay your personalised, SSL secured Amazon S3 bucket and PAC file will be created and the unique URL will be displayed</li>
    </ul>
</p>

<h2><span>Using DNS</span></h2>
<p>
    ISP DNS interference seems to be restricted to A and CNAME records so in order to find alternate ProxyShards PacketFlagon publishes a list of alternate frontends and proxies using SRV and TXT records.
</p>
<h4>Find Alternate ProxyShards with TXT Records</h4>
<p>
At a command prompt issue the following;
<code>nslookup -type=txt shards.packetflagon.is</code>
or
<code>dig -t txt shards.packetflagon.is</code>
</p>
<p>
You should receive a CSV list of domains <em>(excluding the http(s) prefix)</em> that are vetted PacketFlagon ProxyShards.
</p>
<pre>
$ dig -t txt shards.packetflagon.is

; <<>> DiG 9.8.2rc1-RedHat-9.8.2-0.23.rc1.el6_5.1 <<>> -t txt shards.packetflagon.is
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 2603
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0

;; QUESTION SECTION:
;shards.packetflagon.is.         IN      TXT

;; ANSWER SECTION:
shards.packetflagon.is.  10799   IN      TXT     "routingpacketsisnotacrime.uk,thisproxykillscensors.uk"

;; Query time: 57 msec
;; SERVER: 8.8.8.8#53(8.8.8.8)
;; WHEN: Thu Oct  2 15:37:26 2014
;; MSG SIZE  rcvd: 103
</pre>

<h4>Find PacketFlagon Proxies</h4>
<p>
At a command prompt issue the following;
<code>nslookup -type=SRV _proxy._tcp.packetflagon.is</code>
or
<code>dig -t SRV _proxy._tcp.packetflagon.is</code>
</p>
<p>
You should receive an RFC compliant SRV response that are vetted PacketFlagon proxies, their ports and priorities.
</p>
<h5>Windows nslookup Response</h5>
<pre>
>nslookup -type=srv _proxy._tcp.packetflagon.is
Server:  google-public-dns-a.google.com
Address:  2001:4860:4860::8888

Non-authoritative answer:
_proxy._tcp.packetflagon.is     SRV service location:
          priority       = 0
          weight         = 5
          port           = 8080
          svr hostname   = proxy-1-1.packetflagon.is
_proxy._tcp.packetflagon.is     SRV service location:
          priority       = 0
          weight         = 15
          port           = 8080
          svr hostname   = proxy-1-2.packetflagon.is
</pre>

<h5>Linux Dig Response</h5>
<pre>
$ dig -t srv _proxy._tcp.packetflagon.is

; <<>> DiG 9.8.2rc1-RedHat-9.8.2-0.23.rc1.el6_5.1 <<>> -t srv _proxy._tcp.packetflagon.is
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 31975
;; flags: qr rd ra; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 0

;; QUESTION SECTION:
;_proxy._tcp.packetflagon.is.   IN      SRV

;; ANSWER SECTION:
_proxy._tcp.packetflagon.is. 10799 IN   SRV     0 15 8080 proxy-1-2.packetflagon.is.
_proxy._tcp.packetflagon.is. 10799 IN   SRV     0 5 8080 proxy-1-1.packetflagon.is.

;; Query time: 426 msec
;; SERVER: 8.8.8.8#53(8.8.8.8)
;; WHEN: Thu Oct  2 15:36:33 2014
;; MSG SIZE  rcvd: 135

</pre>


<h2><span>Twitter</span></h2>
<p>In the event a block is detected it will be announced by the PacketFlagon Deadhand software and a new URL will be tweeted with the hashtag <a href="https://twitter.com/search?f=realtime&q=%23PacketFlagon&src=typd">#PacketFlagon</a></p>
<p>Anyone running their own PacketFlagon shard <em>(or an independant platform)</em> is also encouraged to use the <a href="https://twitter.com/search?f=realtime&q=%23PacketFlagon&src=typd">#PacketFlagon</a> hashtag as we will not automatically publish private proxy shards unless specifically asked to.</p>
	
			</div>
			
			<!-- sidebar -->
				
			<div class="col-md-3">
			 <h4><span>Other Browsers</span></h4>
				<p>Instructions for configuring other browsers are below;</p>
				
				<ul class="fa-ul">
					<li><i class="fa-li fa fa-apple colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-safari/">Configure Safari</a></li>
					<li><i class="fa-li fa fa-windows colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-internet-explorer/">Configure IE</a></li>
					<li><i class="fa-li fa fa-desktop colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-firefox/">Configure Firefox</a></li>
				</ul>
				
				<p>If you need help with any other browsers you can send an email to <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a>, or tweet to <a href="//twitter.com/PacketFlagon">@PacketFlagon</a> or jump on #RoutingPacketsIsNotACrime on freenode.</p>
				
				<div class="pad10"></div>
				
				<p>
					<a href="//twitter.com/PacketFlagon" class="zocial icon twitter"></a> 
				</p>		
			</div>
				</div>
				</div>
			</div>
			<div class="pad45 hidden-md hidden-lg"></div>
		<!--//page-->
						
		<!--footer-->
		<div id="footer2">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="copyright">
						This proxy shard is provided by <?php print($Credit); ?> | #RoutingPacketsIsNotACrime | <a href="https://BrassHornCommunications.uk">Written by Brass Horn Communications</a>
                    			</div>
				</div>
			</div>
		</div>
		</div>
					<!-- up to top -->
				<a href="#"><i class="go-top fa fa-angle-double-up"></i></a>
				<!--//end-->  
				  
<!-- scripts -->
<script src="//<?php print($FQDN); ?>/js/jquery.js"></script>	
<script src="//<?php print($FQDN); ?>/js/jquery.touchSwipe.min.js"></script>
<script src="//<?php print($FQDN); ?>/js/jquery.mousewheel.min.js"></script>		         
<script src="//<?php print($FQDN); ?>/js/bootstrap.min.js"></script>
<script src="//<?php print($FQDN); ?>/js/retina.js"></script>
<script type="text/javascript" src="//<?php print($FQDN); ?>/js/scripts.js"></script>
<script src="//<?php print($FQDN); ?>/js/jquery-ui.min.js"></script>

</body>
</html>
