#!/usr/bin/php
<?php
if ($argc > 1)
{
    $temp = array_filter(explode(" ", $argv[1]));
    $arr = array_merge($temp);
    $n = count($arr);
    $i = 1;
    while ($i < $n)
    {
        print("$arr[$i] ");
        $i++;
    }
    print("$arr[0]\n");
}
?>