<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Create a Proxy Config | {$TITLE}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Create your own personalised PAC file">
<link rel="canonical" href="https://routingpacketsisnotacrime.uk/create" />
<meta name="author" content="Gareth Llewellyn @NetworkString">

<link href='//fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="//fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->

<link href="//{$FQDN}/css/bootstrap.css" rel="stylesheet">
<link href="//{$FQDN}/css/font-awesome.min.css" rel="stylesheet">
<link href="//{$FQDN}/css/theme.css" rel="stylesheet">
<link href="//{$FQDN}/css/colour.css" rel="stylesheet" type="text/css"/>
<link href="//{$FQDN}/css/zocial.css" rel="stylesheet" type="text/css"/>
<link rel="icon" type="image/ico" href="//{$FQDN}/img/favicon.ico">

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
						Choosing <span class="hue">Yes</span> to "Use a local SOCKS Proxy" will require the creation of a local <a href="//{$FQDN}/how-to/create-tor-proxy">Tor</a> <em>(or <a href="//survivetheclaireperryinter.net/2014/01/10/building-a-socks5-proxy-with-a-digital-ocean-server/">other SOCKS5</a>)</em> Proxy<br/><em>( It is recommended that you do this! )</em><br>
					</h5>
					<br/><br/>	
					<h5>
						If you have any trouble; send an email to <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a>, or tweet to <a href="//twitter.com/RoutingPackets">@RoutingPackets</a> or jump on #RoutingPacketsIsNotACrime on freenode.
					</h5>
				</div>
				
				<div class="col-sm-6 col-md-8">
                    {$ERROR}
					<div class="contact_form">  
					<div id="note"></div>
					<div id="fields">
				<form id="ajax-contact-form">
					<p class="form_info">friendly name</p>
						<input class="col-xs-12 col-sm-12 col-md-8" placeholder="An optional friendly name for your proxy config" type="text" name="name" value="{$FRIENDLYNAME}" />
					<p class="form_info">description</p>
						<input class="col-xs-12 col-sm-12 col-md-8" type="text" placeholder="An optional description of this proxy config" name="desc" value="{$DESCRIPTION}"  />
					<p class="form_info">password</p>
						<input class="col-xs-12 col-sm-12 col-md-8" type="password" placeholder="An optional  password to write protect this proxy config" id="hash_password" name="password" value="" /><br>
					<br/>
					<hr/>
					<p class="form_info">List of URLs</p>
						<textarea name="urls" id="urls" placeholder="A comma separated list of domains e.g.
google.com, facebook.com, thepiratebay.org" class="col-xs-12 col-sm-12 col-md-12" >{$URLS}</textarea>
				
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
                 This proxy shard is provided by {$CREDIT|default:'Anonymous'} | #RoutingPacketsIsNotACrime | Copyright &copy; Gareth Llewellyn
				</div>
				</div>
					</div>
				</div>
					</div>
				<!-- up to top -->
				<a href="#"><i class="go-top fa fa-angle-double-up"></i></a>
				<!--//end--> 

<script src="//{$FQDN}/js/jquery.js"></script>
<script src="//{$FQDN}/js/bootstrap.min.js"></script>
<script src="//{$FQDN}/js/retina.js"></script>
<script type="text/javascript" src="//{$FQDN}/js/scripts.js"></script>
<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function(){	
			$("#ajax-contact-form").submit(function() {
				var str = $(this).serialize();		
				$.ajax({
					type: "POST",
					url: "//{$FQDN}/create_pac.php",
					data: str,
					success: function(msg) 
					{
						var jsonMsg = $.parseJSON(msg);
						if(jsonMsg.success == 'ok')
						{
							result = '<div class="notification_ok">Your PAC File has been created. Redirecting...</div>';
							$("#fields").hide();
							if(typeof(Storage) !== "undefined")
							{
								localStorage.setItem(jsonMsg.hash, $("#password_hash").val() );
							}
							window.location.replace("//{$FQDN}/view/" + jsonMsg.hash );
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
