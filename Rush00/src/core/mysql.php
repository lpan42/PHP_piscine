<?php

function connect()
{
	if (isset($GLOBALS['sql_connection']))
		return $GLOBALS['sql_connection'];
	$GLOBALS['sql_connection'] = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
	if (!$GLOBALS['sql_connection']) {
		echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
		echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
		echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
		$GLOBALS['connected'] = NULL;
		exit;
	}
	return $GLOBALS['sql_connection'];
}


?>
