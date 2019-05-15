<?php
    include "auth.php";
    session_start();
    $login = $_GET["login"];
    $passwd = $_GET["passwd"];
    if(auth($login, $passwd))
    {
        $_SESSION["loggued_on_user"] = $login;
        echo "OK\n";
    }
    else
    {
        $_SESSION["loggued_on_user"] = "";
        echo "ERROR\n";
    }
?>

<!DOCTYPE html>
<html>
<body>
    <a href="logout.php">Logout</a>
    <iframe src="chat.php" name="chat" style="width: 100%; height: 550px; position: absolute;"></iframe>
    <iframe src="speak.php" name="speak" style="width: 100%; height: 50px; position: absolute; top:600px;"></iframe>
</body>
</html>