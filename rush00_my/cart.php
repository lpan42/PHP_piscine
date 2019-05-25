<?php
session_start();
$product_file = file_get_contents("data/product.data");
$cart_file = file_get_contents("private/cart");
//print_r($cart_file);
if($_SESSION["loggued_on_user"])
    $cart_arr = unserialize($cart_file);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fruits</title>
    <link rel="stylesheet" href="rush00.css">
</head>
<body>
    <header>
        <img class="logo" src="img/logo.png" alt="logo">
        <ul class="level0">
            <li class="dropdown">
                <button class="dropbtn"><a href="main_page.php">Main Page</a>
                </ul>
            </li>
            <li class="dropdown">
                <button class="dropbtn">Our Products
                <ul class="dropdown-content">
                    <li> <a href="product.php">Fruits</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <button class="dropbtn">About Us
                <ul class="dropdown-content">
                    <li><a href="main_page.php">About Us</a></li>
                </ul>
            </li>
        </ul>
        <div>
            <?php if($_SESSION["loggued_on_user"]) :echo "Welcome, ".$_SESSION["loggued_on_user"]; ?>
                <a href="account.php">My account</a>
                <a href="cart.php">My cart</a>
                <a href="logout.php">Logout</a>
            <?php elseif($_SESSION["loggued_on_user"] == NULL): ?>
                <a href="login.html">Login</a>
            <?php endif; ?>
         </div>
    </header>

 </body>
</html>