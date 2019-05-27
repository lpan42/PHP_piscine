<?php

include_once "models/user.php";
include_once "models/categories.php";
include_once "models/product.php";
include_once "models/order.php";

function middleware($context, $args, $next)
{
	if (isset($_SESSION['user']) && $_SESSION['user']['rank'] == 'admin')
	{
		$next($context, $args);
		return TRUE;
	}
	error("Refused Access", 'NOPE');
	return (FALSE);
}

function index($args)
{
	if ($_POST['deluser'] == 'delete')
	{
		if (!isset($_POST['id']) || !user_deluser($_POST['id']))
			$error = "Unabble to delete user !";
	}
	else if ($_POST['edituser'] == 'modify')
	{
		if (!isset($_POST['id']) || !isset($_POST['rank']) || !user_edituser($_POST['id'], $_POST['rank']))
			$error = "Unabble to edit user !";
	}
	$users = user_getusers();
	include "views/admin/index.php";
}

function categories($args)
{
	if ($_POST['delcategory'] == 'delete')
	{
		if (!isset($_POST['id']) || !categories_delcategory($_POST['id']))
			$error = "Unabble to delete category ".$_POST['id']."!";
	}
	else if ($_POST['addcategory'] == 'add')
	{
		if (!isset($_POST['name']))
			$error = "Empty name";
		if ($_FILES["image"]['tmp_name'] == '' || $_FILES["image"]['name'] == '')
			$error = "Empty file";
		if (!isset($error) && exif_imagetype($_FILES["image"]["tmp_name"]) === FALSE)
			$error = "Invalid file type";
		if ($_FILES["image"]["size"] > 1000000)
			$error = "File too large. (> 1MB)";
		if (!isset($error) && ($insert_id = categories_addcategory($_POST['name'])) === FALSE)
			$error = "Unabble to create category";
		$extension = pathinfo($_FILES["image"]["name"])['extension'];
		$target_file = CATEGORIES_FOLDER.'/'.$insert_id;
		if ($insert_id !== FALSE && !isset($error) && !file_exists(CATEGORIES_FOLDER))
			mkdir(CATEGORIES_FOLDER, 0755, TRUE);
		if ($insert_id !== FALSE && !isset($error) && !move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
			$error = "Unable to upload the file";
		if ($insert_id !== FALSE && isset($error) && file_exists($target_file))
			@unlink($target_file);
		if (isset($error) && $insert_id !== FALSE && !categories_delcategory($insert_id))
			$error = "Unexpected error";
	}
	$categories = categories_getcategories();
	include "views/admin/categories.php";
}

function products($args)
{
	if (isset($_POST['editproduct']))
	{
		if (!isset($_POST['id']))
			$error = "invalid product id";
		if (!isset($error) && product_editproduct($_POST['id'], $_POST['name'], $_POST['price'], $_POST['stock']) === FALSE)
			$error = "Unable to edit product";
	}
	else if ($_POST['delproduct'] == 'delete')
	{
		if (!isset($_POST['id']) || !product_delproduct($_POST['id']))
			$error = "Unabble to delete product ".$_POST['id']."!";
	}
	else if ($_POST['addproduct'] == 'add')
	{
		if (!isset($_POST['name']))
			$error = "Empty name";
		if (!isset($_POST['price']))
			$error = "Empty price";
		if (isset($_POST['price']) && !is_numeric($_POST['price']))
			$error = "Price is not a number";
		if ($_FILES["image"]['tmp_name'] == '' || $_FILES["image"]['name'] == '')
			$error = "Empty file";
		if (!isset($error) && exif_imagetype($_FILES["image"]["tmp_name"]) === FALSE)
			$error = "Invalid file type";
		if ($_FILES["image"]["size"] > 1000000)
			$error = "File too large. (> 1MB)";
		if (!isset($error) && ($insert_id = product_addproduct($_POST['name'], $_POST['price'])) === FALSE)
			$error = "Unabble to create product";
		$extension = pathinfo($_FILES["image"]["name"])['extension'];
		$target_file = PRODUCTS_FOLDER.'/'.$insert_id;
		if ($insert_id !== FALSE && !isset($error) && !file_exists(PRODUCTS_FOLDER))
			mkdir(PRODUCTS_FOLDER, 0755, TRUE);
		if ($insert_id !== FALSE && !isset($error) && !move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
			$error = "Unable to upload the file";
		if ($insert_id !== FALSE && isset($error) && file_exists($target_file))
			@unlink($target_file);
		if (isset($error) && $insert_id !== FALSE && !product_delproduct($insert_id))
			$error = "Unexpected error";
	}
	$products = product_getproducts();
	$o_products = [];
	foreach ($products as &$p2)
		if ($_SESSION['cart'][$p2['id']] > 0)
		{
			$p2['amount'] = $_SESSION['cart'][$p2['id']];
			$p2['totalprice'] = ($p2['amount'] + 0) * ($p2['price'] + 0);
			$o_products[] = $p2;
		}
	$total = array_sum(array_column($o_products, 'totalprice'));
	$GLOBALS['total_cart'] = $total;
	include "views/admin/products.php";
}

function category($args)
{
	if ($args[0] == '' || ($category = categories_getcategory($args[0])) === FALSE)
	{
		error('Not Found');
		return ;
	}

	if ($_POST['delproduct'] == 'delete')
	{
		if (!isset($_POST['id']) || categories_unlinkproduct($category['id'], $_POST['id']) === FALSE)
			$error = "Unabble to delete product ".$_POST['id']." from category !";
	}
	else if ($_POST['addproduct'] == 'add')
	{
		if (!isset($_POST['product']) || categories_linkproduct($category['id'], $_POST['product']) === FALSE)
			$error = "Unabble to add product to category !";
	}
	$products = categories_getproducts($category['id']);
	$o_all_products = product_getproducts();
	$all_products = [];
	foreach ($o_all_products as $p)
		if (!in_array($p, $products))
			$all_products[] = $p;
	include "views/admin/category.php";
}

function orders()
{
	if ($_POST['delorder'] == 'delete')
	{
		if (!isset($_POST['id']) || !order_delorder($_POST['id']))
			$error = "Unabble to delete order ".$_POST['id']."!";
	}
	$orders = order_getorders();
	include "views/admin/orders.php";
}

function order($args)
{
	if ($args[0] == '' || ($products = order_getproducts($args[0])) === FALSE)
	{
		error('Not Found');
		return ;
	}

	if ($_POST['delproduct'] == 'delete')
	{
		if (!isset($_POST['id']) || order_unlinkproduct($args[0], $_POST['id']) === FALSE)
			$error = "Unabble to delete product ".$_POST['id']." from order !";
		else
			$products = order_getproducts($args[0]);
	}

	$order_id = $args[0];
	include "views/admin/order.php";
}

?>
