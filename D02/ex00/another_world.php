#!/usr/bin/php
<?php
if($argc > 1)
{
    $str = preg_replace('/[\s]{2,}/', ' ', trim($argv[1])); 
    // []	Matches any single character between the square brackets
    // \s	Matches whitespace character
    // {min, max}	match exact character counts
    // or can use /\s\s+/
    printf("%s\n", $str);
}
?>