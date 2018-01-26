<?php
    require('../inc/config.php');
	require('../inc/conexion.php');
    require 'TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
    require('TemplateMail/mandarmail.php');

    $user_id=$_POST['user_id'];
	$query= mysqli_query($conexion, "UPDATE login SET estado = 'cursos' WHERE id = '$user_id'");
	$query= mysqli_query($conexion, "UPDATE pagoefectivo SET estado = 'aceptado' WHERE idUsers = '$user_id'");
	$userMail= mysqli_query($conexion, "SELECT correoElectronico,nombreyapellidoInput  FROM login WHERE id = '$user_id'");
	$userMail= mysqli_fetch_assoc($userMail);
    $correoElectronico= $userMail['correoElectronico'];
    $nombreyapellidoInput= $userMail['nombreyapellidoInput'];
    $subject = 'Pago de Inscripción Aceptado - CLEIN República Dominicana 2018 clein.org';
    $mensaje = '¡BIENVENIDO/A A BORDO! Hemos recibido su pago satisfactoriamente. PRÓXIMO PASO Le recomendamos revisar a detalle la guía del asistente y finalmente visualizar el hotel sede.';
    $nuevoUsuario = new MandarMail;
    $nuevoUsuario->informarestados($correoElectronico,"paso4bienvenido.php",$subject,$nombreyapellidoInput,$mensaje);

	header('Location:adminpagos.php');
?>