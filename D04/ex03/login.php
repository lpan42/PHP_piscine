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