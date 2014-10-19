<?php
    /*
    * Copyright (C) 2014 - Gareth Llewellyn
    *
    * This file is part of PacketFlagon - https://PacketFlagon.is
    *
    * This program is free software: you can redistribute it and/or modify it
    * under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 3 of the License, or
    * (at your option) any later version.
    *
    * This program is distributed in the hope that it will be useful, but WITHOUT
    * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
    * FOR A PARTICULAR PURPOSE. See the GNU General Public License
    * for more details.
    *
    * You should have received a copy of the GNU General Public License along with
    * this program. If not, see <http://www.gnu.org/licenses/>
    */
    require_once('libs/config.php');
    require_once('libs/api.php');

    $return = array();
    $return['success'] = "ok";
    $return['hash'] = "ABCDEFG";
    $return['message'] = 'Awesome!';

    $Hash = mysql_real_escape_string($_POST['hash']);

    $API = new API($PacketFlagonAPIKey,$FQDN,$PacketFlagonRoot,$ProxyShard);
    print(json_encode($API->PushToS3($Hash,$S3APIKey,$S3APISecret)));
