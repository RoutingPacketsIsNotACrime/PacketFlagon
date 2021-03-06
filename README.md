PacketFlagon
============

The main source code for the central node PacketFlagon.is and the various shards

Install
---------------
* Clone this repo
* Create an API key by navigiating to your website and following the instructions or with ```curl https://packetflagon.is/api/1/?action=create -d "{'domain':'YOURSERVERNAME.TLD','contact':'youremail@YOURSERVERNAME.TLD'}"```
* Move libs/config.example.php to libs/config.php
* Edit various elements of libs/config.php _($FQDN, $ShardName & $PacketFlagonAPIKey at a minimum)_
* Ensure your web server is configured to respect the .htaccess and that mod_rewrite _(or equivilent)_ is enabled
* If running a standalone instance ensure you import DB_STRUCTURE.sql to your DB and set appropriate credentials in libs/config.php

Open Source Licenses
----------
| Code Path		| License	| Credit |
|-----------------------|---------------|--------|
|css/zsocial.css	| MIT		| http://zocial.smcllns.com - by Sam Collins (@smcllns) |
|css/bootstrap.css	| MIT		| Twitter Inc |
|css/fontawesome.css	| MIT		| @davegandy - http://fontawesome.io - @fontawesome |
|js/jquery.js		| MIT		| jQuery Foundation, Inc. |
|js/jquery.mousewheel	| MIT		| Brandon Aaron (http://brandonaaron.net) |
|js/jquery.touchSwipe	| MIT/GPLv2	| Matt Bryson (www.skinkers.com) |
|js/modernizr		| MIT & BSD	| - |
|js/jPages.js		| MIT		| Luís Almeida |
|font/fontawesome	| MIT		| @davegandy - http://fontawesome.io - @fontawesome |
|font/zsocial		| MIT		| Sam Collins (@smcllns) |  
|			| 		| | 
|All other code		| BSD		| Brass Horn Communications (@BrassHornComms) |
