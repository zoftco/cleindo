<?php
    require('../inc/config.php');
    require('../inc/conexion.php');
    require 'TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
    require('TemplateMail/mandarmail.php');

    $user_id=htmlspecialchars($_POST['user_id']);
    $mensaje=htmlspecialchars($_POST['mensaje']);

	$query= mysqli_query($conexion, "UPDATE imagenes SET mensaje = '$mensaje' WHERE user_id = '$user_id'");
	$query= mysqli_query($conexion, "UPDATE imagenes SET estado = 'rechazado' WHERE user_id = '$user_id'");
    $userMail= mysqli_query($conexion, "SELECT correoElectronico, nombreyapellidoInput FROM login WHERE id = '$user_id'");
    $userMail= mysqli_fetch_assoc($userMail);

    $correoElectronico= $userMail['correoElectronico'];
    $nombreyapellidoInput= $userMail['nombreyapellidoInput'];
    $subject = 'Documentos de Solicitud de Inscripción Rechazados - CLEIN República Dominicana 2018 clein.org';
    $titulo = 'Hay un problema';
    $mensaje = 'Hay un problema con los documentos enviados. '.$mensaje.' Ingrese a https://www.clein.org/inscripciones_paso2.php para realizar el envío nuevamente.';

    $nuevoUsuario = new MandarMail;
    $nuevoUsuario->mandar($titulo,$mensaje,$correoElectronico,$subject,$nombreyapellidoInput);
    header('Location:admin.php');

?>