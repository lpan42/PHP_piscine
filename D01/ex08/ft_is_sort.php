<?php
function ft_is_sort($arr)
{
    $sorted_arr = $arr;
    sort($sorted_arr);
    $n = count($arr);
    $i = 0;
    while ($i < $n)
    {
        if ($sorted_arr[$i] != $arr[$i])
            return (FALSE);
        $i++;
    }
    return (TRUE);
}
?>