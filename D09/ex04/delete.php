<?php
    $file = file_get_contents("list.csv");
    $lines = explode(PHP_EOL, $file);
    $data = array();
    unset($lines[0]);
    foreach ($lines as $line) {
        $tmp = explode(';', trim($line));
        $data[$tmp[0]] = $tmp[1];
    }
    unset($data[$_GET["id"]]);
    $newcontent = "id;i am a todo";
    $newitem = [];
    $i = 0;
    foreach ($data as $value) {
        $newcontent.= PHP_EOL . $i . ";" . $val;
        $newitem[$i] = $val;
        $i++;
    }
    file_put_contents("list.csv", $newcontent);
    echo ($newitem);
?>