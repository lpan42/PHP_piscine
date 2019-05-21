#!/usr/bin/php
<?php
if($argc > 3)
{
    $i = 2;
    while ($i < $argc)
    {
        $arr = explode(":", $argv[$i]);
        if(strcmp($arr[0], $argv[1]) == 0)
            $value = $arr[1];
        $i++;
    }
    if($value)
        print("$value\n");
}
?>