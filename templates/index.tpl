<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{$TITLE} | Custom PAC Proxies</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Build your own custom PAC proxy to bypass UK Internet censorship!">
<meta name="author" content="Brass Horn Communications @BrassHornComms">
<link rel="canonical" href="https://routingpacketsisnotacrime.uk" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->

<link href="//{$FQDN}/css/bootstrap.css" rel="stylesheet">
<link href="//{$FQDN}/css/font-awesome.min.css" rel="stylesheet">
<link href="//{$FQDN}/css/theme.css" rel="stylesheet">
<link href="//{$FQDN}/css/colour.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="//{$FQDN}/css/timeline.css" />
<link rel="icon" type="image/ico" href="//{$FQDN}/img/favicon.ico">
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
				<a href="{$PROTO}://{$FQDN}"><img src="//{$FQDN}/img/logo.png" alt="" class="animated bounceInDown" /></a> 
			</div>
		</div>
           
            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav pull-right">
                {include file='nav.tpl'}
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
				<h1>Bypassing UK Internet Censorship</h1>
					<h1 class="title">{$TITLE}</h1>
						<h1 class="intro">
							This platform enables those in the UK with <span class="hue">censored</span> Internet connections to <span>bypass</span> these filters by building customised PAC files to selectively route certain websites via uncensored proxies.
<br/><br/>
This service is provided for <span class="hue">free</span> and without adverts. Please be considerate and don't stream across the public proxies but instead use a <a href="https://routingpacketsisnotacrime.uk/how-to/create-tor-proxy">local Tor proxy</a> or your <a href="https://survivetheclaireperryinter.net/2014/01/10/building-a-socks5-proxy-with-a-digital-ocean-server/">own SOCKS5 proxy</a>.
						</h1>
					</div>
				</div>
			</div>
			<div class="container wrapper">
				<div class="inner_content">
					<div class="pad45"></div>
					<div class="main fadeinup">
						
				<ul class="cbp_tmtimeline">
					<li>
						<time class="cbp_tmtime"><span>Create</span></time>
						<div class="cbp_tmicon cbp_tmicon-screen"></div>
						<div class="cbp_tmlabel">
							<h2>Create Your PAC File</h2>
							<p>
								Navigate to the <span class="timeline-link"><a href="//{$FQDN}/create">Create</a> page</span> to get started.
							</p>
							<p>
								Give your custom PAC file a friendly name, a description and an optional password to protect the config.
							</p>
							<p>
								Add the URLs you wish to reach through the uncensored proxies.
							</p>
							<p>
								Click <span>Create</span>
							</p>
						</div>
					</li>
					<li>
						<time class="cbp_tmtime"><span>Share</span></time>
						<div class="cbp_tmicon cbp_tmicon-mail"></div>
						<div class="cbp_tmlabel">
							<h2>Share Your PAC File</h2>
							<p>
								The <span class="timeline-link"><a href="//{$FQDN}/view/b718ce9b276bc2f10af90fe1d5b33c0d">View</a></span> page provides an overview of your custom PAC file.
							</p>
							<p>
								It also allows anyone with the password to add or remove URLs from the PAC configuration.<br/>
							</p>
							<p>	
								Other users can clone the PAC file to make their own version so they can add or remove URLs without affecting the original.
							</p>
						</div>
					</li>
					<li>
						<time class="cbp_tmtime"> <span>Config</span></time>
						<div class="cbp_tmicon cbp_tmicon-screen"></div>
						<div class="cbp_tmlabel">
							<h2>Configure Your Browser To Use A Pac</h2>
							<p>
								Check the How-to section for advice on how to configure your browser to work with these PAC files.	
							</p>
							<p class="timeline-link">
								<ul class="fa-ul">
                                     				   <li class="timeline-link"><i class="fa-li fa fa-apple "></i> <a href="//{$FQDN}/how-to/configure-safari">Configure Safari</a></li>
                                        			   <li class="timeline-link"><i class="fa-li fa fa-windows"></i> <a href="//{$FQDN}/how-to/configure-internet-explorer">Configure IE</a></li>
                                        			   <li class="timeline-link"><i class="fa-li fa fa-google-plus"></i> <a href="//{$FQDN}/how-to/configure-chrome">Configure Chrome</a></li>
                                        			   <li class="timeline-link"><i class="fa-li fa fa-desktop"></i> <a href="//{$FQDN}/how-to/configure-firefox">Configure Firefox</a></li>
                                				</ul>
							</p>
						</div>
					</li>
					<li>
						<time class="cbp_tmtime"><span>Browse</span></time>
						<div class="cbp_tmicon cbp_tmicon-earth"></div>
						<div class="cbp_tmlabel">
							<h2>Browse An Uncensored Internet - <span>Free</span></h2>
							<p>
								You're now able to browse the Internet and should be able to reach websites that were previously censored.
							</p>

							<p>
								ISPs are deploying more pervasive technology in order to keep up with the demands of laws such as the Data Retention and Investigatory Powers Act and the Regulation of Investigatory Powers Act. A side effect of which is the ability to perform Deep Packet Inspection which can defeat simple proxy configs.
							</p>

							<p>
								If you still find yourself censored then visit <span class="timeline-link"><a href="https://survivetheclaireperryinter.net">SurviveTheClairePerryInter.net</a></span> for more technical advice on how to defeat most ISP censorship.
							</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
		</div>
		<!--//page-->
			
	<!-- footer-->
		<div id="footer2">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<div class="copyright">
					This proxy shard is provided by {$CREDIT} | #RoutingPacketsIsNotACrime | Copyright &copy; Brass Horn Communications
						</div>
						</div>
					</div>
				</div>
					</div>
					<!-- up to top -->
				<a href="#"><i class="go-top fa fa-angle-double-up"></i></a>
				<!--//end--> 
				
<!-- scripts -->
<script src="//{$FQDN}/js/jquery.js"></script>
<script src="//{$FQDN}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//{$FQDN}/js/scripts.js"></script>
<script src="//{$FQDN}/js/modernizr.custom.js"></script>
<script src="//{$FQDN}/js/retina.js"></script>
</body>
</html>
