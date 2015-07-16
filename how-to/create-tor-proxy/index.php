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
<title><?php print($ShardName); ?> | Configure a Local Tor Proxy</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="How to configure Firefox to work with the selective PAC proxy">
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
					<h1 class="title">How to Configure A Local Tor Proxy for use with your PAC File</h1>
						<h1 class="intro">
						<span>Anonymity Online</span> - Protect your privacy. Defend yourself against network surveillance and traffic analysis.
						<br/>
						<a href="//www.torproject.org"><button type="button" class="btn btn-primary btn-lg">Get Tor.</button></a>
						</h1>
					</div>
				</div>
			</div>
		<div class="container wrapper">
	<div class="inner_content">
	
		<div class="row pad30">
			<div class="col-md-9 pad15">
			
				<img src="//<?php print($FQDN); ?>/img/tor.png" alt="Picture of Tor logo" title="Tor Logo image" />
			
			
			<h2><span>Basic Steps</span></h2>
			
			<p>
				If you want to help the Tor network grow and create your own proxy to use with the RoutingPacketsIsNotACrime PAC files then these instructions should get you started.

If you don't already have a dedicated server consider visiting <a href="//www.digitalocean.com/">DigitalOcean</a>, <a href="//aws.amazon.com/ec2/">Amazon EC2</a> or for some really good deals check <a href="http://lowendbox.com/">LowEndBox.com</a>.

For various reasons I would suggest hosting the server outside of the UK but that is a choice for you to make.

<h3>CentOS 6</h3>
<h4>Install EPEL</h4>
<pre>wget http://www.mirrorservice.org/sites/dl.fedoraproject.org/pub/epel/6/i386/epel-release-6-8.noarch.rpm
yum install epel-release-6-8.noarch.rpm</pre>
<h4>Edit iptables</h4>
<pre>vim /etc/sysconfig/iptables</pre>
Allow the ORPort and the proxy port (in this case 9001 and 9150)
<pre>*filter
:INPUT ACCEPT [0:0]
:FORWARD ACCEPT [0:0]
:OUTPUT ACCEPT [0:0]
-A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT
-A INPUT -p icmp -j ACCEPT
-A INPUT -i lo -j ACCEPT
-A INPUT -m state --state NEW -m tcp -p tcp --dport 22 -j ACCEPT
-A INPUT -m state --state NEW -m tcp -p tcp --dport 9001 -j ACCEPT
-A INPUT -m state --state NEW -m tcp -p tcp --dport 9150 -j ACCEPT
-A INPUT -j REJECT --reject-with icmp-host-prohibited
-A FORWARD -j REJECT --reject-with icmp-host-prohibited
COMMIT</pre>
Save and quit
<pre>/etc/init.d/iptables restart</pre>
If your server has IPv6 then make similar changes to ip6tables
<h4>Editing torrc</h4>
<pre>vim /etc/tor/torrc</pre>
A minimal torrc for use with a PAC file style proxy would look similar to the below (although you should read all the options to understand what you are doing);
<pre>SocksPort xx.xx.xx.xx:9150
ORPort 9001
Nickname TheNameOfYourRelay
ContactInfo YourContactDetails
ExitPolicy reject *:*</pre>
xx.xx.xx.xx should be a routeable IP <em>(e.g. not 127.0.0.1)</em> of your server, if you want to keep your relay server partially private you might want to add PublishServerDescriptor 0 to your config too.

<div class="alert alert-warning">There is no security here, if someone port scanned your server then they would see that it is an open proxy and could use it to do nasty things that people will blame you for!<br /> If your Tor relay is on a public IP <em>(e.g. not 10.0.0.0/8, 172.16.0.0/12 or 192.168.0.0/16)</em><em> then you may want to restrict the IPTables allow rule to only allow your source IP addresses</em></div>

<h4>Start Tor &amp; Confirm it is working</h4>
<pre>/etc/init.d/tor start
tail -f /var/log/messages</pre>
You should see something along the lines of;
<pre>socks Tor[31452]: Self-testing indicates your ORPort is reachable from the outside. Excellent. Publishing server descriptor.
socks Tor[31452]: Bootstrapped 85%: Finishing handshake with first hop.
socks Tor[31452]: Bootstrapped 90%: Establishing a Tor circuit.
socks Tor[31452]: Tor has successfully opened a circuit. Looks like client functionality is working.
socks Tor[31452]: Bootstrapped 100%: Done.
socks Tor[31452]: Performing bandwidth self-test...done.</pre>


<h3>Windows</h3>
Follow the tutorial on <a href="//survivetheclaireperryinter.net/2014/03/11/installing-tor-on-windows-securely/">Securely Installing Tor on Windows</a> to get the full Tor Browser bundle up and running.

Once installed and started Tor will be running on localhost:9150 <em>(do not close the Tor Browser as this will also close the relay)</em>

<h4>Done!</h4>
Assuming you have chosen the URLs you wanted by creating a PAC file you can now browse to the URLs that were previously censored as they are now being routed over Tor. Any non-restricted URLs will route over your normal Internet connection.
			</p>
			
			<p>
				<div class="col-md-3"></div>
				<div class="alert alert-info col-md-6">
      					<strong>Heads up!</strong> Whilst tor will prevent your ISP and the Government from easily snooping on your traffic the exit node operator and a determined state power adversary will be able to expose you if you aren't careful.<br/><br/>Ensure you read up on how to protect your privacy when using Tor.
    				</div>
				<div class="col-md-3"></div>
			</p>
			</div>
			
			<!-- sidebar -->
				
			<div class="col-md-3">
			 <h4><span>Configuring Browsers</span></h4>
				<p>Instructions for configuring browsers are below;</p>
				
				<ul class="fa-ul">
					<li><i class="fa-li fa fa-apple colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-safari/">Configure Safari</a></li>
					<li><i class="fa-li fa fa-windows colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-internet-explorer/">Configure IE</a></li>
					<li><i class="fa-li fa fa-google-plus colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-chrome/">Configure Chrome</a></li>
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
                    				This proxy shard is provided by <?php print($Credit); ?> | #RoutingPacketsIsNotACrime | Copyright &copy; Brass Horn Communications
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
