<?php

include "core/constants.php";
include "core/mysql.php";
include "models/auth.php";

if ($_POST['submit'] == 'ok' && isset($_POST['login']) && $_POST['passwd'])
{
	$sql = connect();
	$queries = explode(';', file_get_contents('setup/database.sql'));
	
	foreach ($queries as $q)
		mysqli_query($sql, $q);

	if (do_register($_POST['login'], $_POST['passwd'], 'admin') === FALSE)
	{
		echo "Unable to create admin account";
		return ;
	}
	echo "Mysql database well imported";
	return ;
}
?>

<h1>Identifiants du compte admin</h1>
<form action="/install.php" method="post">
	<p><input type="text" placeholder="login" name="login" required></p>
	<p><input type="text" placeholder="passwd" name="passwd" required></p>
	<p><input type="submit" name="submit" value="ok"></p>
</form>
