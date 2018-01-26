<?php
    require('../inc/config.php');
    require('../inc/conexion.php');
    require 'TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
    require('TemplateMail/mandarmail.php');

    $user_id=htmlspecialchars($_POST['user_id']);
    $mensaje=htmlspecialchars($_POST['mensaje']);

	$query= mysqli_query($conexion, "UPDATE pagoefectivo SET mensaje = '$mensaje' WHERE idUsers = '$user_id'");
	$query= mysqli_query($conexion, "UPDATE pagoefectivo SET estado = 'rechazado' WHERE idUsers = '$user_id'");

	$userMail= mysqli_query($conexion, "SELECT correoElectronico,nombreyapellidoInput FROM login WHERE id = '$user_id'");
	$userMail= mysqli_fetch_assoc($userMail);
    $correoElectronico= $userMail['correoElectronico'];
    $nombreyapellidoInput= $userMail['nombreyapellidoInput'];
    $subject = 'Hay un problema con su pago - CLEIN República Dominicana 2018 clein.org';
    $titulo = 'Hay un problema con su pago';
    $mensaje = 'Hay un problema con los comprobantes de pago enviados. '.$mensaje.' Ingrese a https://www.clein.org/inscripciones_paso3.php para realizar el envío nuevamente.';

    $nuevoUsuario = new MandarMail;
    $nuevoUsuario->mandar($titulo,$mensaje,$correoElectronico,$subject,$nombreyapellidoInput);
	header('Location:adminpagos.php');
?>