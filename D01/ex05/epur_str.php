#!/usr/bin/php
<?php
if($argc == 2)
{
    $arr = array_filter(explode(" ", trim($argv[1])), "strlen");
    $i = 0;
    foreach($arr as $value)
    {
        print($value);
        if($i < count($arr) - 1)
            print(" ");
        else
            print("\n");
        $i++;
    }
}
?>