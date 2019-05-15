#!/usr/bin/php
<?php
if($argc > 1)
{
    $str = preg_replace('/[\s]{2,}/', ' ', trim($argv[1])); /* or can use /\s\s+/ */
    printf("%s\n", $str);
}
?>