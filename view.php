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
require_once('libs/api.php');

//Initialize the template engine
$smarty = new Smarty();

$smarty->assign('FQDN',$FQDN);
$smarty->assign('TITLE',$ShardName);
$smarty->assign('PROTO',($ForceHTTPS ? 'https' : 'http'));
$smarty->assign('CREDIT',(empty($Credit) ? 'Anonymous' : $Credit));

$Hash = $_GET['hash'];

$API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
$PACDetails = $API->GetPACDetails($Hash);

if($PACDetails['success'] == false || $PACDetails['success'] == 0)
{
    $smarty->assign('ERROR_TITLE','Error:');
    $smarty->assign('ERROR_TEXT','A problem was encountered fetching the PAC details:<br/>' . $PACDetails['message']);
    $smarty->assign('ERROR',$smarty->fetch('view_error.tpl'));
}
else
{
    //print_r($PACDetails);
    $Description = $PACDetails['description'];
    $FriendlyName = $PACDetails['friendlyname'];
    $Tor = $PACDetails['localproxy'];
    $Ro = $PACDetails['ro'];
    $URLs = $PACDetails['urls'];
}


if(empty($Description))
        {
                $MetaDesc = "Details about $Hash";
        }
        else
        {
                $MetaDesc = $Description . "( $Hash )";
        }

        if(empty($FriendlyName))
        {
                $FriendlyName = "Custom PAC: $Hash";
        }

        if($Tor)
        {
                $TorIcon = 'fa-check-square-o';
                $ProxyIcon = 'fa-square-o';
        }
        else
        {
                $TorIcon = 'fa-square-o';
                $ProxyIcon = 'fa-check-square-o';
        }

        if($Ro)
        {
                $RoIcon = 'fa-check-square-o';
        }
        else
        {
                $RoIcon = 'fa-square-o';
        }


$SectionURLs = array();

foreach($URLs as $ID => $URL)
{
        $blocked = 'fa-arrows-h" style="color:green';
        $ToolTip = 'Not detected as blocked by blocked.org.uk';

        if(isset($memcache) && $memcache->get($URL) == "blocked")
        {
                $blocked = 'fa-warning" style="color:red"';
                $ToolTip = 'Detected as blocked by at least 1 ISP by blocked.org.uk';
        }

        $SectionURLs[] = array('id' => $ID, 'url' => $URL, 'tooltip' => $ToolTip, 'blocked' => $Blocked);
}


$smarty->assign('HASH',$Hash);
$smarty->assign('FRIENDLYNAME',$FriendlyName);
$smarty->assign('DESCRIPTION',$Description);
$smarty->assign('METADESC', $MetaDesc);
$smarty->assign('TORICON',$TorIcon);
$smarty->assign('PROXYICON',$ProxyIcon);
$smarty->assign('ROICON',$RoIcon);
$smarty->assign('URLS',$SectionURLs);

$smarty->display('view.tpl');
?>
