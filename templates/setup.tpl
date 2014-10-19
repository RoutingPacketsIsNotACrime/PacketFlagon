<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Setup your PacketFlagon ProxyShard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="This PacketFlagon proxy shard hasn't been configured yet">
<meta name="author" content="Gareth Llewellyn @NetworkString">
<link href='//fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/theme.css" rel="stylesheet">
<link href="css/colour.css" rel="stylesheet" type="text/css"/>
<link rel="icon" type="image/ico" href="img/favicon.ico">
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
				<a href="/"><img src="img/logo.png" alt="" class="animated bounceInDown" /></a> 
			</div>
		</div>
           
            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav pull-right">
                <!-- No Nav because there is nothing to do -->
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
				<h1>Thank you for helping to bypass censorship</h1>
					<h1 class="title">Configure your PacketFlagon ProxyShard</h1>
						<h1 class="intro">
                        In order for this shard to work you need to generate an <span class="hue">API key</span> and edit a file in the <span>libs/</span> directory.
						</h1>
					</div>
				</div>
			</div>
		<div class="container wrapper">
	<div class="inner_content">
	
		<div class="row pad30">
			<div class="col-md-9 pad15">
		    <h1>Generating an API Key</h1>	
            <p>To generate an API key you can use the form below or call the API directly using CuRL e.g.; {literal}<code>curl https://packetflagon.is/api/create -d "{'domain':'YOURSERVERNAME.TLD','contact':'youremail@YOURSERVERNAME.TLD'}"</code>{/literal}</p>

            <div class="contact_form">  
	            <div id="note"></div>
		        <div id="fields">
				        <form id="ajax-contact-form">
					        <p class="form_info">FQDN</p>
						    <input class="col-xs-12 col-sm-12 col-md-8" placeholder="The FQDN of this website e.g. www.proxyshard.com" type="text" name="fqdn" id="fqdn" value="{$FQDN}" />
					        <p class="form_info">Email Address</p>
						    <input class="col-xs-12 col-sm-12 col-md-8" type="email" placeholder="e.g. an email address" name="contact" id="contact" value=""  />
                            <br/><br/>
                            <button onclick="MakeAPIRequest()" type="button" class="btn btn-primary">Get API Key</button>
                        </form>
                </div>
            </div>

        <div class="pad10"></div>

            <h1>Creating the config.php file</h1>
            <p>
                In the <code>libs/</code> directory there is a file named <code>config.sample.php</code>.
            </p>
            <p>
                Rename that file to <code>config.php</code> and edit the following values to get a functioning setup;
                <pre>
    // FQDN (+ path if neccessary) for resources / callbacks
    $FQDN = "{$FQDN}";

    // A friendly name for this shard / site
    $ShardName = "WHATEVER YOU WANT TO CALL THIS SHARD";

    // Credit - if you want to highlight you are running this proxy
    $Credit = "YOUR NAME";

    // Used for countersigning requests see
    // https://RoutingPacketsIsNotACrime.uk/how-to/api for details
    $PacketFlagonAPIKey = "THE RESULT OF THE CURL COMMAND";
 
                </pre>
            </p>
			</div>
			
			<!-- sidebar -->
			
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
					This proxy shard hasn't been configured yet | #RoutingPacketsIsNotACrime | Copyright &copy; Gareth Llewellyn
                    </div>
				</div>
			</div>
		</div>
		</div>
					<!-- up to top -->
				<a href="#"><i class="go-top fa fa-angle-double-up"></i></a>
				<!--//end-->  
				  
<!-- scripts -->
<script src="js/jquery.js"></script>	
<script src="js/jquery.touchSwipe.min.js"></script>
<script src="js/jquery.mousewheel.min.js"></script>		         
<script src="js/bootstrap.min.js"></script>
<script src="js/retina.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script type="text/javascript">
{literal}function MakeAPIRequest()
{    
    
    var combinedObj = {'fqdn': $("#fqdn").val(), 'contact': $("#contact").val() };

    $.ajax({
            type: "POST",
            url: "https://packetflagon.is/api/create",
            data: combinedObj,
            crossDomain: true,
            contentType: "application/x-www-form-urlencoded",
            success: function(msg)
            {
                
                var jsonMsg;
                try
                {
                    jsonMsg = $.parseJSON(msg);
                }
                catch(err)
                {
                    jsonMsg = msg;
                }

                if(jsonMsg.success == 'ok')
                {
                    result = '<div class="notification_ok" style="text-transform: none !important;">Success!<br/>Your API key is: '+jsonMsg.apikey+'<br/>You are ready for the next step below;</div>';
                }
                else    
                {
                    result = '<div class="alert alert-danger">' + jsonMsg.message +'<br/>Contact <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a> for assistance.</div>';
                }

                $('#note').html(result);
            },
            statusCode:
            {
                400: function()
                {
                    result = '<div class="alert alert-warning">Received a HTTP 400!<br/>Ensure you add a FQDN <strong>and</strong> some form of contact information (even if it is fake).<br/>Contact <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a> for assistance.</div>';
                    $('#note').html(result);
                }
            },
            error: function( jqXHR, textStatus, errorThrown) 
            {
                result = '<div class="alert alert-danger">Status: ' + textStatus +'<br/>jqXHR: '+jqXHR+'<br/>Error thrown: '+errorThrown+'<br/>Contact <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a> for assistance.</div>';
                $('#note').html(result);
            }       
    });
}
{/literal}
</script>
</body>
</html>


