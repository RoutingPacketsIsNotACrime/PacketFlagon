<?php

class API
{
	private $APIKey = "";
	private $FQDN = "";
	private $PFRoot = "";
	private $ProxyShard = true;

	function __construct($key, $fqdn,$root,$shard)
	{
		$this->APIKey = $key;
		$this->FQDN = $fqdn;
		$this->PFRoot = $root;
		$this->ProxyShard = $shard;
	}

	function ConfirmAuth($AuthHash, $api, $Seed)
	{
		//$calc = md5($api . $Seed);
		$Query = "select id from shards where apikey = '$api'";
        	$result = mysql_query($Query);
		
		//print("Srv " . $api . " | Auth: ". md5($api . $Seed) . " | Seed: " . $api . $Seed . "<br/>");
		//print("$AuthHash<br/>".md5($api . $Seed));
	
        	if(mysql_errno() == 0 && mysql_num_rows($result) >= 1)
        	{
            		return ($AuthHash == md5($api . $Seed));
        	}
        	else
        	{
            		return false;
        	}
	}

   	function RegisterShard($FQDN,$Contact)
    	{
        	$Query = "select id from shards where fqdn = '$FQDN'";
        	$result = mysql_query($Query);

        	if(mysql_errno() == 0 && mysql_num_rows($result) == 0)
        	{
            		$APIKey = md5("$FQDN - $Contact " . date('Y-m-d-h-i-s'));
            		$Query = "insert into shards (fqdn,contact,apikey) VALUES ('$FQDN','$Contact','$APIKey')";
            		$result = mysql_query($Query);

            		if(mysql_errno() == 0)
            		{
                		return array('success' => true, 'apikey' => $APIKey);
            		}
            		else
            		{
                		return array('success' => false, 'message' => 'There was an error adding that to mysql');
            		}
        	}
        	else
        	{
            		return array('success' => false, 'message' => 'That FQDN was already registered');
        	}
    	}

    /****
    
    ****/
	function CreatePAC($Name,$Desc,$Password,$URLs,$UseTor)
	{
        $return = array('success' => 'fail', 'hash' => 'ABCDEF','message'=>'Information wants to be free');

		if($this->ProxyShard)
		{
			$Payload = array('friendlyname' => $Name, 'description' => $Desc, 'password' => $Password, 'urls' => $URLS,'localproxy' => $UseTor, 'auth' => md5($this->APIKey . $URLS), 'api' => $this->APIKey);
			$return = $this->MakeRequest($Payload,'create_pac');
		}
		else
		{
			$Query = "insert into pac (hash,name,description,password,ro,urls,tor) VALUES ('$MD5', '$Name','$Desc','$Password',$Ro,'$URLs',$UseTor)";
			$result = mysql_query($Query);

			if(mysql_errno() == 0)
			{
				$return['hash'] = $MD5;
				$return['message'] = "Success!";
			}
			else
			{
				$return['hash'] = "";
				$return['success'] = "fail";
				$return['message'] = mysql_error();
			}
		}
		return $return;
	}

    function AddURLToPAC($_URL,$_Hash,$_Password)
    {
        $return = array('success' => 'fail', 'hash' => '','message'=>'Add URL failed');

        if($this->ProxyShard)
        {
            $Payload = array('urls' => $_URL, 'hash' => $_Hash, 'password' => $_Password, 'api' => $this->APIKey);
            $return = $this->MakeRequest($Payload,'add_url_to_pac');
        }
        else
        {
            $Query = "select urls from pac where hash = '$_Hash' AND password = '$_Password'";
            $result = mysql_query($Query);

            if(mysql_num_rows($result) == 0)
            {
                $return['success'] = "fail";
                unset($return['hash']);
                $return['message'] = 'Password does not match';
            }
            else
            {
                $PAC = mysql_fetch_assoc($result);
                $URLs = unserialize($PAC['urls']);
                $URLsArray = explode(",", $_URL);

                foreach($URLsArray as $URL)
                {
                        $urlMeta = getHost($URL);
                        if(!empty($urlMeta))
                        {
                                $URLs[] = $urlMeta;
                        }
                }
                sort($URLs);

                $URLs = serialize($URLs);
                $Query = "update pac set urls = '$URLs' where hash = '$_Hash' and password = '$_Password'";
                $result = mysql_query($Query);

                if(mysql_errno() == 0)
                {
                    $return['hash'] = $Hash;
                    $return['message'] = "URL(s) added successfully!";
                }
                else
                {
                    $return['success'] = "fail";
                    unset($return['hash']);
                    $return['message'] = mysql_error();
                }
            }
        }

        return $return;
    }



