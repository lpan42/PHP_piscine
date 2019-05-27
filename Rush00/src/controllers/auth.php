<?php 

include_once "models/auth.php";

function login($args)
{
	if ($_POST['submit'] == 'Connexion')
	{
		
		if ($user = do_auth($_POST['login'], $_POST['passwd']))
		{
			$_SESSION['user'] = $user;
			redirect('/home');
			return ;
		}
		$error = "Invalid credentials";
	}
	$GLOBALS['title'] = "HOME";
	include "views/auth/login.php";
}

function register($args)
{
	if ($_POST['submit'] == 'Inscription')
	{
		if (!$_POST['login'] || !$_POST['passwd'] || !$_POST['confirm'] || !$_POST['g-recaptcha-response'])
			$error = "Un des champs est vide !";
		if (!isset($error) && $_POST['passwd'] != $_POST['confirm'])
			$error = "Les mots de passe ne correspondent pas !";
		if (!isset($error) && !isset($_POST['g-recaptcha-response']) || (check_captcha($_POST['g-recaptcha-response'])) === FALSE)
			$error = "Invalid captcha";
		if (!isset($error) && ($reister = do_register($_POST['login'], $_POST['passwd'])) === FALSE)
			$error = "Impossible de creer le compte";
		if (!isset($error))
		{
			redirect('/auth/login');
			return ;
		}
	}
	$GLOBALS['title'] = "HOME";
	include "views/auth/register.php";
}

function logout($args)
{
	if (!isset($_SESSION['user']))
	{
		redirect('/home');
		return ;
	}
	$_SESSION['user'] = NULL;
	redirect('/home');
}

?>
