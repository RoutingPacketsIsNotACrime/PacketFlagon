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

	$Hash = $_GET['hash'];

	$API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
	$PACDetails = $API->GetPACDetails($Hash);

	if($PACDetails['success'] == false || $PACDetails['success'] == 0)
	{
		$Description = "";
                $FriendlyName = "";
                $Tor = false;
                $Ro = false;;
                $URLs = array();

	}
	else
	{
		//print_r($PACDetails);
		$Description = $PACDetails['description'];
		$FriendlyName = $PACDetails['friendlyname'];
		$Tor = $PACDetails['localproxy'];
		$Ro = $PACDetails['ro'];
		$URLs = $PACDetails['urls'];
	}

	if(empty($Description))
	{
		$MetaDesc = "Details about $Hash";
	}
	else
	{
		$MetaDesc = $Description . "( $Hash )";
	}

	if(empty($FriendlyName))
	{
		$FriendlyName = "Custom PAC: $Hash";
	}

	if($Tor)
	{
		$TorIcon = 'fa-check-square-o';
		$ProxyIcon = 'fa-square-o';
	}
        else
        {
                $TorIcon = 'fa-square-o';
                $ProxyIcon = 'fa-check-square-o';
        }

        if($Ro)
        {
                $RoIcon = 'fa-check-square-o';
        }
        else
        {
                $RoIcon = 'fa-square-o';
        }

	$SectionURLs = array();

	foreach($URLs as $ID => $urlMeta)
	{
		$blocked = 'fa-arrows-h" style="color:green';
		$ToolTip = 'Not detected as blocked by blocked.org.uk';

		if($urlMeta['blocked'])
		{
			$blocked = 'fa-warning" style="color:red"';
			$ToolTip = 'Detected as blocked by at least 1 ISP by blocked.org.uk';
		}

		$SectionURLs[] = array('id' => $ID, 'url' => $urlMeta['url'], 'tooltip' => $ToolTip, 'blocked' => $blocked);
	}


	/*$smarty->assign('HASH',$Hash);
	$smarty->assign('FRIENDLYNAME',$FriendlyName);
	$smarty->assign('DESCRIPTION',$Description);
	$smarty->assign('METADESC', $MetaDesc);
	$smarty->assign('TORICON',$TorIcon);
	$smarty->assign('PROXYICON',$ProxyIcon);
	$smarty->assign('ROICON',$RoIcon);
	$smarty->assign('URLS',$SectionURLs);

	$smarty->display('view.tpl');*/
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php print($ShardName); ?> | <?php print($Hash); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php print($MetaDesc); ?>">
<meta name="author" content="Unknown">
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
<link rel="stylesheet" href="//<?php print($FQDN); ?>/css/nerveslider.css">
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
				<a href="//<?php print($FQDN); ?>/"><img src="//<?php print($FQDN); ?>/img/logo.png" alt="" class="animated bounceInDown" /></a> 
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
				<h1>The Net interprets censorship as damage and routes around it.</h1>
					<h1 class="title"><?php print($FriendlyName); ?></h1>
						<h1 class="intro">
						<?php print($Description); ?>
						</h1>
					</div>
				</div>
			</div>
		<div class="container wrapper">
	<div class="inner_content">
	
	<!-- sidebar -->
		<div class="row pad30">
			<div class="col-md-3">
			 <h4><span>Meta Details:</span></h4>
				<p>Some PAC files have custom configurations, check that this one does what you expect:</p>
				
				<ul class="fa-ul">
					<li><i class="fa-li fa <?php print($TorIcon); ?> colour"></i> Uses a local Proxy?</li>
					<li><i class="fa-li fa <?php print($ProxyIcon); ?> colour"></i> Uses our Public Proxies?</li>
					<li><i class="fa-li fa <?php print($RoIcon); ?> colour"></i> Password protected?</li>
				</ul>
				
				<div class="alert alert-warning"><span>Warning:</span> Ensure you check all the URLs this proxy file is redirecting. Your privacy is at risk!</div>			
	
				<div class="pad10"></div>
		
			<h4><span>Share this PAC</span></h4>
			<a href="//twitter.com/share" class="twitter-share-button" data-text="This Proxy file bypasses Net censorship" data-via="RoutingPackets" data-size="large" data-related="NetworkString" data-hashtags="RoutingPacketsIsNotACrime">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> 

			<div class="pad10"></div>

                        <h4><span>Clone this PAC</span></h4>
			<p>Cloning this PAC allows you to create your own version, add or remove URLs, set your own password etc. It does not affect the original version.</p>

			<a href="//<?php print($FQDN); ?>/create/<?php print($Hash);?>"><button type="button" class="btn btn-primary btn-lg"><i class="fa fa-code-fork"></i> &nbsp; Clone</button></a>

			<div class="pad15"></div>
			
			<h4><span>Push PAC to Amazon S3</span></h4>
                        <p>Pushing this PAC file to Amazons S3 cloud storage platform creates a unique URL that makes it more difficult for ISPs to block.</p>

                        <a href="javascript:void(0)" onclick="PushToS3('<?php print($Hash); ?>');"><button type="button" class="btn btn-primary btn-lg"><i class="fa fa-cloud-upload"></i> &nbsp; Push to S3</button></a>

				
			<div class="pad15"></div>

			<h4><span>Edit Controls:</span></h4>	
				<p>If you know the password for this PAC ensure you enter it below before attempting to make any changes.</p>
				

				<input type="password" id="edit_password" placeholder="Password (if set)"></input>

				<div class="pad15"></div>

				<p>
					<!-- <a href="//twitter.com/PacketFlagon" class="zocial icon twitter"></a>  -->
				</p>		
					</div>
			
			<div class="col-md-9 pad15">
			<!-- sidebar -->
			
			<h2><span>PAC: <?php print($Hash); ?></span></h2>
			
			<p>
				The unique URL to add to your browser proxy configuration is:<br/><strong>https://<?php print($FQDN); ?>/pac/<?php print($Hash); ?></strong>
			</p>
			
			<p>
				By adding this PAC file to your browsers Proxy configuration the URLs listed below will be proxied through our servers which in most cases will bypass any blocking.
			</p>

			<p>
				See the how-to section for advice on how to do this.
			</p>
			<?php
				if($PACDetails['success'] === false)
				{
					print('<div class="alert alert-danger"><strong>Error</strong> A problem was encountered fetching the PAC details:<br/>' . $PACDetails['message'] .'</div>');
				}
			?>

			<!-- URLS -->
			<div class="col-md-6">
				<span>URLs in this PAC File:</span>
				<table class="table table-striped">
                     			<thead>
                         			<tr>
                            			<th>#</th>
                            			<th style="width:60%;">URL</th>
						<th style="text-align:center;">Blocked<br/>by ISPs?</th>
                            			<th style="text-align:center;">Remove</th>
                          			</tr>
                        		</thead>
                        		<tbody>
						<?php
						foreach($SectionURLs as $ID => $URLMeta)
						{
							print("\t\t\t\t<tr id=\"row-$ID\">\n");
							print("\t\t\t\t<td>$ID</td>\n");
							print("\t\t\t\t<td>{$URLMeta['url']}</td>\n");
							print("\t\t\t\t".'<td style="text-align:center;"><a href="javascript:void(0)" data-rel="tooltip" data-placement="right" title="'.$URLMeta['tooltip'].'"><i class="fa '.$URLMeta['blocked'].'"></i></a></td>'."\n");
							print("\t\t\t\t"."<td style=\"text-align:center;\"><a href=\"javascript:void(0)\" onclick=\"RemoveURL('{$URLMeta['url']}',$ID,'$Hash');\"><i class=\"fa fa-chain-broken\"></i></a></td>\n");
							print("\t\t\t\t</tr>\n");
						}
						?>

					</tbody>
                      		</table>
				
				<div class="pagination">
                        		<ul>
                          			<li class="disabled"><a href="#">&laquo;</a></li>
                          			<li class="active"><a href="#">1</a></li>
                          			<!--<li><a href="#">2</a></li>
                          			<li><a href="#">3</a></li>
                          			<li><a href="#">4</a></li>-->
                          			<li class="disabled"><a href="#">&raquo;</a></li>
                        		</ul>
                     		</div>
			</div>
			<!-- End URLS -->

			<!-- Add URLs -->
			<div class="col-md-6">
				<span>Add Additional URLs</span>
                       		<div class="contact_form">
                                        <div id="fields">
                                		<form id="ajax-contact-form">
                                                	<textarea name="urls" id="urls" placeholder="A comma separated list of domains e.g.
