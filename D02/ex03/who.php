#!/usr/bin/php
<?php
    date_default_timezone_set("Europe/paris");
    $fp = fopen("/var/run/utmpx", "r");
    $usr = get_current_user();
    while($line = fread($fp, 628)) //The Mac OS X 10.5 utmpx file header is 628 bytes in size
        $arr[] = unpack("A256user/A4id/A32tty/Ipid/Itype/Ltime/Lother/A256host/A64pad", $line);
    foreach($arr as $value)
    {
        if($value[type] == 7 && strcmp(trim($value[user]), $usr) == 0) 
            echo $value[user]."    ".$value[tty]."  ".date("M  j H:i", $value[time])." \n";
    }
?>