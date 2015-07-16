<?php

	/********************************************************
	General Setup
	********************************************************/
	// Required for PHP config stuff
	date_default_timezone_set('Europe/London');

	// Uncomment if you have memcache locally
        //$memcache = new Memcache;
        //$memcache->addServer('127.0.0.1', 11211);

	// FQDN (+ path if neccessary) for resources / callbacks
	$FQDN = "AnExample.website";

	// A friendly name for this shard / site
	$ShardName = "PacketFlagon HydraProxy Shard";

	//If true then all explicit urls will be https://
	//most references will be protocol-less e.g. //foo.bar/ 
	$ForceHTTPS = false;

    	// Credit - if you want to highlight you are running this proxy
    	$Credit = "";

	/********************************************************
	Proxy Shard configuration
	********************************************************/
	// A Proxy shard refers backs to RoutingPacketsIsNotACrime.uk 
	// for read/write operations
	$ProxyShard = true;

	// Used for countersigning requests see
	// https://RoutingPacketsIsNotACrime.uk/how-to/api for details
	$PacketFlagonAPIKey = "ABCDEFG";





	/********************************************************
	These settings are only required if you are *NOT* running a shard
	but are running a standalone platform
	********************************************************/

	/*
	$dbhost = 'localhost';
	$dbuser = '';
	$dbpass = '';
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysql_select_db('packetflagon');
	$S3APIKey = '';
	$S3APISecret = '';
	*/



    	/********************************************************
    	DO NOT TOUCH UNLESS YOU UNDERSTAND THE IMPLICATIONS!!!!!!
    	********************************************************/
    	$PacketFlagonRoot = "https://packetflagon.is";
    	$VerifyPeer = true;
    	$PinSSL = "";
    	$DeadHandSeed = "1234567890ABCDEFGHIJKLMNOabcdefghijklmno"; 
