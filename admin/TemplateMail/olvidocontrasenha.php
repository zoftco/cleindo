<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

    require("../../inc/config.php");
	require 'PHPMailer-master/PHPMailerAutoload.php';
		
	$titulo = $_GET['titulo'];
	$mensaje = $_GET['mensaje'];
	$correo = $_GET['correo'];
	$sujeto = $_GET['sujeto'];

	$mailvariables= array('({titulo})' => $titulo, '({mensaje})' => $mensaje);
		
	$mail = new PHPMailer;
	$mail->CharSet = "UTF-8";
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = MAIL_SERVER_HOST;
	$mail->Port = MAIL_SERVER_PORT;
	$mail->SMTPAuth = true;
	$mail->Username = MAIL_SERVER_USER;
	$mail->Password = MAIL_SERVER_PASS;
	$mail->setFrom(CONTACT_MAIL,'Inscripciones CLEIN');
	$mail->addReplyTo(CONTACT_MAIL,'Inscripciones CLEIN');
	// $mail->addAddress($correo);
	$mail->addAddress($correo);
	$mail->Subject = $sujeto;
	$mail->msgHTML(preg_replace(array_keys($mailvariables), array_values($mailvariables), file_get_contents('index.php')), dirname(__FILE__));
		
	if (!$mail->send()) {
		echo 'No se envio la solicitud correctamente, favor intente de nuevo mas tarde';
		require('../../inc/conexion.php');
		if(isset($user_id)){
			$query= mysqli_query($conexion, "UPDATE login SET estado = 'verificacion' WHERE id = '$user_id'");
			$query= mysqli_query($conexion, "UPDATE imagenes SET estado = 'pendiente' WHERE user_id = '$user_id'");
		}
	} else {
        if (isset($_POST['tipoMail'])) {
            $tipoMail = $_POST['tipoMail'];
        }
        if (isset($_GET['tipoMail'])) {
            $tipoMail = $_GET['tipoMail'];
        }
        if ($tipoMail == 'totalregistrados' || $tipoMail == 'usuarios') {
            if ($tipoMail == 'totalregistrados' || $tipoMail == 'usuarios') {
                header("Location:".WEB_URL."/admin/totalregistrados.php");
            } elseif ($tipoMail == 'pago') {
                header("Location:".WEB_URL."/admin/adminpagos.php");
            } elseif ($tipoMail == 'admin') {
                header("Location:".WEB_URL."/admin/admin.php");
            } else {
                header("Location:".WEB_URL."/admin/admin.php");
            }
        }
    }
?>