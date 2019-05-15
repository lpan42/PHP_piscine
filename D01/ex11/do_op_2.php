#!/usr/bin/php
<?php
function is_op($op)
{
    if ($op == "+" || $op == "-" || $op == "*" || $op == "/" || $op == "%")
        return TRUE;
    return FALSE;
}

if ($argc == 2)
{
    $str = str_replace(" ", "", $argv[1]);
    $format = sscanf($str, "%d %c %d %s");
    if($format[0] && is_op($format[1]) && $format[2] && !$format[3])
    {
        $a = $format[0];
        $b = $format[2];
        $op = $format[1]; 
        if ($op == "+")
            $res = $a + $b;
        if ($op == "-")
            $res = $a - $b;
        if ($op == "*")
            $res = $a * $b;
        if ($op == "/")
            $res = $a / $b;
        if ($op == "%")
            $res = $a % $b;
        printf("%d\n", $res);
    }
    else
        print("Syntax Error\n");
}
else
    print("Incorrect Parameters\n");
?>