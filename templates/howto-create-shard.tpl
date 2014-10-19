<img style="width:80%;" src="//{$FQDN}/img/create-shard.jpg" alt="computer servers" title="Graphic depicting some servers in a data center" />

<h2>Manually Deploying with GitHub Checkout</h2>
<ul>
<li>Configure your webserver to allow .htaccess files e.g.;
<pre>
&lt;VirtualHost *:80>
    ServerAdmin security@packetflagon.is
    DocumentRoot /HighIO/www/domains/YOURSERVERNAME
    ServerName YOURSERVERNAME.TLD
    ServerAlias www.YOURSERVERNAME.TLD
    ErrorLog logs/YOURSERVERNAME-error_log
    CustomLog logs/YOURSERVERNAME-access_log common

    &lt;Directory />
      Options FollowSymLinks
      AllowOverride All
    &lt;/Directory>

&lt;/VirtualHost>
</pre></li>
<li>Checkout the repo; <code>git clone https://github.com/RoutingPacketsIsNotACrime/PacketFlagon.git /HighIO/www/domains/YOURSERVERNAME/</code> with your own</li>
<li>Generate a new API key {literal}<code>curl https://packetflagon.is/api/create -d "{'domain':'YOURSERVERNAME.TLD','contact':'youremail@YOURSERVERNAME.TLD'}"</code>{/literal}</li>
<li>Edit the <code>libs/config.sample.php</code> and save as <code>libs/config.php</code></li>
<li>Restart your webserver</li>
<li>Done!</li>
</ul>

<h2>Automation with Chef</h2>
<ul>
<li>Checkout and merge the PacketFlagon automation repository; <code>git clone https://github.com/RoutingPacketsIsNotACrime/Automation</code></li>
<li>Generate a new API key {literal}<code>curl https://packetflagon.is/api/create -d "{'domain':'YOURSERVERNAME.TLD','contact':'youremail@YOURSERVERNAME.TLD'}"</code>{/literal}</li>
<li>Edit the attributes for the node or role that will have the <code>packetflagon_frontend</code> applied to include;
<pre>{literal}
default_attributes(
    "packetflagon" => {
        "fqdn" => "YOURSERVERNAME.TLD",
        "shard-name" => "FRIENDLY NAME FOR YOUR SHARD",
        "force-https" => false,
        "credit" => "YOUR NAME",
        "apikey" => "YOUR API KEY FROM CURL"
    }
){/literal}</pre></li>
<li>Apply the <code>packetflagon_frontend</code> role to the node in question</li>
<li>Run chef client</li>
<li>Done!</li>
</ul>
