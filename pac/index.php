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

	header("Content-Type: application/x-ns-proxy-autoconfig"); 
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Thu, 23 Sep 2013 00:00:01 GMT");
	header('X-Fuck-You-Censors: Wanna play a game of whack a mole?');

?>function FindProxyForURL(url, host) 
{    
<?php
	require_once('../libs/config.php');
	require_once('../libs/api.php');

	$Hash = $_GET['hash'];

	$API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
	$PACDetails = $API->GetPACDetails($Hash);

	if(!isset($PACDetails['urls']) || empty($PACDetails['urls']))
	{
		$PACDetails['urls'] = array(array('url'=> 'wtfismyip.com'));
	}

	$String = "";
	foreach($PACDetails['urls'] as $Element)
	{
		$String .= '"'.strtolower($Element['url']).'"' . ',';
	}
	$String = substr($String,0,strlen($String) - 1);
	print("var list = new Array($String);\n\n");

	if(isset($_GET['proxy']))
	{
		$Proxy = $_GET['proxy'];
	}
	else
	{
		if($PACDetails['localproxy'] == 1)
		{
			$Proxy = "localhost";
		}
		else
		{
			$rand = rand ( 0, 8);
			if($rand < 1)
			{
				$Proxy = 'proxy-1-1.packetflagon.is';
			}
			else
			{
				$Proxy = 'proxy-1-2.packetflagon.is';
			}
		}
	}

	if(isset($_GET['port']))
	{
		$Port = $_GET['port'];
	}
	else
	{
		if($PAC['localproxy'] == 1)
		{
			$Port = 9050;
		}
		else
		{
			$Port = '8080';
		}
	}

	if(isset($_GET['type']))
	{
		$Type = $_GET['type'];
	}
	else
	{
		if($PAC['localproxy'] == 1)
		{
			$Type = "SOCKS";
		}
		else
		{
			$Type = 'PROXY';
		}
	}
?>
    for(var i=0; i < list.length; i++)
    {
        if (shExpMatch(host, list[i]))
        {
           return "<?php echo $Type; ?> <?php echo $Proxy; ?>:<?php echo $Port; ?>";
        }
    }
    return "DIRECT";
}