google.com, facebook.com, thepiratebay.org" class="col-xs-12 col-sm-12 col-md-12" ></textarea>

                                                <div class="clear"></div>
					
					<a href="javascript:void(0)" onclick="AddURLs('<?php print($Hash);?>');"><button type="button" class="btn btn-primary btn-lg">Add URLs</button></a>
					</div>
				</div>
				<br/>
				<div id="note"></div>
			</div>
			<!-- End Add URLs -->
		
			<!-- Comments -->
	                <div class="col-md-12 pad15" id="disqus_thread"><button type="button" onclick="loadComments();" class="btn btn-warning">Load Comments</button></div>
        	        <!-- /coments -->	
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
						ISP blocking information provided by the <a href="//www.openrightsgroup.org/">OpenRightsGroup</a> | #RoutingPacketsIsNotACrime		
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
<script src="//<?php print($FQDN); ?>/js/bootstrap.min.js"></script>
<script src="//<?php print($FQDN); ?>/js/retina.js"></script>
<script type="text/javascript" src="//<?php print($FQDN); ?>/js/scripts.js"></script>
 
<script type="text/javascript">
	$(document).ready(function()
	{

		if(typeof(Storage) !== "undefined")
		{
			var password = localStorage.getItem('<?php print($Hash); ?>');
			if(password != "undefined")
			{
				$("#edit_password").val(password);
			}
		}
		
		return false;	
	});

	 var disqus_shortname = 'routingpacketsisnotacrime';
	
        /*(function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();*/
	function loadComments()
	{
		var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            	dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            	(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	}
</script>
 
        <script type="text/javascript">
function RemoveURL(URL,ID,H)
{

        var combinedObj = {'password': $("#edit_password").val(), 'url': URL, 'update': 'remove_url', 'ID': ID, 'hash': H };
        var str = "hello";
        $.ajax({
type: "POST",
url: "http://<?php print($FQDN); ?>/update_pac.php",
data: combinedObj,
contentType: "application/x-www-form-urlencoded",
success: function(msg)
{
var jsonMsg = $.parseJSON(msg);
if(jsonMsg.success)
{
result = '<div id="notif" class="notification_ok">URL removed, it will take up to 5 minutes for all proxy servers to update.</div>';
$("#row-"+ID).fadeOut(2000);
}
else
{
result = '<div class="alert alert-danger">' + jsonMsg.message +'</div>'
}
$('#note').html(result);
window.setInterval(function(){$('#notif').fadeOut(2000); window.clearInterval(this);}, 5000);
},
error: function(a, b, c)
{
        console.log(a);
        console.log(b);
        console.log(c);
}
});
}

function AddURLs(H)
{
        var combinedObj = {'password': $("#edit_password").val(), 'urls': $("#urls").val(), 'update': 'add_url', 'hash': H };
        $.ajax({
type: "POST",
url: "//<?php print($FQDN); ?>/update_pac.php",
data: combinedObj,
contentType: "application/x-www-form-urlencoded",
success: function(msg)
{
var jsonMsg = $.parseJSON(msg);
if(jsonMsg.success)
{
result = '<div class="notification_ok">Your additional URLs have been added, it will take a few minutes for all PAC and proxy servers to update.</div>';
}
else
{
result = '<div class="alert alert-danger">' + jsonMsg.message +'</div>'
}
$('#note').html(result);
},
error: function(a, b, c)
{
console.log(a);
console.log(b);
console.log(c);
}
});

}

function PushToS3(H)
{
        var combinedObj = {'hash': H };
        $.ajax({
type: "POST",
url: "//<?php print($FQDN); ?>/put_to_s3.php",
data: combinedObj,
contentType: "application/x-www-form-urlencoded",
success: function(msg)
{
var jsonMsg = $.parseJSON(msg);
if(jsonMsg.success)
{
result = '<div class="notification_ok" style="text-transform: none !important;">Your PAC has been pushed to S3 and your URL is: <a href="'+jsonMsg.url+'">'+ jsonMsg.url+ '</a></div>';
}
else
{
result = '<div class="alert alert-danger">' + jsonMsg.message +'<br/>Contact <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a> for assistance.</div>'
}
$('#note').html(result);
}
});

}

</script>


</body>
</html>
