<?php
	$user_id=$_POST['user_id'];
	$host= "localhost";
	$user="root";
	$clave= "";
	$db="clein";
	$conexion= mysqli_connect($host,$user,$clave,$db)or die("Error.." . mysqli_error($conexion));
	$query= mysqli_query($conexion, "UPDATE login SET estado = 'aceptado' WHERE id = '$user_id'");
	$query= mysqli_query($conexion, "UPDATE imagenes SET estado = 'aceptado' WHERE user_id = '$user_id'");
	header("Location:http://localhost/CleinFinal/admin.php");
?>