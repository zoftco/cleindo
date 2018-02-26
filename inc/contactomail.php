<?php
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$telefono = $_POST['telefono'];
	$pais = $_POST['pais'];
	$mensaje = $_POST['mensaje'];

	require ('config.php');
	require ('PHPMailer-master/PHPMailerAutoLoad.php');
	$mail = new PHPMailer;

	$mail->CharSet = 'UTF-8';

	$mail->isSMTP();                                     
	$mail->Host = MAIL_SERVER_HOST; 
	$mail->SMTPAuth = true;                               
	$mail->Username = MAIL_SERVER_USER;                 
	$mail->Password = MAIL_SERVER_PASS;                                                   
	$mail->Port = MAIL_SERVER_PORT;  

	$mail->From = $correo; //MAIL 
	$mail->FromName = $nombre; //NOMBRE
	$mail->addAddress('info@cleinecuador.com', 'Inscripciones CLEIN'); //MAIL Y NOMBRE
	$mail->addReplyTo($correo, $nombre);
	$mail->isHTML(true);

	$mail->Subject = 'Consulta Clein';
	$mail->Body = $mensaje."<br><br> <strong>".$nombre."</strong> de ".$pais.". Tel: ".$telefono."."; //mensaje

	if(!$mail->send()) {
		echo 'No se realizo el envío, por favor espere unos minutos e intente de nuevo';
	} else {
		header('Location:../contactoexitoso.php');
	}

?>