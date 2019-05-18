<?php
    include "auth.php";
    session_start();
    $login = $_POST["login"];
    $passwd = $_POST["passwd"];
    if(auth($login, $passwd))
    {
        $_SESSION["loggued_on_user"] = $login;
        echo "OK\n";
    }
    else
    {
        $_SESSION["loggued_on_user"] = "";
        echo "ERROR\n";
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <a href="logout.php">Logout</a>
    <a href="index.html">Return</a>
    <br />
    <iframe src="chat.php" name="chat" style="width: 100%; height: 550px; position: absolute;"></iframe>
    <iframe src="speak.php" name="speak" style="width: 100%; height: 50px; position: absolute; top:600px;"></iframe>
</body>
</html>
