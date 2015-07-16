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
<title><?php print($ShardName); ?> | Create a Local SOCKS5 Proxy</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Create a Local SOCKS5 Proxy">
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
					<h1 class="title">Create a Local SOCKS5 Proxy</h1>
						<h1 class="intro">
                        <span>A SOCKS5 proxy</span> enables you to tunnel your browser <em>(and DNS)</em> traffic through a <span class="hue">remote server</span> that isn't subject to ISP censorship
						</h1>
					</div>
				</div>
			</div>
		<div class="container wrapper">
	<div class="inner_content">
	
		<div class="row pad30">
			<div class="col-md-9 pad15">
		    <img src="//<?php print($FQDN); ?>/img/cables.jpg" alt="Picture of fibres in a switch" title="Fibre optic cables" />

<h2>Acquiring a Server</h2>
<p>
If you are on a budget then pay a visit to <a href="http://www.lowendbox.com">LowEndBox.com</a> which regularly features small virtual machine instances <em>(e.g. 128Mb of RAM)</em> for as little as &pound;5 a year.
</p>
<p>Otherwise a good choice is <a href="https://www.digitalocean.com/">DigitalOcean</a> who offer a small VM with 1Tb of transfer for only &dollar;5 (&pound;3) a month.</p>

<p>DigitalOcean have a good tutorial on getting started with their service available <a href="https://www.digitalocean.com/community/tutorials/how-to-create-your-first-digitalocean-droplet-virtual-server">here.</a></p>

<p>There is the possibility PacketFlagon will start offering shell accounts directly in the near future</p>

<h2>Windows using Putty</h2>
<p>
Unfortunately it is <a href="http://noncombatant.org/2014/03/03/downloading-software-safely-is-nearly-impossible/">difficult to download putty securely</a> but putting that aside it <strong>can</strong> be downloaded from <a href="http://www.chiark.greenend.org.uk/~sgtatham/putty/">here</a>.
</p>

<p>
Once installed load it up and add the IP address of your server into the hostname textbox of the Session screen.
<br/>
<img width="30%" src="//<?php print($FQDN); ?>/img/putty_1.jpg"/>
</p>

<p>
Then on the left hand side expand the SSH section and select Tunnels.
<br/>
<img width="30%" src="//<?php print($FQDN); ?>/img/putty_2.jpg"/>
</p>

<p>
In the Tunnels section set the Source port to be 9050 and the <strong>Destination</strong> to be <strong>Dynamic</strong>, click <strong>Add</strong> so <strong>D9050</strong> appears in the textbox and then click <strong>Open</strong>.
<br/>
<img width="30%" src="//<?php print($FQDN); ?>/img/putty_3.jpg"/>
</p>

<p>
You'll be informed that the authenticity of the host can't be established which is true because you don't know what the RSA key fingerprint is. You can choose to accept it and continue or be paranoid and bail. If you chose to continue you will be prompted for you password that was sent by email.
</p>

<p>
You can now configure your PAC file to use a local SOCKS5 proxy and your selected websites will route through your server!
</p>


<h2>Linux using OpenSSH</h2>
<p>
Assuming you are logged into your Linux computer load up a terminal.
<br/>
<a class="lightbox" href="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_1.png"><img class="aligncenter size-medium wp-image-137" alt="terminal_1" src="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_1-300x215.png" width="300" height="215" /></a><br/>
Type the following;
<code>ssh -D 9050 root@xx.xx.xx.xx</code> <em>(Replace the IP address with your own)</em>
</p>
<p>
You'll be informed that the authenticity of the host can't be established which is true because you don't know what the RSA key fingerprint is. You can choose to accept it and continue or be paranoid and bail. If you chose to continue you will be prompted for you password that was sent by email.<br/>
<a class="lightbox" href="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_2.png"><img class="aligncenter size-medium wp-image-142" alt="terminal_2" src="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_2-300x215.png" width="300" height="215" /></a>
</p>

<p>
Load up another terminal <em>(or a tab)</em> and type the following;
<br/>
<code>curl --socks5-hostname 127.0.0.1:9050 http://wtfismyip.com/json</code>
</p>
<p>
You should see the following output indicating that your ISP is <strong>Digital Ocean</strong>.
<br/>
<a class="lightbox" href="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_3.png"><img class="aligncenter size-medium wp-image-140" alt="terminal_3" src="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_3-300x215.png" width="300" height="215" /></a>
</p>

<p>
You can now configure your PAC file to use a local SOCKS5 proxy and your selected websites will route through your server!
</p>

	
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
