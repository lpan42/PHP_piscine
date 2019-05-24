<?php
    $login =  $_POST["login"];
    $passwd = $_POST["passwd"];
    $submit = $_POST["submit"];
    $path = "../private/passwd";
    $folder_path = "../private";

    if(!$login || !$passwd || $submit != "OK")
    {
        echo "ERROR\n";
        exit();
    } 
    if(file_exists($path))
    {
        $file = file_get_contents($path);
        $arr = unserialize($file);
    }
    else
    {
        if(!file_exists($folder_path))
            mkdir($folder_path, 0755);
        $arr = array();
        file_put_contents($path, NULL);
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
    echo "OK\n";
?>

<!DOCTYPE html>
<html>
<body>
    <a href="index.html">Return</a>
</body>
</html>