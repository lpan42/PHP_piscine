<?php
    $login =  $_POST["login"];
    $oldpw = $_POST["oldpw"];
    $newpw = $_POST["newpw"];
    $submit = $_POST["submit"];
    $path = "../private/passwd";

    if(!$login || !$oldpw || !$newpw || $submit != "OK" || !file_exists($path))
    {
        echo "ERROR\n";
        exit();
    }
    $file = file_get_contents($path);
    $arr = unserialize($file);
    if($arr)
    {
        foreach($arr as $key => $value)
        {
            if($value["login"] == $login)
            {
                if ($value["passwd"] == hash("sha256", $oldpw))
                {
                    $arr[$key]["passwd"] = hash("sha256", $newpw);
                    file_put_contents($path, serialize($arr));
                    echo "OK\n";
                }
                else
                {
                    echo "ERROR\n";
                    exit();
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html>
<body>
    <a href="index.html">Return</a>
</body>
</html>