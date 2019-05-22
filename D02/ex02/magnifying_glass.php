#!/usr/bin/php
<?php

    $file = file_get_contents($argv[1]);
    
    function titleupper($matches)
    {
        //printf("match0:%s\n", $matches[0]);
        return ($matches[1].strtoupper($matches[2]).$matches[3]);
    }
    
    function linkname_upper($matches)
    {
        return ($matches[1].strtoupper($matches[2]).$matches[3]);
    }

    function wholelink($matches)
    {
        //printf("begin:%s\n", $matches[0]);
        $matches[0]= preg_replace_callback("/( title=\")(.*?)(\")/", "titleupper", $matches[0]);
        //printf("title:%s\n", $matches[0]);

        $matches[0] = preg_replace_callback("/(>)(.*?)(<)/", "linkname_upper", $matches[0]);
        //printf("linkname:%s\n", $matches[0]);
        return ($matches[0]);
    }
    $res = preg_replace_callback("/(<a )(.*?)(<\/a>)/", "wholelink", $file);
    //echo $res;
    //$matches[0] is the complete match
    //$matches[1,2,3] the match for the first subpattern
?>