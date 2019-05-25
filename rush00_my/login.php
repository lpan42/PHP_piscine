<?php
    include "auth.php";
    session_start();
    $login = $_POST["login"];
    $passwd = $_POST["passwd"];
    $pwd_path = "private/passwd";
    $cart_path = "private/cart";
    $folder_path = "private";
    if(auth($login, $passwd))
    {
        $_SESSION["loggued_on_user"] = $login;
        if(file_exists($cart_path))
        {
            $cart_file = file_get_contents($cart_path);
            $cart_arr = unserialize($cart_file);
        }
        else
        {
            if(!file_exists($folder_path))
                mkdir($folder_path, 0755);
        }
        $cart_arr[$_SESSION["loggued_on_user"]] = array(
            "name" = NULL;
            "cat" 
            name;cat;price;img;desc
        );
        //print_r($cart_arr);
        file_put_contents($cart_path, serialize($cart_arr));
        echo "<p>You have logged in</p>";
    }
    else
    {
        $_SESSION["loggued_on_user"] = "";
        echo "<p>failed to login</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="rush00.css">
</head>
<body>
    <?php if($_SESSION["loggued_on_user"]) :?>
        <a href="main_page.php">Go back to Main Page</a>
    <?php elseif($_SESSION["loggued_on_user"] == NULL): ?>
        <a href="main_page.php">Go back to Main Page</a>
        <a href="create.html">Create a new account</a>
    <?php endif;?>
</body>
</html>