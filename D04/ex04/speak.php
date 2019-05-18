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
    $folder_path = "../private";
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
    }
    $speak = fopen($path, "rw+");
    if(flock($speak, LOCK_SH | LOCK_EX))//LOCK_SH:Shared lock (reader). Allow other processes to access the file//LOCK_EX - Exclusive lock (writer). Prevent other processes from accessing the file
    {
        $key = count($arr);
        if($key != 0)
        {
            $arr[$key + 1]["login"] = $login;
            $arr[$key + 1]["time"] = $time;
            $arr[$key + 1]["msg"] = $msg;
        }
        else
        {
            $arr[0]["login"] = $login;
            $arr[0]["time"] = $time;
            $arr[0]["msg"] = $msg;
        }
        file_put_contents($path, serialize($arr));

    }
    else
        echo "Error locking the file\n";
    fclose($speak); //The lock is released also by fclose()
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
</head>
<body>
    <form action="speak.php" method="POST">
        <input type= "text" name="msg" placeholder="Type your message here"/>
        <br />
        <input type="submit" name="submit" value="OK" />
    </form>
</body>
</html>