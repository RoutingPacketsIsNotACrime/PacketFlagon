<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>{$TITLE} | About</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A brief introduction into what this website is about">
<meta name="author" content="Gareth Llewellyn @NetworkString">
<link rel="canonical" href="https://routingpacketsisnotacrime.uk/about" />
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
<link href="//{$FQDN}/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
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
				<h1>Routing Packets Is Not A Crime</h1>
					<h1 class="title">About</h1>
						<h1 class="intro">
							In 2004 the first shots were fired in the battle to <span>censor</span> the UK's access to the Internet.<br/>
It was warned that this would only be the beginning, now it's <span class="hue">time to fight back</span>.
						</h1>
					</div>
				</div>
			</div>
		<div class="container wrapper">
	<div class="inner_content">
		<div class="row pad30">
<!--col 1-->		
		<div class="col-sm-4 col-md-4">
			<div class="animated bounceInLeft"><i class="fa fa-question colour big"></i></div>
		<h2>Why?</h2>
			<p>
				In June 2004 BT took the step of <a href="http://www.theguardian.com/technology/2004/jun/06/childrensservices.childprotection">putting technical measures in place</a> that allowed them to censor the Internet.</p>

<p>At the time there was muffled dissent at the idea of creating and deploying such technology but those voices were silenced by accusations that opposition to CleanFeed was to support the abuse of children.</p>

<p>We warned that this was the start of a slippery slope.</p>

<p>In 2011 the MPA took BT to court in an attempt to block Newzbin, when the Honourable Justice Arnold understood that BT already had an Internet censorship system in place he ordered it to be used to block Newsbin</p>

<p>On the back of the Newzbin success various other private entities took to the High Court to chase more ISPs and in February 2012 the Honourable Justice Arnold <a href="http://www.bailii.org/cgi-bin/markup.cgi?doc=/ew/cases/EWHC/Ch/2012/268.html">ruled</a> that both users and the operators of TPB infringe the copyrights of the Claimants (and those they represent) in the UK.</p>

<p>The result of this ruling was that BT, TalkTalk, Sky and others were required to <em>take measures to block or at least impede access by their customers to a peer-to-peer ("P2P") file-sharing website called The Pirate Bay ("TPB").
</em></p>

<p>At the time the OpenRightsGroup issued the following statement;

<blockquote>Blocking the Pirate Bay is pointless and dangerous. It will fuel calls for further, wider and even more drastic calls for internet censorship of many kinds, from pornography to extremism.<footer>Jim Killock, Executive Director of the Open Rights Group</footer></blockquote></p>

<p>So here we are in 2014, a decade after we originally predicted the slippery slope of Internet censorship; we have Court ordered censorship at the behest of foreign private entities, secret URL blocklists courtesy of the IWF, varying levels of Internet Filtering in homes, coffee shops and restaurants, on top of all of that the City of London Police appear to be using legislation designed to tackle serious crime and fraud to intimidate and shut down proxies.</p>
			</p>
			<div class="pad25"></div>
			</div>
<!--col 2-->					
		<div class="col-sm-4 col-md-4">
			<div class="animated bounceInDown"><i class="fa fa-cogs colour big"></i></div>
		<h2>How it Works</h2>
			<p>
				The PAC file format and SOCKS5 standards have been around since ~1996. Tor has been around since 2002.
			</p>
			<p>
				The Proxy auto-config file format was originally designed by Netscape in 1996 for the Netscape Navigator 2.0 and is a text file that defines at least one JavaScript function, <span>FindProxyForURL(url, host)</span>, with two arguments: url is the URL of the object and host is the host-name derived from that URL.</p>

<p>A very simple example of a PAC file is:

<pre>function FindProxyForURL(url, host)
{
  return "PROXY proxy.example.com:8080; DIRECT";
}</pre>
This function instructs the browser to retrieve all pages through the proxy on port 8080 of the server proxy.example.com. Should this proxy fail to respond, the browser contacts the Web-site directly, without using a proxy. The latter may fail if firewalls, or other intermediary network devices, reject requests from sources other than the proxy; a common configuration in corporate networks.</p>
			</p>

		<p>
			The RoutingPacketsIsNotACrime website allows people to create their own personalised lists of URLs that should be served by the proxies which bypasses censorship.
		</p>
		<p>When a URL is added to a PAC the various servers that make up the proxy cluster fetch the updated list of allowed URLs and updates their ACLs to allow those URLs through.</p>
		<p>If a URL is removed from a PAC file <em>(and no longer exists in any other PAC config)</em> it is scheduled for removal from the proxy ACLs to ensure the proxies are not misused.</p>

		<p>URLs are checked against the <a href="https://www.openrightsgroup.org">OpenRightsGroup</a> <a href="https://blocked.org.uk">Blocked.org.uk</a> database to see if they are currently being blocked by UK ISPs and their status is displayed on the PAC view page.</a>

		<p>The Proxy servers utilise BGP <em>(Border Gateway Protocol)</em> to allow access to IP addresses announced by the UK ISPs that perform network filtering. If you receive an <strong>Access Denied</strong> message when trying to use your PAC file send a tweet to <a href="https://twitter.com/RoutingPackets">@RoutingPackets</a> or an email to <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a></p>
					<div class="pad25"></div>
				</div>
