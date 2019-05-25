<?php
    session_start();
    session_unset(); //destroy a single session variable
    // session_destroy();destroy all the session variables
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <p>You have successfully logged out.</p>
    <a href="main_page.php">Return to the Main Page</a>
</body>
</html>