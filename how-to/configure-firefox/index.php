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
<title><?php print($ShardName); ?> | Configure Firefox</title>
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
					<h1 class="title">How to Configure Firefox to use your PAC File</h1>
						<h1 class="intro">
						Committed to you, your <span>privacy</span> and an <span>open</span> Web.
						<br/>
						<a href="//www.firefox.com"><button type="button" class="btn btn-primary btn-lg">Get Firefox.</button></a>
						</h1>
					</div>
				</div>
			</div>
		<div class="container wrapper">
	<div class="inner_content">
	
		<div class="row pad30">
			<div class="col-md-9 pad15">
			
				<img src="//<?php print($FQDN); ?>/img/firefox.png" alt="Picture of firefox browser" title="Firefox browser image" />
			
			
			<h2><span>Basic Steps</span></h2>
			
			<p>
				<ol>
				<li>In Mozilla Firefox, go to Options. In Windows, click the Firefox button then choose Options, or go to Tools, then Options. In Mac OS X, go to Firefox, then Preferences. In Linux, go to Tools, Options.</li>
				<li>Go to the Advanced tab, then go to the Network tab.</li>
				<li>Click Settings next to Configure how Firefox connects to the Internet.</li>
				<li>Select Automatic proxy configuration URL.</li>
				<li>In the text field, paste in a PAC URL e.g. <strong>//RoutingPacketsIsNotACrime.uk/pac/b718ce9b276bc2f10af90fe1d5b33c0d</strong></li>
				<li>Press OK, then OK on the Options dialog.</li>
				</ol>			
			</p>
			
			<p>
				<div class="col-md-3"></div>
				<div class="alert alert-info col-md-6">
      					<strong>Heads up!</strong> You should not trust public proxies as they can be used to evesdrop on your traffic.<br/>Use <a href="//www.torproject.org/">Tor</a> and read up on how to ensure your privacy.
    				</div>
				<div class="col-md-3"></div>
			</p>
			</div>
			
			<!-- sidebar -->
				
			<div class="col-md-3">
			 <h4><span>Other Browsers</span></h4>
				<p>Instructions for configuring other browsers are below;</p>
				
				<ul class="fa-ul">
					<li><i class="fa-li fa fa-apple colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-safari/">Configure Safari</a></li>
					<li><i class="fa-li fa fa-windows colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-internet-explorer/">Configure IE</a></li>
					<li><i class="fa-li fa fa-google-plus colour"></i> <a href="//<?php print($FQDN); ?>/how-to/configure-chrome/">Configure Chrome</a></li>
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
