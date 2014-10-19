<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{$TITLE} | {$HASH}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{$METADESC}">
<meta name="author" content="Unknown">
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
<link rel="stylesheet" href="//{$FQDN}/css/nerveslider.css">
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
				<a href="//{$FQDN}/"><img src="//{$FQDN}/img/logo.png" alt="" class="animated bounceInDown" /></a> 
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
				<h1>The Net interprets censorship as damage and routes around it.</h1>
					<h1 class="title">{$FRIENDLYNAME}</h1>
						<h1 class="intro">
							{$DESCRIPTION}
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
					<li><i class="fa-li fa {$TORICON} colour"></i> Uses a local Proxy?</li>
					<li><i class="fa-li fa {$PROXYICON} colour"></i> Uses our Public Proxies?</li>
					<li><i class="fa-li fa {$ROICON} colour"></i> Password protected?</li>
				</ul>
				
				<div class="alert alert-warning"><span>Warning:</span> Ensure you check all the URLs this proxy file is redirecting. Your privacy is at risk!</div>			
	
				<div class="pad10"></div>
		
			<h4><span>Share this PAC</span></h4>
			<a href="//twitter.com/share" class="twitter-share-button" data-text="This Proxy file bypasses Net censorship" data-via="RoutingPackets" data-size="large" data-related="NetworkString" data-hashtags="RoutingPacketsIsNotACrime">Tweet</a>
{literal}<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>{/literal} 

			<div class="pad10"></div>

                        <h4><span>Clone this PAC</span></h4>
			<p>Cloning this PAC allows you to create your own version, add or remove URLs, set your own password etc. It does not affect the original version.</p>

			<a href="//{$FQDN}/create/{$HASH}"><button type="button" class="btn btn-primary btn-lg"><i class="fa fa-code-fork"></i> &nbsp; Clone</button></a>

			<div class="pad15"></div>
			
			<h4><span>Push PAC to Amazon S3</span></h4>
                        <p>Pushing this PAC file to Amazons S3 cloud storage platform creates a unique URL that makes it more difficult for ISPs to block.</p>

                        <a href="javascript:void(0)" onclick="PushToS3('{$HASH}');"><button type="button" class="btn btn-primary btn-lg"><i class="fa fa-cloud-upload"></i> &nbsp; Push to S3</button></a>

				
			<div class="pad15"></div>

			<h4><span>Edit Controls:</span></h4>	
				<p>If you know the password for this PAC ensure you enter it below before attempting to make any changes.</p>
				

				<input type="password" id="edit_password" placeholder="Password (if set)"></input>

				<div class="pad15"></div>

				<p>
					<!-- <a href="//twitter.com/RoutingPackets" class="zocial icon twitter"></a>  -->
				</p>		
					</div>
			
			<div class="col-md-9 pad15">
			<!-- sidebar -->
			
			<h2><span>PAC: {$HASH}</span></h2>
			
			<p>
				The unique URL to add to your browser proxy configuration is:<br/><strong>{$PROTO}://{$FQDN}/pac/{$HASH}</strong>
			</p>
			
			<p>
				By adding this PAC file to your browsers Proxy configuration the URLs listed below will be proxied through our servers which in most cases will bypass any blocking.
			</p>

			<p>
				See the how-to section for advice on how to do this.
			</p>
            {$ERROR}

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

                                {section name=url loop=$URLS}
                                <tr id="row-{$URLS[url].id}">
                                    <td>{$URLS[url].id}</td>
                                    <td>{$URLS[url].url}</td>
                                    <td style="text-align:center;"><a href="javascript:void(0)" data-rel="tooltip" data-placement="right" title="{$URLS[url].tooltip}"><i class="fa {$URLS[url].blocked}"></i></a></td>
                                    <td style="text-align:center;"><a href="javascript:void(0)" onclick="RemoveURL('{$URLS[url].url}',{$URLS[url].id},'{$HASH}');"><i class="fa fa-chain-broken"></i></a></td>
                                </tr>
                                {/section}
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
					
					<a href="javascript:void(0)" onclick="AddURLs('{$HASH}');"><button type="button" class="btn btn-primary btn-lg">Add URLs</button></a>
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
<script src="//{$FQDN}/js/jquery.js"></script>	
<script src="//{$FQDN}/js/bootstrap.min.js"></script>
<script src="//{$FQDN}/js/retina.js"></script>
<script type="text/javascript" src="//{$FQDN}/js/scripts.js"></script>
{literal} 
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
{/literal} 
{include file='view_scripts.tpl'}
</body>
</html>