<!--col 3-->					
		<div class="col-sm-4 col-md-4">
		<div class="animated bounceInRight"><i class="fa fa-code-fork colour big"></i></div>
		<h2>Open Source</h2>
			<p>
				This software is available for free under the GPL 3.0 license and can be found <a href="https://github.com/RoutingPacketsIsNotACrime/PacketFlagon">here</a>.
			</p>
			<p>
				This website and the backend systems wouldn't have been possible without free and open source software.
			</p>
					<ul class="fa-ul">
						<li><i class="fa-li fa fa-cloud colour"></i> MySQL</li>
						<li><i class="fa-li fa fa-code colour"></i> PHP</li>
						<li><i class="fa-li fa fa-bolt colour"></i> Memcache</li>
						<li><i class="fa-li fa fa-lock colour"></i> OpenSSL</li>
						<li><i class="fa-li fa fa-wrench colour"></i> Apache</li>
						<li><i class="fa-li fa fa-desktop colour"></i> CentOS</li>
						<li><i class="fa-li fa fa-list-ul colour"></i> Squid</li>
						<li><i class="fa-li fa fa-lock colour"></i> OpenSSH</li>
						<li><i class="fa-li fa fa-lock colour"></i> Tor</li>

					</ul>

			<p>
				We've seen the rise of DRM, we've seen legislation such as the US Digital Millenium Copyright Act and the UK Digital Economy Act become law, we've seen corporations selling your information or locking you out of your software and we've seen that Governments spy on your communications as well as censor your Internet.
			</p>

			<p>
				Free and Open Source software helps to prevent these injustices, specifically, free software means users have the four essential freedoms:
<ol>
<li>to run the program,</li><li>to study and change the program in source code form,</li><li>to redistribute exact copies, and</li><li>to distribute modified versions.</li>
</ol>
			</p>

			<p>
				<ul class="fa-ul">
				<li><i class="fa-li fa fa-mobile-phone colour"></i> Ditch your iPhone or Windows for an Android phone flashed with a 3rd party ROM</li>
				<li><i class="fa-li fa fa-laptop colour"></i> Ditch your Apple OS for a compatible version of Linux</li>
				<li><i class="fa-li fa fa-windows colour"></i> Ditch your Windows OS and experiment with a Linux distribution</li>
				</ul>
			</p>

			<p>
				Consider joining the <a href="https://www.openrightsgroup.org/">OpenRightsGroup</a> that exists to preserve and promote your rights in the digital age. They are funded by over 2,400 people like you.
				<br/><br/>
				<img src="/img/org-logo.png"/>
			</p>

				<div class="pad25"></div>
				</div>
					</div>
					
				<div class="row">
					<div class="col-md-8">
					
					<!--skill bars-->
						<h2>Proxy Server Bandwidth Utilisation</h2>
						<p>Each server has 24Gb of RAM for content caching and a 1Gbit uplink with both IPv4 and IPv6 addresses</p>
						<p>Bandwidth statistics are updated every 60 seconds.</p>

					<table class="table table-striped" style="text-align:center;">
                     				<thead>
                         				<tr>
                            					<th>Server</th>
                            					<th>Bandwidth</th>
                            					<th>Last ACL Sync</th>
                            					<th>Status</th>
                          				</tr>
                        			</thead>
                        			<tbody>
                                    {section name=proxy loop=$PROXIES}
                                    <tr>
                                                <td>{$PROXIES[proxy].id}</td>
                                                <td style="width:60%"><div class="progress"><div class="bar" data-percentage="{$PROXIES[proxy].bw}"></div></div></td>
                                                <td>{$PROXIES[proxy].sync}</td>
                                                <td>
                                                {if {$PROXIES[proxy].status} eq 'ok'}
                                                {include file='proxy_status_ok.tpl'}
                                                {else}
                                                {include file='proxy_status_pending.tpl'}
                                                {/if}

                                                </td>
                                    </tr>
                                    {/section}

                        			</tbody>
                      			</table>
                    {$ERROR}
				</div>
				
				<!--testimonial-->
				<div class="col-md-4 pad25">

					<div class="alert alert-warning"><span>WARNING:</span> You should not trust <em>any</em> public proxies as they <em>could</em> be used to evesdrop on your traffic.</div>
					<div class="pad45 hidden-md hidden-lg"></div>

					<div class="alert alert-warning"><span>NOTE:</span> These proxies will <strong>NOT</strong> improve your privacy, they will not cloak you. The <a href="https://en.wikipedia.org/wiki/X-Forwarded-For">X-Forwarded-For</a> header <strong>is</strong> set.<br/>
Consider using <a href="https://www.torproject.org">Tor</a> and read up on how to ensure your privacy as well as bypassing censorship</div>
                                        <div class="pad45 hidden-md hidden-lg"></div>
				</div>
			</div>
				</div>
					</div>
					
			<!--strip-->
				<div class="strip">
					<h1 class="center">Got Questions</h1>
					<h3 class="center about_strip">
						If you have any other questions about this project then feel free to get in touch by sending an email to <a href="mailto:Security@RoutingPacketsIsNotACrime.uk">Security@RoutingPacketsIsNotACrime.uk</a> or via Twitter;
					</h3>
					<a href="https://twitter.com/RoutingPackets" class="big_button">Send a Tweet</a>
				</div>
			<!--/strip-->
				
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
				
<!-- scripts -->
<script src="//{$FQDN}/js/jquery.js"></script>			
<script src="//{$FQDN}/js/bootstrap.min.js"></script>
<script src="//{$FQDN}/js/retina.js"></script>
<script type="text/javascript" src="//{$FQDN}/js/scripts.js"></script>
<!-- skills -->
<script>
//<![CDATA[
 setTimeout(function(){
 $('.progress .bar').each(function() {
            var me = $(this);
            var perc = me.attr("data-percentage");
			 var current_perc = 0;
			var progress = setInterval(function() {
                if (current_perc>=perc) {
                    clearInterval(progress);
                } else {
                    current_perc +=1;
                    me.css('width', (current_perc)+'%');
                }
				me.text((current_perc)+'%');
			}, 20);
		});
	},300);


	$("[data-rel=popover]").hover(function(){
	$(this).popover('toggle');
	});
	 //]]>
</script>
					
</body>
</html>
