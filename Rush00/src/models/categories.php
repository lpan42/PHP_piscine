<?php

include_once "core/mysql.php";

function categories_getcategories()
{
	$con = connect();
	$query = "SELECT * FROM categories";
	$categories = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return [];
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			$categories[] = $row;
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
	}
	return $categories;
}

function categories_getcategory($id)
{
	$con = connect();
	$query = "SELECT `id`, `name` FROM categories WHERE `id`=?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) === NULL)
			return (FALSE);
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
		return $row;
	}
	else
		return FALSE;
}

function categories_getproducts($id)
{
	$con = connect();
	$query = "SELECT `id`, `name`, `price`, `stock` FROM product_link INNER JOIN products ON products.id = product_link.product_id WHERE `category_id` = ?;";
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

function categories_linkproduct($category_id, $product_id)
{
	$con = connect();
	$query = "INSERT INTO product_link (product_id, category_id) VALUES (?, ?)";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "ii", $product_id, $category_id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}

function categories_unlinkproduct($category_id, $product_id)
{
	$con = connect();
	$query = "DELETE FROM product_link WHERE `product_id` = ? AND `category_id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "ii", $product_id, $category_id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}

function categories_addcategory($name)
{
	$con = connect();
	$query = "INSERT INTO categories(name) VALUES (?)";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "s", $name);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return mysqli_insert_id($con);
	}
	else
		return FALSE;
}

function categories_clearlinkedproducts($id)
{
	$con = connect();
	$query = "DELETE FROM product_link WHERE `category_id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		return TRUE;
	}
	return FALSE;
}

function categories_delcategory($id)
{
	$con = connect();
	$query = "DELETE FROM categories WHERE `id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$target_file = CATEGORIES_FOLDER.'/'.$id;
		if (file_exists($target_file))
			@unlink($target_file);
		return categories_clearlinkedproducts($id);
	}
	return FALSE;
}

?>
