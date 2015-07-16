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

	require_once('../libs/config.php');
	require_once('../libs/api.php');

	if(isset($_GET['hash']) && !empty($_GET['hash']))
	{
		$Hash = $_GET['hash'];

		$API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
		$PAC = $API->GetPACDetails($Hash);

		if($PAC['success'])
		{
			$FriendlyName = $PAC['friendlyname'];
			$Description = $PAC['description'];
			$URLArray = $PAC['urls'];
			$URLs = "";

			foreach($URLArray as $urlMeta)
			{
				$URLs .= $urlMeta['url'] . ", ";
			}

			$URLs = substr($URLs,0,strlen($URLs) - 2);

			$Tor = $PAC['localproxy'];
		}
		else
		{
			$FriendlyName = "";
                        $Description = "";
                        $URLArray = "";
                        $URLs = "";
                        $Tor = false;
		}
	}

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php print($ShardName); ?> | Create a Proxy Config</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Create your own personalised PAC file">
<link rel="canonical" href="https://routingpacketsisnotacrime.uk/create" />
<meta name="author" content="Brass Horn Communications @BrassHornComms">

<link href='//fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->

<link href="//<?php print($FQDN); ?>/css/bootstrap.css" rel="stylesheet">
<link href="//<?php print($FQDN); ?>/css/font-awesome.min.css" rel="stylesheet">
<link href="//<?php print($FQDN); ?>/css/theme.css" rel="stylesheet">
<link href="//<?php print($FQDN); ?>/css/colour.css" rel="stylesheet" type="text/css"/>
<link href="//<?php print($FQDN); ?>/css/zocial.css" rel="stylesheet" type="text/css"/>
<link rel="icon" type="image/ico" href="//<?php print($FQDN); ?>/img/favicon.ico">

<!--[if lt IE 9]>
<script src="html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
				<h1>The first condition of progress is the removal of censorship.</h1>
					<h1 class="title">Create your Own Proxy PAC</h1>
						<h1 class="intro">
							It doesn't matter if you want to reach <span>thepiratebay.org</span>, a website about <span>sexual</span> health, or reddits <span>/r/conspiracy</span> <span class="hue">censorship</span> has no place on our Internet.
						</h1>
					</div>
				</div>
			</div>
			
		<div class="container wrapper pad10">
			<div class="inner_content">
				<div class="row pad10">
					<div class="col-sm-6 col-md-4">
					<h3>
						To create your own customised Proxy configuration simply fill in the details on the right and click <span>Create</span><br/><br/>
						Ensure that each domain is separated with a comma ( <span>,</span> ) and don't include the http:// or //
					</h3>
				
					<br/><br/>	
					<h5>
						<span>Notes:</span><br>
						The friendly name, description and password are optional.<br>
						<br/>
						Choosing <span class="hue">Yes</span> to "Use a local SOCKS Proxy" will require the creation of a local <a href="//<?php print($FQDN); ?>/how-to/create-tor-proxy">Tor</a> <em>(or <a href="//<?php print($FQDN); ?>/how-to/create-socks5-proxy">another SOCKS5</a>)</em> Proxy<br/><em>( It is recommended that you do this! )</em><br>
					</h5>
					<br/><br/>	
					<h5>
						If you have any trouble; send an email to <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a>, or tweet to <a href="//twitter.com/PacketFlagon">@PacketFlagon</a> or jump on #RoutingPacketsIsNotACrime on freenode.
					</h5>
				</div>
				
				<div class="col-sm-6 col-md-8">
                    
					<div class="contact_form">  
					<div id="note"></div>
					<div id="fields">
				<form id="ajax-contact-form">
					<p class="form_info">friendly name</p>
						<input class="col-xs-12 col-sm-12 col-md-8" placeholder="An optional friendly name for your proxy config" type="text" name="name" value="<?php print($FriendlyName); ?>" />
					<p class="form_info">description</p>
						<input class="col-xs-12 col-sm-12 col-md-8" type="text" placeholder="An optional description of this proxy config" name="desc" value="<?php print($Description); ?>"  />
					<p class="form_info">password</p>
						<input class="col-xs-12 col-sm-12 col-md-8" type="password" placeholder="An optional  password to write protect this proxy config" id="hash_password" name="password" value="" /><br>
					<br/>
					<hr/>
					<p class="form_info">List of URLs</p>
						<textarea name="urls" id="urls" placeholder="A comma separated list of domains e.g.
google.com, facebook.com, thepiratebay.org" class="col-xs-12 col-sm-12 col-md-12" ><?php print($URLs); ?></textarea>
				
					<p class="form_info">Use a local SOCKS Proxy</p>	
					<input type="radio" name="use_tor_proxy" value="yes"> Yes<br>
					<input type="radio" name="use_tor_proxy" value="no" checked> No
					<br/>
						<div class="clear"></div>
			
					<input type="submit" class="btn btn-primary btn-form marg-right5" value="Create" />
					<input type="reset" class="btn btn-primary btn-form" value="reset" />
				<div class="clear pad45"></div>
			</form>
		</div>
	</div>                   
	</div>                	
		</div>
			</div>
				</div>
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

<script src="//<?php print($FQDN); ?>/js/jquery.js"></script>
<script src="//<?php print($FQDN); ?>/js/bootstrap.min.js"></script>
<script src="//<?php print($FQDN); ?>/js/retina.js"></script>
<script type="text/javascript" src="//<?php print($FQDN); ?>/js/scripts.js"></script>
<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function(){	
			$("#ajax-contact-form").submit(function() {
				var str = $(this).serialize();		
				$.ajax({
					type: "POST",
					url: "//<?php print($FQDN); ?>/create_pac.php",
					data: str,
					success: function(msg) 
					{
						var jsonMsg = $.parseJSON(msg);
						if(jsonMsg.success)
						{
							result = '<div class="notification_ok">Your PAC File has been created. Redirecting...</div>';
							$("#fields").hide();
							if(typeof(Storage) !== "undefined")
							{
								localStorage.setItem(jsonMsg.hash, $("#password_hash").val() );
							}
							window.location.replace("//<?php print($FQDN); ?>/view/" + jsonMsg.hash );
						} 
						else 
						{
							result = '<div class="alert alert-danger">' + jsonMsg.message +'</div>'
						}
						$('#note').html(result);
					}
				});
				return false;
			});															
		});
	//]]>		
</script>

</body>
</html>
