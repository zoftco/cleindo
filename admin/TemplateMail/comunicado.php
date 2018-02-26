<?php
	require("../../inc/config.php");
	require 'PHPMailer-master/PHPMailerAutoload.php';
		
	$titulo = $_POST['titulo'];
	$mensaje = $_POST['mensaje'];
	$sujeto = $_POST['sujeto'];
	$quienMandar = $_POST['quienMandar'];

	$mailvariables= array('({titulo})' => $titulo, '({mensaje})' => $mensaje);

	require('../../inc/conexion.php');

	if($quienMandar == 'todos') {
		$query= mysqli_query($conexion, "SELECT correoElectronico FROM login");
	} elseif($quienMandar == 'sinDocumentos') {
		$query= mysqli_query($conexion, "SELECT correoElectronico FROM login WHERE estado='verificacion'");
	} elseif($quienMandar == 'sinComprobantes') {
		$query= mysqli_query($conexion, "SELECT correoElectronico FROM login WHERE estado='pago'");
	} elseif($quienMandar == 'cursos') {
		$query= mysqli_query($conexion, "SELECT correoElectronico FROM login WHERE estado='cursos'");
	}

	$mails = array();
	while($row = mysqli_fetch_assoc($query)) {
		$mails[] = $row;
	}

	

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


		foreach($mails as $key=>$value) {
			$correo = $mails[$key]['correoElectronico'];
			$mail->addBCC($correo);
		}

		$mail->Subject = $sujeto;
		$mail->msgHTML(preg_replace(array_keys($mailvariables), array_values($mailvariables), file_get_contents('index.php')), dirname(__FILE__));
			
		if (!$mail->send()) {
			echo 'No se envio la solicitud correctamente, favor intente de nuevo más tarde';
			require('../inc/conexion.php');
			$query= mysqli_query($conexion, "UPDATE login SET estado = 'verificacion' WHERE id = '$user_id'");
			$query= mysqli_query($conexion, "UPDATE imagenes SET estado = 'pendiente' WHERE user_id = '$user_id'");
		} else {
			if (isset($_POST['tipoMail'])) {
				$tipoMail = $_POST['tipoMail'];
			}
			if ($tipoMail == 'totalregistrados') {
				header("Location:".WEB_URL."/admin/totalregistrados.php");
			} else {
				header("Location:".WEB_URL."/admin/admin.php");
			}
		}	
				
?>