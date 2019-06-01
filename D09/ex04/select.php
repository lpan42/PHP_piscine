<?php
	$arr = array();
	$file = file_get_contents("list.csv");
	$lines = explode(PHP_EOL, $file);
	unset($lines[0]);
	//print_r($lines);
	foreach ($lines as $line) {
		$tmp = explode(";", trim($line));
		$arr[$tmp[0]] = $tmp[1];
	}
	header("Content-Type: application/json");
	echo json_encode($arr);
	//echo ($arr);
?>