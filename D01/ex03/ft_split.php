#!/usr/bin/php
<?php
function ft_split($str)
{
    $arr = array_filter(explode(" ", $str));
    sort($arr);
    return ($arr);
}
?>