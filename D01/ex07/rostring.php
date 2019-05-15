#!/usr/bin/php
<?php
if ($argc > 1)
{
    $arr = array_filter(explode(" ", trim($argv[1])), "strlen");
    $arr = array_merge($arr);
    $n = count($arr);
    $i = 1;
    while ($i < $n)
    {
        printf("%s ", $arr[$i]);
        $i++;
    }
    printf("%s\n", $arr[0]);
}
?>