<?php
	$user_id=$_POST['user_id'];
	require('../inc/conexion.php');
	$query= mysqli_query($conexion, "UPDATE login SET estado = 'cursos' WHERE id = '$user_id'");
	$query= mysqli_query($conexion, "UPDATE pagoefectivo SET estado = 'aceptado' WHERE idUsers = '$user_id'");
	$userMail= mysqli_query($conexion, "SELECT correoElectronico FROM login WHERE id = '$user_id'");
	$userMail= mysqli_fetch_assoc($userMail);
	$correo= $userMail['correoElectronico'];
	$titulo = 'Pago aceptado!';
	$mensaje = 'Su pago de inscripción ha sido aceptado. Haga click <a target="_BLANK" href="'.WEB_URL.'/log_in.php">aquí</a> para ver los cursos disponibles.';
	$sujeto = 'Su pago ha sido aceptado';
	header('Location:'.WEB_URL.'/admin/TemplateMail/olvidocontrasenha.php?titulo='.$titulo.'&mensaje='.$mensaje.'&correo='.$correo.'&sujeto='.$sujeto.'&tipoMail=pago');
?>