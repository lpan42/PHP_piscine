#!/usr/bin/php
<?php
    if($argc > 1 && preg_match("/http?.:\/\//", $argv[1]))
    {
        $url = file_get_contents($argv[1]);
        preg_match_all("/<img .*?>/", $url, $pic);
        //print_r($pic);
        $folder_name = substr($argv[1], 7);
        $folder_name = $folder_name."/";
        mkdir($folder_name);
        foreach($pic[0] as $value)
        {
            preg_match("/src=[\"'].*?[\"']/", $value, $src_arr);
            //print_r($src_arr);
            $src = substr($src_arr[0], 5, -1);
            //print_r($src);
            preg_match("/[^\/]*\$/", $src, $name_arr);
            //print_r($name_arr);
            if (preg_match("/http?.:\/\//", $src))
                copy($src, $folder_name . $name_arr[0]);
            else
                copy($argv[1] . $src, $folder_name . $name_arr[0]);
        }
    }
?>