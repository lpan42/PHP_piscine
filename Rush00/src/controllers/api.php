<?php

function functions()
{
	$functions = array(
		'auth/do_auth' => [ 'rank' => 'invite' ],
		'auth/do_register' => [ 'rank' => 'user' ],
		'categories/categories_getproducts' => [ 'rank' => 'invite' ],
		'categories/categories_getcategories' => [ 'rank' => 'invite' ],
		'categories/categories_getcategory' => [ 'rank' => 'invite' ],
		'product/product_getproducts' => [ 'rank' => 'invite' ]
	);
	return $functions;
}


function _continue($next)
{
	$next();
	return (TRUE);
}

function has_rank($rank)
{
	$ranks = ['invite', 'user', 'admin'];

	if (($level = array_search($rank, $ranks)) === NULL)
		return (FALSE);
	if (isset($_SESSION['user']) && ($level_user = array_search($_SESSION['user']['rank'], $ranks)) === NULL)
		return (FALSE);
	if (!isset($_SESSION['user']))
		$level_user = 0;
	if ($level_user >= $level)
		return (TRUE);
	return (FALSE);
}

function middleware($context, $args, $next)
{
	$functions = functions();
	$model = $context['function'];
	if (file_exists(MODELS_FOLDER.'/'.$model.'.php'))
	{
		require_once(MODELS_FOLDER.'/'.$model.'.php');
		$func = $args[0];
		if (!is_callable($func))
			return _continue($next);
		header('Content-Type: application/json');
		if (!isset($functions[$model.'/'.$func]) || !has_rank($functions[$model.'/'.$func]['rank']))
		{
			echo json_encode(['error' => 'invalid permission']);
			return (FALSE);
		}
		array_shift($args);
		$result = call_user_func_array($func, $args);
		if ($result === FALSE)
			echo json_encode(['error' => 'invalid parameters']);
		else 
			echo json_encode($result);
		return (FALSE);
	}
	return _continue($next);
}

?>
