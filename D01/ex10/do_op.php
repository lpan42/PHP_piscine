#!/usr/bin/php
<?php
function is_op($op)
{
    if ($op == "+" || $op == "-" || $op == "*" || $op == "/" || $op == "%")
        return TRUE;
    return FALSE;
}

if ($argc == 4)
{
    $a = trim($argv[1]);
    $b = trim($argv[3]);
    $op = trim($argv[2]);

    if (!is_numeric($a) || !is_numeric($b) || !is_op($op))
        print("Incorrect Parameters\n");
    else
    {
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
        print("$res\n");
    }
}
else
    print("Incorrect Parameters\n");
?>