    function RemoveURLFromPAC($_URL,$_Hash,$_Password)
    {

        $return = array('success' => 'fail', 'hash' => '','message'=>'Removing URL failed');

        if($this->ProxyShard)
        {
            $Payload = array('url' => $_URL, 'hash' => $_Hash, 'password' => $_Password, 'api' => $this->APIKey);
            $return = $this->MakeRequest($Payload,'remove_url_from_pac');
        }
        else
        {
            $Query = "select urls from pac where hash = '$_Hash' AND password = '$_Password'";
            $result = mysql_query($Query);

            if(mysql_num_rows($result) == 0)
            {
                $return['success'] = "fail";
                unset($return['hash']);
                $return['message'] = 'Password does not match';
            }
            else
            {
                $PAC = mysql_fetch_assoc($result);
                $URLs = unserialize($PAC['urls']);

                foreach($URLs as $ID => $dbURL)
                {
                    if($_URL == $dbURL)
                    {
                        unset($URLs[$ID]);
                        break;
                    }
                }

                sort($URLs);

                $URLs = serialize($URLs);

                $Query = "update pac set urls = '$URLs' where hash = '$_Hash' AND password = '$_Password'";
                $result = mysql_query($Query);

                if(mysql_errno() == 0)
                {
                    $return['hash'] = $Hash;
                    $return['message'] = "URL(s) removed successfully!";
                }
                else
                {
                    $return['success'] = "fail";
                    unset($return['hash']);
                    $return['message'] = mysql_error();
                }
            }
        }

        return $return;
    }



	function GetPACDetails($Hash)
	{
		if($this->ProxyShard)
		{
            		$Payload = array('hash' => $Hash, 'auth' => md5($APIKey . $Hash), 'api' => $this->APIKey);
			$return = $this->MakeRequest($Payload,'get_pac');
		}
		else
		{
			$Query = "select * from pac where hash = '$Hash'";
			$result = mysql_query($Query);
			$mysql_return = mysql_fetch_assoc($result);

			$FriendlyName = $mysql_return['name'];
			$Description = $mysql_return['description'];
			$Hash = $mysql_return['hash'];
			$Password = $mysql_return['password'];
			$Ro = $mysql_return['ro'];
			$URLs = unserialize($mysql_return['urls']);
			$Tor = $mysql_return['tor'];

            		$return = array('friendlyname' => $FriendlyName, 'description' => $Description, 'urls' => $URLs,'localproxy' => $Tor,'ro' => $Ro,'hash' => $Hash);
		}
        	return $return;
	}


