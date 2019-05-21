#!/usr/bin/php
<?php
function ft_split($str)
{
    $arr = array_filter(explode(" ", $str));
    sort($arr);
    return ($arr);
}
if ($argc > 1)
{
    $arr = array();
    $i = 1;
    while ($i < $argc)
    {
        $temp = ft_split($argv[$i]);
        $arr = array_merge($arr, $temp);
        $i++;
    }
    sort($arr);
    foreach($arr as $value)
    {
        print("$value\n");
    }
}
?>