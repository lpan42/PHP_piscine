<?php
    $file = file_get_contents("list.csv");
    $lines = explode(PHP_EOL, $file);
    $data = array();
    unset($lines[0]);
    foreach ($lines as $line) {
        $tmp = explode(';', trim($line));
        $data[$tmp[0]] = $tmp[1];
    }
    $id = sizeof($data);
    $newtodo = $id . ";" . trim($_GET["value"]);
    file_put_contents("list.csv", file_get_contents("list.csv") . PHP_EOL . $newtodo);
    header("Content-Type: application/json");
    $res["id"] = $newtodo;
    echo json_encode($res);
?>