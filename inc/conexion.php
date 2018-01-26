<?php
	$host= DB_HOST;
	$user=DB_USER;
	$clave= DB_PASSWORD;
	$db=DB_NAME;
	$conexion= mysqli_connect($host,$user,$clave,$db)or die("Error.." . mysqli_error($conexion));

?>