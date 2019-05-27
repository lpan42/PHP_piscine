<?php

include_once "core/mysql.php";
include_once "models/auth.php";
include_once "models/order.php";

function user_getusers()
{
	$con = connect();
	$query = "SELECT id, login, rank FROM users";
	$users = [];
	if ($stmt = mysqli_prepare($con, $query))
	{
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return [];
		$result = mysqli_stmt_get_result($stmt);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			$users[] = $row;
		mysqli_free_result($result);
		mysqli_stmt_close($stmt);
	}
	return $users;
}

function user_deluser($id)
{
	$con = connect();
	$query = "DELETE FROM users WHERE `id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "i", $id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		return order_deluser_orders($id);
	}
	return FALSE;
}

function user_edituser($id, $rank)
{
	$con = connect();
	$query = "UPDATE users SET `rank` = ? WHERE `id` = ?";
	if ($stmt = mysqli_prepare($con, $query))
	{
		mysqli_stmt_bind_param($stmt, "si", $rank, $id);
		if (@mysqli_stmt_execute($stmt) == FALSE || mysqli_stmt_errno($stmt) !== 0)
			return FALSE;
		return TRUE;
	}
	return FALSE;
}

?>