	function PushToS3($Hash,$S3APIKey,$S3APISecret)
	{
		$returnArray = array('success' => 'ok', 'url' => '');

		if(empty($Hash) || strlen($Hash) < 32)
		{
			$returnArray['success'] = 'fail';
			$returnArray['message'] = "Incorrect Hash";
		}
		else
		{
			if($this->ProxyShard)
			{
				$Payload = array('hash' => $Hash, 'auth' => md5($APIKey . $Hash), 'api' => $this->APIKey);
		        $return = $this->MakeRequest($Payload,'pushtos3');
				return $return;
			}
			else
			{
				$Query = "select * from pac where hash = '$Hash'";
				$result = mysql_query($Query);
				$PAC = mysql_fetch_assoc($result);

				$FriendlyName = $PAC['name'];
				$Description = $PAC['description'];
				$Hash = $PAC['hash'];
				$Password = $PAC['password'];
				$Ro = $PAC['ro'];
				$URLs = unserialize($PAC['urls']);
				$Tor = $PAC['tor'];	
			}

			$file_type = "application/x-ns-proxy-autoconfig";
			$aws_object =  $Hash.'.pac';
            		$aws_bucket = 'packetflagon-000001';
			//$aws_bucket = 'pac-' . $Hash;

			$PAC = "function FindProxyForURL(url, host)\n{\n";

			if(empty($URLs))
			{
				$URLs = array('wtfismyip.com');
			}

			$String = "";
			foreach($URLs as $URL)
			{
				$String .= '"'.strtolower($URL).'"' . ',';
			}

			$String = substr($String,0,strlen($String) - 1);
			$PAC .= "   var list = new Array($String);\n\n";

			if($Tor == 1)
			{
				$Proxy = "localhost";
			}
			else
			{
				$rand = rand ( 0, 8);
				if($rand < 1)
				{
					$Proxy = 'proxy-1-1.routingpacketsisnotacrime.uk';
				}
				else
				{
					$Proxy = 'proxy-1-2.routingpacketsisnotacrime.uk';
				}
			}

			if($Tor == 1)
			{
				$Port = 9050;
				$Type = "SOCKS";
			}
			else
			{
				$Port = '8080';
				$Type = 'PROXY';
			}

			$PAC .= "
    for(var i=0; i < list.length; i++)
    {
        if (shExpMatch(host, list[i]))
        {
            return \"$Type $Proxy:$Port\";
	    }
    }
    return \"DIRECT\";
}
";

		    $file_data = $PAC;

		    $fp = fsockopen("s3.amazonaws.com", 80, $errno, $errstr, 30);
		    if (!$fp)
		    {
			    $returnArray['success'] = 'fail';
			    $returnArray['message'] = "$errstr ($errno)\n";
		    }
		    else
		    {
			    // Creating or updating bucket
			    $dt = gmdate('r'); // GMT based timestamp

			    // preparing String to Sign    (see AWS S3 Developer Guide)
			    $string2sign = "PUT


			{$dt}
			/{$aws_bucket}";

			    // preparing HTTP PUT query
			    $query = "PUT /{$aws_bucket} HTTP/1.1
				Host: s3.amazonaws.com
				Connection: keep-alive
				Date: $dt
				Authorization: AWS {$S3APIKey}:".$this->amazon_hmac($string2sign,$S3APISecret)."\n\n";

			    $resp = $this->sendREST($fp, $query);
			    if (strpos($resp, '<Error>') !== false)
			    {
				    $BucketError = $resp;
				    //print($BucketError ."<br/><br/>");
				    $returnArray['success'] = 'fail';
				    $returnArray['message'] = $BucketError;
				    print(json_encode($returnArray));
				    die();
			    }

			    // Uploading object -----------------------------------------------------------------
			    $file_length = strlen($file_data); // for Content-Length HTTP field

			    $dt = gmdate('r'); // GMT based timestamp
			    // preparing String to Sign    (see AWS S3 Developer Guide)
			    $string2sign = "PUT

			{$file_type}
			{$dt}
			x-amz-acl:public-read
				/{$aws_bucket}/{$aws_object}";

			    // preparing HTTP PUT query
			    $query = "PUT /{$aws_bucket}/{$aws_object} HTTP/1.1
				Host: s3.amazonaws.com
				x-amz-acl: public-read
				Connection: keep-alive
				Content-Type: {$file_type}
			Content-Length: {$file_length}
Date: $dt
	      Authorization: AWS {$S3APIKey}:".$this->amazon_hmac($string2sign,$S3APISecret)."\n\n";
                $query .= $file_data;

                $resp = $this->sendREST($fp, $query);
                if (strpos($resp, '<Error>') !== false)
                {
	                $PutError = $Resp;
	                $returnArray['success'] = 'fail';
	                $returnArray['message'] = $BucketError;
                }
                else
                {
	                fclose($fp);
                }

                $returnArray['success'] = 'ok';
                $returnArray['url'] = "https://s3.amazonaws.com/{$aws_bucket}/{$aws_object}";
            }
	    }
	    return $returnArray;
    }

