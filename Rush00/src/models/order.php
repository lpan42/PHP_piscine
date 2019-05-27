<?php

include_once "core/mysql.php";

function order_getorders()
{
	$con = connect();
	$query = "SELECT orders.id, login, date FROM orders INNER JOIN users ON users.id = orders.user;";
	$orders = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return [];
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			$orders[] = $row;
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
	}
	return $orders;
}

function order_getorder($user_id)
{
	$con = connect();
	$query = "SELECT orders.id, login, date FROM orders INNER JOIN users ON users.id = orders.user WHERE user = ?;";
	$orders = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		if (mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return [];

		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			$orders[] = $row;
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
	}
	return $orders;
}

function order_getproducts($id)
{
	$con = connect();
	$query = "SELECT id, name, price, amount FROM order_products INNER JOIN products ON products.id = order_products.product_id WHERE order_id = ?";
	$products = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return [];
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			$products[] = $row;
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
	}
	return $products;
}

function order_addorder($user_id)
{
	$con = connect();
	date_default_timezone_set('Europe/Paris');
	$query = "INSERT INTO orders (user, `date`) VALUES (?, ?)";
	if ($stmt = mysqli_prepare($con, $query))
	{
		$time = time();
		mysqli_stmt_bind_param($stmt, "ii", $user_id, $time);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}

function order_linkproduct($order_id, $product_id, $amount)
{
	$con = connect();
	$query = "INSERT INTO order_products (order_id, product_id, amount) VALUES (?, ?, ?)";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "iii", $order_id, $product_id, $amount);
		if (mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}

function order_unlinkproduct($order_id, $product_id)
{
	$con = connect();
	$query = "DELETE FROM order_products WHERE `product_id` = ? AND `order_id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "ii", $product_id, $order_id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}


function order_clearlinkedproducts($order_id)
{
	$con = connect();
	$query = "DELETE FROM order_products WHERE `order_id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $order_id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		return TRUE;
	}
	return FALSE;
}

function order_deluser_orders($user_id)
{
	$order = order_getorder($user_id);
	$con = connect();
	$query = "DELETE FROM orders WHERE `user` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		return order_clearlinkedproducts($order['id']);
	}
	return FALSE;
}

function order_delorder($order_id)
{
	$con = connect();
	$query = "DELETE FROM orders WHERE `id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $order_id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		return order_clearlinkedproducts($order_id);
	}
	return FALSE;
}

?>
