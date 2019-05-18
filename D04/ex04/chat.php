<?php
$path = "../private/chat";
if(file_exists($path))
{
    $chat = file_get_contents($path);
    $arr = unserialize($chat);
    foreach ($arr as $value)
    {  
        if ($value["msg"])
        {
            echo "[" . $value["time"] . "] <b>" . $value["login"] . "</b>: " . $value["msg"];
            echo "<br \>";
        }
    }
}
?>