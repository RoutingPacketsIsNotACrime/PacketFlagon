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

    //Fuck censorship
	header('X-Fuck-You-Censors: Wanna play a game of whack a mole?');

	require_once('libs/Smarty.class.php');
	require_once('libs/config.php');

	//Initialize the template engine
	$smarty = new Smarty();

    $smarty->assign('FQDN',$FQDN);
    $smarty->assign('TITLE',$ShardName);
    $smarty->assign('PROTO',($ForceHTTPS ? 'https' : 'http'));
    $smarty->assign('CREDIT',(empty($Credit) ? 'Anonymous' : $Credit));

    
    if( $_GET['page'] == "configure-chrome" ||
        $_GET['page'] == "configure-firefox" ||
        $_GET['page'] == "configure-safari" ||
        $_GET['page'] == "configure-internet-explorer" ||
        $_GET['page'] == "create-tor-proxy")
    {
        $smarty->display($_GET['page'].'.tpl');
    }
    else if ($_GET['page'] == 'find-pac-frontends' ||
             $_GET['page'] == 'create-shard' ||
             $_GET['page'] == 'create-socks5-proxy' ||
	     $_GET['page'] == 'api')
    {
        $SUBTITLE = "";
        $INTRO = "";

        switch($_GET['page'])
        {
            case 'find-pac-frontends':
            {
                $SUBTITLE = 'Find Other ProxyShards (PAC serving front-ends)';
                $INTRO = '<span>Block one and another rises in its place</span><br/>If a domain is found to be blocked another is automatically registered and a new ProxyShard is created.<br/>Here\'s how to find them!';
                
                $smarty->assign('CONTENT', $smarty->fetch('howto-alternate-frontends.tpl'));
            }
            break;

            case 'create-shard':
            {
                $SUBTITLE = 'Create your own PacketFlagon ProxyShard';
                $INTRO = '<span>ProxyShards are leaf nodes</span> that use the central <span class="hue">PacketFlagon API</span> to manage, store &amp; serve PAC files on alternate domains to frustrate ISP blocking';
                $smarty->assign('CONTENT', $smarty->fetch('howto-create-shard.tpl'));
            }
            break;

            case 'create-socks5-proxy':
            {
                $SUBTITLE = 'Create a Local SOCKS5 Proxy';
                $INTRO = '<span>A SOCKS5 proxy</span> enables you to tunnel your browser <em>(and DNS)</em> traffic through a <span class="hue">remote server</span> that isn\'t subject to ISP censorship';
                $smarty->assign('CONTENT', $smarty->fetch('howto-socks5-tunnel.tpl'));
            }
            break;

	    case 'api':
            {
                $SUBTITLE = 'Using the PacketFlagon API';
                $INTRO = 'The <span>PacketFlagon</span> <em>Application Programming Interface</em> allows shards <span class="hue">(or other applications)</span> to make use of the databases and PAC configs';
                $smarty->assign('CONTENT', $smarty->fetch('howto-api.tpl'));
            }
            break;
        }

        $smarty->assign('SUBTITLE',$SUBTITLE);
        $smarty->assign('INTRO',$INTRO);
        $smarty->display('how-to-base.tpl');
    }
    else
    {
        $smarty->display('how-to-tor.tpl');
    }
?>
