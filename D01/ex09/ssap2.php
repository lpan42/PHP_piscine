#!/usr/bin/php
<?php
function ft_split($str)
{
    $arr = explode(" ", $str);
    sort($arr);
    return ($arr);
}
if ($argc > 1)
{
    $arr = [];
    $i = 1;
    while ($i < $argc)
    {
        $temp = ft_split($argv[$i]);
        $arr = array_merge($arr, $temp);
        $i++;
    }

    foreach($arr as $value)
    {
        if(ctype_alpha($value[0]) == TRUE)
            $alpha[] = $value;
    }
    sort($alpha, SORT_STRING | SORT_FLAG_CASE);

    foreach($arr as $value)
    {
        if(is_numeric($value[0]) == TRUE)
            $number[] = $value;
    }
    sort($number, SORT_STRING);

    foreach($arr as $value)
    {
        if(ctype_alpha($value[0]) == FALSE && is_numeric($value[0]) == FALSE)
            $special[] = $value;
    }
    sort($special, SORT_REGULAR);

    foreach($alpha as $value)
    {
        printf("$value\n");
    }
    foreach($number as $value)
    {
        printf("$value\n");
    }
    foreach($special as $value)
    {
        printf("$value\n");
    }
}
?>