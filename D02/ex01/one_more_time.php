#!/usr/bin/php
<?php
if($argc > 1)
{
    date_default_timezone_set("Europe/paris");
    setlocale(LC_ALL, 'fr_FR');
    $format = "%A %e %B %Y %H:%M:%S";
    if($time = strptime($argv[1], $format))
    {
        //print_r($time);
        print(mktime($time[tm_hour],$time[tm_min],$time[tm_sec],$time[tm_mon]+1,$time[tm_mday],$time[tm_year]+1900));
        //mktime(hour,minute,second,month,day,year,is_dst);
    }
    else
        print("Wrong Format\n");
}
?>