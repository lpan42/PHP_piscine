<?php

require "core/constants.php";
require "core/utils.php";
require "models/user.php";
require "models/product.php";

session_start();
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT);

if ($_SESSION['cart'] === NULL || count($_SESSION['cart']) === 0)
	$_SESSION['cart'] = [];

function global_middleware($context, $args)
{
	if ($_POST['addcart'] == 'Add')
	{
		if (!isset($_POST['id']))
			return ;
		$amount = $_POST['amount'];
		if (!isset($_POST['amount']) || $amount <= 0)
			$amount = 1;
		if ($_SESSION['cart'][$_POST['id']] > 0)
			$_SESSION['cart'][$_POST['id']] += $amount;
		else
			$_SESSION['cart'][$_POST['id']] = 1;
	}

	$o_products = product_getproducts();
	$products = [];
	foreach ($o_products as &$p2)
		if ($_SESSION['cart'][$p2['id']] > 0)
		{
			$p2['totalprice'] = ($_SESSION['cart'][$p2['id']] + 0) * ($p2['price'] + 0);
			$products[] = $p2;
		}
	$GLOBALS['total_cart'] = array_sum(array_column($products, 'totalprice'));
}

function next_mid($context, $args)
{
	if (is_callable($context['function']))
	{
		call_user_func($context['function'], $args);
		if ($GLOBALS['sql_connection'])
			mysqli_close($GLOBALS['sql_connection']);
	}
	else
		error('Not Found');
}

if (user_getusers() == FALSE)
{
	echo "You need to install the database";
	return ;
}


$globals = [
	'title' => '404',
];


$origial_args = array_map(trim,
	array_map(rawurldecode,
		explode('/', trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/')
	)
));
$args = $origial_args;
$controller = $origial_args[0];
if ($_SERVER['REQUEST_URI'] == '/' && count($origial_args) <= 1)
	$controller = DEFAULT_CONTROLLER;
else
	array_shift($args);
if (file_exists(CONTROLLER_FOLDER.'/'.$controller.'.php'))
{
	$globals['context']['controller'] = $controller;
	require(CONTROLLER_FOLDER.'/'.$controller.'.php');
	$function = $origial_args[1];
	if (!isset($origial_args[1]))
		$function = 'index';
	if (substr($function, 0, 1) === '_')
	{
		error('Not Found');
		return;
	}
	array_shift($args);
	$globals['context']['function'] = $function;
	global_middleware($globals['context'], $args);
	$GLOBALS = array_merge($GLOBALS, $globals);
	if (is_callable('middleware') && !call_user_func('middleware', $globals['context'], $args, next_mid))
		return ;
	else if (!is_callable('middleware'))
		next_mid($globals['context'], $args);
}
else
{
	if ($controller == 'public')
		return FALSE;
	error('Not Found');
}
?>
