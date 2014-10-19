<img src="//{$FQDN}/img/cables.jpg" alt="Picture of fibres in a switch" title="Fibre optic cables" />

<h2>Acquiring a Server</h2>
<p>
If you are on a budget then pay a visit to <a href="http://www.lowendbox.com">LowEndBox.com</a> which regularly feature small virtual machine instances <em>(e.g. 128Mb of RAM)</em> for as little as &pound;5 a year.
</p>
<p>Otherwise a good choice is <a href="https://www.digitalocean.com/">DigitalOcean</a> who offer a small VM with 1Tb of transfer for only &dollar;5 (&pound;3) a month.</p>

<p>DigitalOcean have a good tutorial on getting started with their service available <a href="https://www.digitalocean.com/community/tutorials/how-to-create-your-first-digitalocean-droplet-virtual-server">here.</a></p>

<p>There is the possibility PacketFlagon will start offering shell accounts directly in the near future</p>

<h2>Windows using Putty</h2>
<p>
Unfortunately it is <a href="http://noncombatant.org/2014/03/03/downloading-software-safely-is-nearly-impossible/">difficult to download putty securely</a> but putting that aside it <strong>can</strong> be downloaded from <a href="http://www.chiark.greenend.org.uk/~sgtatham/putty/">here</a>.
</p>

<p>
Once installed load it up and add the IP address of your server into the hostname textbox of the Session screen.
<br/>
<img width="30%" src="//{$FQDN}/img/putty_1.jpg"/>
</p>

<p>
Then on the left hand side expand the SSH section and select Tunnels.
<br/>
<img width="30%" src="//{$FQDN}/img/putty_2.jpg"/>
</p>

<p>
In the Tunnels section set the Source port to be 9050 and the <strong>Destination</strong> to be <strong>Dynamic</strong>, click <strong>Add</strong> so <strong>D9050</strong> appears in the textbox and then click <strong>Open</strong>.
<br/>
<img width="30%" src="//{$FQDN}/img/putty_3.jpg"/>
</p>

<p>
You'll be informed that the authenticity of the host can't be established which is true because you don't know what the RSA key fingerprint is. You can choose to accept it and continue or be paranoid and bail. If you chose to continue you will be prompted for you password that was sent by email.
</p>

<p>
You can now configure your PAC file to use a local SOCKS5 proxy and your selected websites will route through your server!
</p>


<h2>Linux using OpenSSH</h2>
<p>
Assuming you are logged into your Linux computer load up a terminal.
<br/>
<a class="lightbox" href="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_1.png"><img class="aligncenter size-medium wp-image-137" alt="terminal_1" src="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_1-300x215.png" width="300" height="215" /></a><br/>
Type the following;
<code>ssh -D 9050 root@xx.xx.xx.xx</code> <em>(Replace the IP address with your own)</em>
</p>
<p>
You'll be informed that the authenticity of the host can't be established which is true because you don't know what the RSA key fingerprint is. You can choose to accept it and continue or be paranoid and bail. If you chose to continue you will be prompted for you password that was sent by email.<br/>
<a class="lightbox" href="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_2.png"><img class="aligncenter size-medium wp-image-142" alt="terminal_2" src="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_2-300x215.png" width="300" height="215" /></a>
</p>

<p>
Load up another terminal <em>(or a tab)</em> and type the following;
<br/>
<code>curl --socks5-hostname 127.0.0.1:9050 http://wtfismyip.com/json</code>
</p>
<p>
You should see the following output indicating that your ISP is <strong>Digital Ocean</strong>.
<br/>
<a class="lightbox" href="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_3.png"><img class="aligncenter size-medium wp-image-140" alt="terminal_3" src="https://survivetheclaireperryinter.net/wp-content/uploads/2014/01/terminal_3-300x215.png" width="300" height="215" /></a>
</p>

<p>
You can now configure your PAC file to use a local SOCKS5 proxy and your selected websites will route through your server!
</p>

