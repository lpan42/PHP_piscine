<?php
    $file = file_get_contents("list.csv");
    $lines = explode(PHP_EOL, $file);
    $arr = array();
    unset($lines[0]);
    foreach ($lines as $line) {
        $tmp = explode(';', trim($line));
        $arr[$tmp[0]] = $tmp[1];
    }
    unset($arr[$_GET["id"]]);
    $newcontent = "id;i am a todo";
    $newitem = [];
    $i = 0;
    foreach ($arr as $value) {
        $newcontent.= PHP_EOL . $i . ";" . $value;
        $newitem[$i] = $value;
        $i++;
    }
    file_put_contents("list.csv", $newcontent);
    // header("Content-Type: application/json");
	// echo json_encode($newlines);
?>