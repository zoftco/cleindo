<?php
    require('../inc/config.php');
    require('../inc/conexion.php');
    require 'TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
    require('TemplateMail/mandarmail.php');
	$user_id=$_POST['user_id'];
	$query= mysqli_query($conexion, "UPDATE login SET estado = 'pago' WHERE id = '$user_id'");
	$query= mysqli_query($conexion, "UPDATE imagenes SET estado = 'aceptado' WHERE user_id = '$user_id'");
	$userMail= mysqli_query($conexion, "SELECT correoElectronico, nombreyapellidoInput, estudiante FROM login WHERE id = '$user_id'");
	$userMail= mysqli_fetch_assoc($userMail);
    $correoElectronico= $userMail['correoElectronico'];
    $nombreyapellidoInput= $userMail['nombreyapellidoInput'];
    $estudiante= $userMail['estudiante'];
    $subject = 'Documentos de Solicitud de Inscripción Aceptados - CLEIN República Dominicana 2018 clein.org';
    $mensaje = '¡EN HORA BUENA! Está a punto de completar su pase para abordar una de las mejores experiencias profesional, estudiantil y personal que será el CLEIN República Dominicana 2018, y para nosotros será un honor contar con su presencia. Su solicitud de inscripción ha sido aceptada. Ingrese a https://www.clein.org/inscripciones_paso3.php para realizar el pago de su inscripción.';

    $nuevoUsuario = new MandarMail;
    $nuevoUsuario->informarestados($correoElectronico,"paso3enhorabuena.php",$subject,$nombreyapellidoInput,$mensaje,$estudiante);

?>