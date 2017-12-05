<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);


		
	//$titulo = $_GET['titulo'];
	//$mensaje = $_GET['mensaje'];
	//$correo = $_GET['correo'];
	//$sujeto = $_GET['sujeto'];

	class MandarMail {
		function mandar($titulo, $mensaje, $correo, $sujeto) {
			//$body = '<h4 style="padding:10px;color:#182e53">'.$titulo.'</h4> <span style="padding:10px"> '.$mensaje.'</span>';
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
			$mail->setFrom(CONTACT_MAIL,'Info Clein');
			$mail->addReplyTo(CONTACT_MAIL,'Info Clein');
			$mail->addAddress($correo);
			$mail->Subject = $sujeto;
			//$mail->Body = $body;
			$mail->IsHTML(true);
			$mail->msgHTML(preg_replace(array_keys($mailvariables), array_values($mailvariables), file_get_contents('index.php')), dirname(__FILE__));
			$mail->send(); 
		}
	}