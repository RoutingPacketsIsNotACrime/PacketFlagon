<span style="width:100%; text-align: center;"><img src="//{$FQDN}/img/hydra.jpg" alt="" title="Graphic depicting the mythical hydra" /></span>

<h2><span>Proactively Avoid Blocks using Amazon S3</span></h2>
<p>
    The easiest way to avoid an ISP blocking a particular ProxyShard causing you issues is to save a copy of your PAC file to Amazon's S3 file storage cloud.
</p>
<p>
    ISPs can't risk blocking S3 due to it's massive scale and use by lots of other websites. Since S3 URLs natively support SSL they can't inspect the HTTP Host header or GET path to block.
</p>
<p>
    To push your PAC file to S3 is easy;
    <ul>
        <li>Navigate to your PAC files view page <em>(e.g. http://thisproxykillsfacists.uk<strong>/view/</strong>b718ce9b276bc2f10af90fe1d5b33c0d )</em></li>
        <li>Look on the left hand side (or near the bottom on smaller screens) for the <strong>Push PAC to Amazon S3</strong> section</li>
        <li>Click the <button type="button" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> &nbsp; Push to S3</button> button</li>
        <li>Done! After a short delay your personalised, SSL secured Amazon S3 bucket and PAC file will be created and the unique URL will be displayed</li>
    </ul>
</p>

<h2><span>Using DNS</span></h2>
<p>
    ISP DNS interference seems to be restricted to A and CNAME records so in order to find alternate ProxyShards PacketFlagon publishes a list of alternate frontends and proxies using SRV and TXT records.
</p>
<h4>Find Alternate ProxyShards with TXT Records</h4>
<p>
At a command prompt issue the following;
<code>nslookup -type=txt shards.packetflagon.is</code>
or
<code>dig -t txt shards.packetflagon.is</code>
</p>
<p>
You should receive a CSV list of domains <em>(excluding the http(s) prefix)</em> that are vetted PacketFlagon ProxyShards.
</p>
<pre>
$ dig -t txt shards.packetflagon.is

; <<>> DiG 9.8.2rc1-RedHat-9.8.2-0.23.rc1.el6_5.1 <<>> -t txt shards.packetflagon.is
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 2603
;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 0

;; QUESTION SECTION:
;shards.packetflagon.is.         IN      TXT

;; ANSWER SECTION:
shards.packetflagon.is.  10799   IN      TXT     "routingpacketsisnotacrime.uk,thisproxykillscensors.uk"

;; Query time: 57 msec
;; SERVER: 8.8.8.8#53(8.8.8.8)
;; WHEN: Thu Oct  2 15:37:26 2014
;; MSG SIZE  rcvd: 103
</pre>

<h4>Find PacketFlagon Proxies</h4>
<p>
At a command prompt issue the following;
<code>nslookup -type=SRV _proxy._tcp.packetflagon.is</code>
or
<code>dig -t SRV _proxy._tcp.packetflagon.is</code>
</p>
<p>
You should receive an RFC compliant SRV response that are vetted PacketFlagon proxies, their ports and priorities.
</p>
<h5>Windows nslookup Response</h5>
<pre>
>nslookup -type=srv _proxy._tcp.packetflagon.is
Server:  google-public-dns-a.google.com
Address:  2001:4860:4860::8888

Non-authoritative answer:
_proxy._tcp.packetflagon.is     SRV service location:
          priority       = 0
          weight         = 5
          port           = 8080
          svr hostname   = proxy-1-1.packetflagon.is
_proxy._tcp.packetflagon.is     SRV service location:
          priority       = 0
          weight         = 15
          port           = 8080
          svr hostname   = proxy-1-2.packetflagon.is
</pre>

<h5>Linux Dig Response</h5>
<pre>
$ dig -t srv _proxy._tcp.packetflagon.is

; <<>> DiG 9.8.2rc1-RedHat-9.8.2-0.23.rc1.el6_5.1 <<>> -t srv _proxy._tcp.packetflagon.is
;; global options: +cmd
;; Got answer:
;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 31975
;; flags: qr rd ra; QUERY: 1, ANSWER: 2, AUTHORITY: 0, ADDITIONAL: 0

;; QUESTION SECTION:
;_proxy._tcp.packetflagon.is.   IN      SRV

;; ANSWER SECTION:
_proxy._tcp.packetflagon.is. 10799 IN   SRV     0 15 8080 proxy-1-2.packetflagon.is.
_proxy._tcp.packetflagon.is. 10799 IN   SRV     0 5 8080 proxy-1-1.packetflagon.is.

;; Query time: 426 msec
;; SERVER: 8.8.8.8#53(8.8.8.8)
;; WHEN: Thu Oct  2 15:36:33 2014
;; MSG SIZE  rcvd: 135

</pre>


<h2><span>Twitter</span></h2>
<p>In the event a block is detected it will be announced by the RPINAC Deadhand software and a new URL will be tweeted with the hashtag <a href="https://twitter.com/search?f=realtime&q=%23PacketFlagon&src=typd">#PacketFlagon</a></p>
<p>Anyone running their own PacketFlagon shard <em>(or an independant platform)</em> is also encouraged to use the <a href="https://twitter.com/search?f=realtime&q=%23PacketFlagon&src=typd">#PacketFlagon</a> hashtag.</p>