function GetProxyMeta()
{
    	$ProxyDetails = array();

	if($this->ProxyShard)
	{
        	$Payload = array('auth' => md5($APIKey . date('d M H:i')), 'api' => $this->APIKey);
		$ProxyDetails = $this->MakeRequest($Payload,'proxy_meta');

		/*$Proxy1 = 5;
		$Proxy2 = 12;
		$ProxyDetails = array(array('id' => '1-1', 'bw' => $Proxy1,'sync' => date('d M H:i'),'status' => 'ok'),
				array('id' => '1-2', 'bw' => $Proxy2,'sync' => date('d M H:i'),'status' => 'ok'));*/
	}
	else
	{
	
		if(isset($memcache))
		{	
			$Proxy1 = round(($memcache->get('proxy-1-1') / 102400) * 100);
			$Proxy2 = round(($memcache->get('proxy-1-1') / 102400) * 100);
		}
		else
		{
			$Proxy1 = 0;
			$Proxy2 = 0;
		}

		if($Proxy1 == 0)
			$Proxy1 = rand(12,30);

		if($Proxy2 == 0)
			$Proxy2 = rand(14,40);

		$ProxyDetails['proxies'] = array(array('id' => '1-1', 'bw' => $Proxy1,'sync' => date('d M H:i'),'status' => 'ok'),
				array('id' => '1-2', 'bw' => $Proxy2,'sync' => date('d M H:i'),'status' => 'ok'));
	}
	$ProxyDetails['success'] = 'ok';
	return $ProxyDetails;
}


private function MakeRequest($Payload,$Action)
{
	$ch = curl_init();
	$url = $this->PFRoot . '/api/'.$Action;
	foreach($Payload as $key=>$value) 
    	{
        	$fields_string .= $key.'='.$value.'&'; 
    	}
    	rtrim($fields_string, '&');


	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
    	curl_setopt($ch, CURLOPT_POST, count($Payload));
    	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$data = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch); 

    	$json = json_decode($data,true);

    	if(isset($json['success']) && !empty($json['success']))
    	{
        	return $json;
    	}
    	else
    	{
	    return array('success' => 'fail', 'message' => 'An unknown error occured: ' . $httpCode);
    	}
}

// Sending HTTP query and receiving, with trivial keep-alive support
private function sendREST($fp, $q, $debug = false)
{
	if ($debug) echo "\nQUERY<<{$q}>>\n";

	fwrite($fp, $q);
	$r = '';
	$check_header = true;
	while (!feof($fp)) {
		$tr = fgets($fp, 256);
		if ($debug) echo "\nRESPONSE<<{$tr}>>";
		$r .= $tr;

		if (($check_header)&&(strpos($r, "\r\n\r\n") !== false))
		{
			// if content-length == 0, return query result
			if (strpos($r, 'Content-Length: 0') !== false)
				return $r;
		}

		// Keep-alive responses does not return EOF
		// they end with \r\n0\r\n\r\n string
		if (substr($r, -7) == "\r\n0\r\n\r\n")
			return $r;
	}
	return $r;
}

// hmac-sha1 code START
// hmac-sha1 function:  assuming key is global $aws_secret 40 bytes long
// read more at http://en.wikipedia.org/wiki/HMAC
// warning: key($aws_secret) is padded to 64 bytes with 0x0 after first function call
private function amazon_hmac($stringToSign, $aws_secret)
{
	// helper function binsha1 for amazon_hmac (returns binary value of sha1 hash)
	if (!function_exists('binsha1'))
	{
		if (version_compare(phpversion(), "5.0.0", ">=")) {
			function binsha1($d) { return sha1($d, true); }
		} else {
			function binsha1($d) { return pack('H*', sha1($d)); }
		}
	}

	if (strlen($aws_secret) == 40)
		$aws_secret = $aws_secret.str_repeat(chr(0), 24);

	$ipad = str_repeat(chr(0x36), 64);
	$opad = str_repeat(chr(0x5c), 64);

	$hmac = binsha1(($aws_secret^$opad).binsha1(($aws_secret^$ipad).$stringToSign));
	return base64_encode($hmac);
}
// hmac-sha1 code END


}

//-------------------------------------------------------------------------------------------------
//Functions

function getHost($Address)
{
	$pattern = '/^[A-Za-z0-9-]+(\\.[A-Za-z0-9-]+)*(\\.[A-Za-z]{2,})$/';

	$parseUrl = parse_url(trim($Address));
	$URL = trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2)));

	if(preg_match($pattern, $URL, $matches, PREG_OFFSET_CAPTURE) == 0)
	{
		return;
	}
	else
	{
		return $URL;
	}
}
