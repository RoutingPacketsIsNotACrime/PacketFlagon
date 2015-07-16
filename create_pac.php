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

	require_once('libs/Smarty.class.php');
    	require_once('libs/config.php');
    	require_once('libs/api.php');

	$return = array();

	/*$return['success'] = "ok";
	$return['hash'] = "ABCDEFG";
	$return['message'] = 'Awesome!';

	$MD5 = md5($_SERVER['REMOTE_ADDR'] . date('Y-m-d His'));*/

	$Name = $_POST['name'];
	$Desc = $_POST['desc'];
	$Password = "";
	$URLs = array();
	$UseTor = $_POST['use_tor_proxy'];
	//$Ro = 0;

	if($UseTor == "yes")
	{
		$UseTor = 1;
	}
	else
	{
		$UseTor = 0;
	}

	if(empty($_POST['password']))
	{
		$Password = "";
		//$Ro = 0;
	}
	else
	{
		$Password = md5($_POST['password']);
		//$Ro = 1;
	}

	/*$URLsArray = explode(",", $_POST['urls']);

	foreach($URLsArray as $URL)
	{
                $urlMeta = getHost($URL);
                if(!empty($urlMeta))
                {
                        $URLs[] = strtolower($urlMeta);
                }
	}

	if(empty($URLs))
	{
        	$return['success'] = "fail";
        	$return['hash'] = "";
        	$return['message'] = 'No URLs were recognised, please ensure all URLs are separated with a comma ( , )';
		
	}
	else
	{*/
		//$URLs = serialize($URLs);
		//$API = new API($PacketFlagonAPIKey,$FQDN);
		$API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
            	$return = $API->CreatePAC($Name,$Desc,$Password,$_POST['urls'],$UseTor);
	//}

	print(json_encode($return));
?>
