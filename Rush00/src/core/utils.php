<?php

function html_print($arg)
{
	echo "<pre>";
	var_dump($arg);
	echo "</pre>";
}

function redirect($url)
{
	header('Location: '.$url);
}

function error($message, $keyword = NULL)
{
	$error = $message;
	$search = $keyword != NULL ? $keyword : $message;
	$url = "http://api.giphy.com/v1/gifs/search?q=".rawurlencode($search)."&api_key=lznPpSaqOm8sO14729EOPRcjLmGLxh4w&limit=20";
	$data = json_decode(file_get_contents($url), true);
	$id = rand(0, $data['pagination']['count']);
	$image = $data['data'][$id]['images']['original']['url'];
	include "views/error.php";
}

function message($message, $button_text, $link)
{
	include "views/message.php";
}

?>
