<?php
	$enlace = mysql_connect($database['host'], $database['username'], $database['password']);
	if (!$enlace) {
		die('No se pudo conectar: <br> ' . mysql_error());
	}
	//asignar la base de datos
	mysql_select_db($database['database_name']);
		
?>