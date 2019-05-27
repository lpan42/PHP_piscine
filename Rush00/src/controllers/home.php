<?php

include_once "models/categories.php";
include_once "models/product.php";
include_once "models/order.php";

function index($args)
{
	$GLOBALS['title'] = "HOME";
	$products = product_getlastbuyproducts();
	include "views/index.php";
}
function categories()
{
	$categories = categories_getcategories();
	include "views/categories.php";
}

function products($args)
{
	$GLOBALS['title'] = "PAGES";
	$products = product_getproducts();
	include "views/products.php";
}

function category($args)
{
	if ($args[0] == '' || ($category = categories_getcategory($args[0])) === FALSE)
	{
		error('Not Found');
		return ;
	}
	$products = categories_getproducts($category['id']);
	include "views/products.php";
}

function cart($args)
{
	if ($_POST['cancelcart'] == 'clear my cart')
	{
		$_SESSION['cart'] = [];
	}
	else if ($_POST['delproduct'] == 'delete')
	{
		if (!isset($_POST['id']))
			$error = "Unable to delete product ".$_POST['id']." from category !";
		if (isset($_POST['id']))
		{
			if ($_SESSION['cart'][$_POST['id']] > 0)
				$_SESSION['cart'][$_POST['id']]--;
			if ($_SESSION['cart'][$_POST['id']] == 0)
				unset($_SESSION['cart'][$_POST['id']]);
		}
	}
	else if ($_POST['submitorder'] == 'comfirm my order')
	{
		if (isset($_SESSION['user']))
		{
			if (count($_SESSION['cart']) == 0)
				$error = "Empty cart";
			if (!isset($error) && ($order_id = order_addorder($_SESSION['user']['id'])) === FALSE)
				$error = "Unable to create order";
			if (!isset($error))
			{
				foreach ($_SESSION['cart'] as $id => $p)
				{
					if (!isset($p))
						continue ;
					if (($product = product_getproduct($id)) === FALSE)
					{
						$error = "Unable to get product";
						break;
					}
					if (order_linkproduct($order_id, $id, $p) === FALSE)
					{
						$error = "Unable to link a product to an order";
						break;
					}
					if ($product['stock'] - $p < 0)
					{
						$error = "the product ".$id." is out of stock (need $p but ".$product['stock']." available)";
						break;
					}
					product_editproduct($product['id'], '', '', $product['stock'] - $p);
				}
				if (!isset($error))
				{
					$_SESSION['cart'] = [];
					redirect('/users/orders');
					return ;
				}
			}
		}
		else
			$error = "You need to be connected to validate your order";
	}

	$o_products = product_getproducts();
	$products = [];
	foreach ($o_products as &$p2)
		if ($_SESSION['cart'][$p2['id']] > 0)
		{
			$p2['amount'] = $_SESSION['cart'][$p2['id']];
			$p2['totalprice'] = ($p2['amount'] + 0) * ($p2['price'] + 0);
			$products[] = $p2;
		}
	$total = array_sum(array_column($products, 'totalprice'));
	$GLOBALS['total_cart'] = $total;
	include "views/cart.php";
}

function search($args)
{
	$products = product_getproducts();
	$search = isset($_POST['search']) ? $_POST['text'] : rawurldecode($args[0]);
	if (isset($search) || isset($_POST['search']))
	{
		if (($products = product_searchproducts($search)) == FALSE)
			$products = [];
	}
	include "views/search.php";
}

?>
