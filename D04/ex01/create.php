<?php
    $login =  $_POST["login"];
    $passwd = $_POST["passwd"];
    $submit = $_POST["submit"];
    $path = "../private/passwd";

    if(!$login || !passwd || $submit != "OK")
    {
        echo "ERROR\n";
        exit();
    }
    if(!file_exists($path))
    {
        file_put_contents($path, NULL); //returns the number of character written into the file on success, or FALSE on failure
        $arr = $array();
    }
    else
    {
        $file = file_get_contents($path);
        $arr = unserialize($file);
    }
    if($arr)
    {
        foreach($arr as $key => $value)
        {
            if($value["login"] == $login)
            {
                echo "ERROR\n";
                exit();
            }
        }
    }
    $arr[$key + 1]["login"] = $login;
    $arr[$key + 1]["passwd"] = hash("sha256", $passwd);
    file_put_contents($path, serialize($arr));//!!!this function overwrites the content by default
    echo "OK/n";
?>