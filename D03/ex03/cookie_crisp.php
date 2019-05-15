<?php
    $action = $_GET['action'];
    $name = $_GET['name'];
    $value = $_GET['value'];
    switch($action)
    {
        case "set":
            setcookie($name, $value, time() + 86400); //86400 = 1 day
            break;
        case "get":
            if($_COOKIE[$name])
                echo "$value\n";
            break;
        case "del":
            setcookie($name, "", time() - 3600);
            break;
    }
?>
<!-- The setcookie() function must appear BEFORE the <html> tag. -->