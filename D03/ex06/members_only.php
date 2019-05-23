<?php
    if($_SERVER["PHP_AUTH_USER"] == 'zaz' && $_SERVER["PHP_AUTH_PW"] == 'jaimelespetitsponeys')
    {
        $file = file_get_contents("../img/42.png");
        echo "<html><body>Hello Zaz<br />\n<img src='data:image/png;base64," . base64_encode($file) . "'></body></html>\n";
    }
    else
    {
        header("HTTP/1.0 401 Unauthorized");
        header("WWW-Authenticate: Basic realm=''Member area''");
        echo "<html><body>That area is accessible for members only</body></html>";
    }
    // $_SERVER:  super global variable holds information about headers, paths, and script locations.
?>
