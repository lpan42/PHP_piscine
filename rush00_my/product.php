<?php
session_start();
$product_file = file_get_contents("data/product.data");
$products = unserialize($product_file);
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
            <?php if($_SESSION["loggued_on_user"]) :echo "Welcome, ".$_SESSION["loggued_on_user"];?>
                <a href="account.php">My account</a>
                <a href="cart.php">My cart</a>
                <a href="logout.php">Logout</a>
            <?php elseif($_SESSION["loggued_on_user"] == NULL): ?>
                <a href="login.html">Login</a>
            <?php endif; ?>
         </div>
    </header>
    <div class="product_display" >
        <?php foreach($products as $product): ?>
            <div class="prod_imgage">
                <img class="product_img" src="img/<?php echo $product["img"];?>" alt="<?php echo $product["img"];?>">
            </div>
            <div class="prod_name">
                <p class="product_name">-<?php echo $product["name"];?>-</p>
            </div>
            <div class="prod_price">
                <p class="product_price">€<?php echo $product["price"];?></p>
            </div>
            <div class="prod_desc">
                <p class="product_desc"><?php echo $product["desc"];?></p>
            </div>
            <div class="prod_quan">
                <form class="prod_quantity" action="cart.php" method="POST">
                    <select class="product_quantity" name="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <input type="submit" name="cart" value="add to cart" />
                </form>
            </div>
        <?php endforeach; ?>
    </div>  
</body>
</html>