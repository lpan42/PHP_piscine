<?php

include_once "core/mysql.php";

function product_getproducts()
{
	$con = connect();
	$query = "SELECT * FROM products";
	$products = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
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

function product_getproduct($product_id)
{
	$con = connect();
	$query = "SELECT * FROM products WHERE `id` = ?;";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $product_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) === NULL)
			return (FALSE);
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
		return $row;
	}
	return FALSE;
}

function product_addproduct($name, $price)
{
	$con = connect();
	$query = "INSERT INTO products (`name`, `price`) VALUES (?, ?)";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "sd", $name, $price);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}

function product_editproduct($product_id, $name = '', $price = '', $stock = '')
{
	$con = connect();
	if ($name !== '' && $price !== '' && $stock !== '')
		$query = "UPDATE products SET `name` = ?, `price` = ?, `stock` = ? WHERE id = ?;";
	else if ($name !== '')
		$query = "UPDATE products SET `name` = ? WHERE id = ?;";
	else if ($price !== '')
		$query = "UPDATE products SET `price` = ? WHERE id = ?;";
	else if ($stock !== '')
		$query = "UPDATE products SET `stock` = ? WHERE id = ?;";
	else
		return (FALSE);
	if ($stmt = mysqli_prepare($con, $query))
	{
		if ($name !== '' && $price !== '')
			mysqli_stmt_bind_param($stmt, "sdii", $name, $price, $stock, $product_id);
		else if ($name !== '')
			mysqli_stmt_bind_param($stmt, "si", $name, $product_id);
		else if ($price !== '')
			mysqli_stmt_bind_param($stmt, "di", $price, $product_id);
		else if ($stock !== '')
			mysqli_stmt_bind_param($stmt, "ii", $stock, $product_id);
		if (mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}

function product_clearcategories_products($id)
{
	$con = connect();
	$query = "DELETE FROM product_link WHERE `product_id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		return TRUE;
	}
	return FALSE;
}

function product_delproduct($id)
{
	$con = connect();
	$query = "DELETE FROM products WHERE `id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$target_file = PRODUCTS_FOLDER.'/'.$id;
		if (file_exists($target_file))
			@unlink($target_file);
		return product_clearcategories_products($id);
	}
	return FALSE;
}

function product_searchproducts($name)
{
	$con = connect();
	$query = "SELECT * FROM products WHERE `name` LIKE ?";
	$products = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
		$name = '%'.$name.'%';
		mysqli_stmt_bind_param($stmt, "s", $name);
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

function product_getlastbuyproducts()
{
	$con = connect();
	$query = "SELECT products.* FROM order_products INNER JOIN products ON products.id = order_products.product_id GROUP BY product_id ORDER BY order_products.product_id DESC LIMIT 10;";
	$products = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
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

?>
