<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{$TITLE} | Configure Firefox</title>
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
<link href="//{$FQDN}/css/bootstrap.css" rel="stylesheet">
<link href="//{$FQDN}/css/font-awesome.min.css" rel="stylesheet">
<link href="//{$FQDN}/css/theme.css" rel="stylesheet">
<link href="//{$FQDN}/css/colour.css" rel="stylesheet" type="text/css"/>
<link href="//{$FQDN}/css/zocial.css" rel="stylesheet" type="text/css"/>
<link rel="icon" type="image/ico" href="//{$FQDN}/img/favicon.ico">
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
				<a href="{$PROTO}://{$FQDN}/"><img src="//{$FQDN}/img/logo.png" alt="" class="animated bounceInDown" /></a> 
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
			
				<img src="//{$FQDN}/img/firefox.png" alt="Picture of firefox browser" title="Firefox browser image" />
			
			
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
					<li><i class="fa-li fa fa-apple colour"></i> <a href="//{$FQDN}/how-to/configure-safari">Configure Safari</a></li>
					<li><i class="fa-li fa fa-windows colour"></i> <a href="//{$FQDN}/how-to/configure-internet-explorer">Configure IE</a></li>
					<li><i class="fa-li fa fa-google-plus colour"></i> <a href="//{$FQDN}/how-to/configure-chrome">Configure Chrome</a></li>
				</ul>
				
				<p>If you need help with any other browsers you can send an email to <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a>, or tweet to <a href="//twitter.com/RoutingPackets">@RoutingPackets</a> or jump on #RoutingPacketsIsNotACrime on freenode.</p>
	
				<div class="pad10"></div>
				
				<p>
					<a href="//twitter.com/RoutingPackets" class="zocial icon twitter"></a> 
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
                    This proxy shard is provided by {$CREDIT|default:'Anonymous'} | #RoutingPacketsIsNotACrime | Copyright &copy; Brass Horn Communications
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
<script src="//{$FQDN}/js/jquery.touchSwipe.min.js"></script>
<script src="//{$FQDN}/js/jquery.mousewheel.min.js"></script>		         
<script src="//{$FQDN}/js/bootstrap.min.js"></script>
<script src="//{$FQDN}/js/retina.js"></script>
<script type="text/javascript" src="//{$FQDN}/js/scripts.js"></script>
<script src="//{$FQDN}/js/jquery-ui.min.js"></script>

</body>
</html>


