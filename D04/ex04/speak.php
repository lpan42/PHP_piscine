<?php
    date_default_timezone_set("Europe/Paris");
    session_start();
    if($_SESSION["loggued_on_user"] == "")
    {
        echo "ERROR/n";
        exit();
    }
    $login = $_SESSION["loggued_on_user"];
    $time = date("H:i");
    $msg = $_POST["msg"];
    $path = "../private/chat";
    if(!file_exists($path))
    {
        file_put_contents($path, NULL);
        $arr = $array();
    }
    else
    {
        $file = file_get_contents($path);
        $arr = unserialize($file);
    }
    $chat = fopen("$path", "a+");
    if(flock($chat, LOCK_SH | LOCK_EX))
    {
        $key = count($arr);
        $arr[$key + 1]["login"] = $login;
        $arr[$key + 1]["time"] = $time;
        $arr[$key + 1]["msg"] = $msg;
        file_put_contents($path, serialize($arr));
    }
    else
        echo "Error locking the file\n";
    fclose($chat); //The lock is released also by fclose()
?>

<!DOCTYPE html>
<html>
<body>
    <form action="speak.php" method="POST">
        <input type= "text" name="msg" placeholder="Type your message here"/>
        <br />
        <input type="submit" name="submit" value="OK" />
    </form>
</body>
</html>