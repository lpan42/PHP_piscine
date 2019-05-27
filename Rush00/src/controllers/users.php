<?php

include_once "models/order.php";
include_once "models/auth.php";

function middleware($context, $args, $next)
{
	if (!isset($_SESSION['user']))
	{
		error('You need to be connected');
		return (FALSE);
	}
	$next($context, $args);
	return (TRUE);	
}

function orders()
{
	$orders = order_getorder($_SESSION['user']['id']);
	$order_sum = [];
	foreach($orders as $key => $order)
	{
		$products = order_getproducts($order['id']);
		foreach ($products as $product)
			$order_sum[$order['id']] += $product['price'] * $product['amount'];
	}
	rsort($orders);
	include "views/orders.php";
}

function order($args)
{
	$id = $args[0];
	$products = order_getproducts($id);
	foreach ($products as $product)
			$order_sum[$id] += $product['price'] * $product['amount'];
	include "views/order_details.php";
}

function modif_pwd()
{
	if ($_POST['submit'] == 'Comfirm')
	{
		if (!$_POST['oldpasswd'] || !$_POST['confirm'] || !$_POST['newpasswd'])
			$error = "Un des champs est vide !";
		if (!isset($error) && $_POST['newpasswd'] != $_POST['confirm'])
			$error = "Les mots de passe ne correspondent pas !";
		$hash = hash('whirlpool', $_POST['newpasswd']);
		if (!isset($error) && $hash === $_SESSION['user']['passwd'])
			$error = "Old and new password are the same";
		if(!isset($error) && do_modif_pwd($_SESSION['user']['id'], $hash) === FALSE)
			$error = "Unable to update the user";
		if (!isset($error))
		{
			$_SESSION['user'] = NULL;
			message('Your password has changed!', 'Return to login', '/auth/login');
			return ;
		}
	}
	$GLOBALS['title'] = "HOME";
	include "views/auth/modif_pwd.php";
}

?>
