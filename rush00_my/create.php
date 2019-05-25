<?php
    $login =  $_POST["login"];
    $passwd = $_POST["passwd"];
    $comfirm = $_POST["comfirm"];
    $submit = $_POST["submit"];
    $pwd_path = "private/passwd";
    $folder_path = "private";
    if(!$login || !$passwd || !$comfirm || $submit != "OK")
    {
        echo "ERROR, fill in all the information.\n";
        exit();
    }
    if ($passwd != $comfirm)
    {
        echo "The passwords you typed in are different.\n";
        exit();
    }
    if(file_exists($pwd_path))
    {
        $pwd_file = file_get_contents($pwd_path);
        $pwd_arr = unserialize($pwd_file);
    }
    else
    {
        if(!file_exists($folder_path))
            mkdir($folder_path, 0755);
        $pwd_arr = array();
    }
    if($pwd_arr)
    {
        foreach($pwd_arr as $key => $value)
        {
            if($value["login"] == $login)
            {
                echo "ERROR! User exist.\n";
                exit();
            }
        }
    }
    $pwd_arr[$key + 1]["login"] = $login;
    $pwd_arr[$key + 1]["passwd"] = hash("sha256", $passwd);
    file_put_contents($pwd_path, serialize($pwd_arr));
    echo "You have created your account\n";
?>

<!DOCTYPE html>
<html>
<body>
    <a href="login.html">You can logged in now</a>
</body>
</html>