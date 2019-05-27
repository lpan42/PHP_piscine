<?php

include_once "core/mysql.php";

function do_auth($login, $passwd)
{
	$con = connect();
	$query = "SELECT id, login, rank, passwd FROM users WHERE login=? AND passwd=?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		$hash = hash('whirlpool', $passwd);
		mysqli_stmt_bind_param($stmt, "ss", $login, $hash);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
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

function do_register($login, $passwd, $rank = 'user')
{
	if (!isset($login) || !isset($passwd))
		return (FALSE);
	$con = connect();
	$query = "INSERT INTO users (login, passwd, `rank`) VALUES (?, ?, ?)";
	if ($stmt = mysqli_prepare($con, $query))
	{
		$hash = hash('whirlpool', $passwd);
		mysqli_stmt_bind_param($stmt, "sss", $login, $hash, $rank);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return TRUE;
	}
	else
		return FALSE;
}

function do_modif_pwd($id, $newhash)
{
	$con = connect();
	$query = "UPDATE users SET `passwd` = ? WHERE `id` = ?";
	if($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "si", $newhash, $id);
		if (mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return (FALSE);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		return (TRUE);
	}
	else
		return FALSE;
}

function check_captcha($reponse)
{
	$post = ['secret' => '6LdBjaUUAAAAALpcN4q29m6RKZSBm1dpaX_hh6sD', 'response' => $reponse];
	$ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$result = json_decode(curl_exec($ch), true);
	return ($result['success'] == TRUE);
}

?>
