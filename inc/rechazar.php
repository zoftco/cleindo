<?php
	$razonRechazo=$_POST['razonRechazo'];
	$user_id=$_POST['user_id'];
	$host= "localhost";
	$user="root";
	$clave= "";
	$db="clein";
	$conexion= mysqli_connect($host,$user,$clave,$db)or die("Error.." . mysqli_error($conexion));
	$query= mysqli_query($conexion, "DELETE FROM `imagenes` WHERE user_id = '$user_id';");
	$query= mysqli_query($conexion, "UPDATE login SET estado = 'rechazado' WHERE user_id = '$user_id'");
	$query= mysqli_query($conexion, "UPDATE login SET mensaje = '$razonRechazo' WHERE id = '$user_id'");
	header("Location:http://localhost/CleinFinal/admin.php");
?>
<!--  -->