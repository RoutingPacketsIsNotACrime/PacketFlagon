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


if(isset($_GET['hash']) && !empty($_GET['hash']))
{
        $Hash = mysql_real_escape_string($_GET['hash']);

        $API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
        $PAC = $API->GetPACDetails($Hash);

        if($PAC['success'] == 'fail')
        {
            $smarty->assign('ERROR_TITLE','Error:');
            $smarty->assign('ERROR_TEXT','Clone attempt failed due to ' . $PAC['message']);
            $smarty->assign('ERROR',$smarty->fetch('view_error.tpl'));
        }
        else
        {
            $FriendlyName = $PAC['friendlyname'];
            $Description = $PAC['description'];
            $URLArray = $PAC['urls'];
            $URLs = "";

            foreach($URLArray as $URL)
            {
                $URLs .= $URL . ", ";
            }

            $URLs = substr($URLs,0,strlen($URLs) - 2);

            $Tor = $PAC['localproxy'];

            $smarty->assign('URLS',$URLs);
            $smarty->assign('FRIENDLYNAME',$FriendlyName);
            $smarty->assign('DESCRIPTION',$Description);
            $smarty->assign('TOR',$Tor);
        }
}

$smarty->display('create.tpl');
?>
