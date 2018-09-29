<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);


		
	//$titulo = $_GET['titulo'];
	//$mensaje = $_GET['mensaje'];
	//$correo = $_GET['correo'];
	//$sujeto = $_GET['sujeto'];

	class MandarMail {
		function mandar($titulo, $mensaje, $correo, $subject, $nombre="") {
			//$body = '<h4 style="padding:10px;color:#182e53">'.$titulo.'</h4> <span style="padding:10px"> '.$mensaje.'</span>';
			$mailvariables= array('({titulo})' => $titulo, '({mensaje})' => $mensaje);
			$mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = MAIL_SERVER_HOST;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = MAIL_SERVER_USER;                 // SMTP username
                $mail->Password = MAIL_SERVER_PASS;                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = MAIL_SERVER_PORT;                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
                $mail->Debugoutput = 'html';

                //Recipients
                $mail->setFrom(CONTACT_MAIL, 'Inscripciones CLEIN');
                $mail->addAddress($correo, $nombre);
                $mail->addReplyTo(CONTACT_MAIL, 'Inscripciones CLEIN');

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = preg_replace(array_keys($mailvariables), array_values($mailvariables), file_get_contents(__DIR__ . '/mensaje.php'));
                $mail->AltBody = $mensaje;

                $mail->send();
                echo 'Mensaje Enviado';
            }
            catch (Exception $e) {
                echo 'Mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
            }
		}

        function mandar2($titulo, $mensaje, $correo, $subject, $nombre="") {
            //$body = '<h4 style="padding:10px;color:#182e53">'.$titulo.'</h4> <span style="padding:10px"> '.$mensaje.'</span>';
            $mailvariables= array('({titulo})' => $titulo, '({mensaje})' => $mensaje);
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = MAIL_SERVER_HOST;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = MAIL_SERVER_USER;                 // SMTP username
                $mail->Password = MAIL_SERVER_PASS;                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = MAIL_SERVER_PORT;                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
                $mail->Debugoutput = 'html';

                //Recipients
                $mail->setFrom(CONTACT_MAIL, 'Inscripciones CLEIN');
                $mail->addAddress($correo, $nombre);
                $mail->addReplyTo(CONTACT_MAIL, 'Inscripciones CLEIN');

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = preg_replace(array_keys($mailvariables), array_values($mailvariables), file_get_contents(__DIR__ . '/mensaje.php'));
                $mail->AltBody = $mensaje;

                $mail->send();
                return 'Mensaje Enviado';
            }
            catch (Exception $e) {
                return 'Mensaje no pudo ser enviado. Mailer Error: '. $mail->ErrorInfo;
            }
        }

        function informarestados($correo, $plantilla, $subject, $nombre="", $mensaje ="", $estudiante="") {
            $mailvariables= array('({nombre})' => $nombre,'({estudiante})' => $estudiante);
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = MAIL_SERVER_HOST;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = MAIL_SERVER_USER;                 // SMTP username
                $mail->Password = MAIL_SERVER_PASS;                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = MAIL_SERVER_PORT;                                    // TCP port to connect to

                $mail->CharSet = "UTF-8";
                $mail->Debugoutput = 'html';

                //Recipients
                $mail->setFrom(CONTACT_MAIL, 'Inscripciones CLEIN');
                $mail->addAddress($correo, $nombre);
                $mail->addReplyTo(CONTACT_MAIL, 'Inscripciones CLEIN');


                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = preg_replace(array_keys($mailvariables), array_values($mailvariables), file_get_contents(__DIR__ . DIRECTORY_SEPARATOR. $plantilla));
                $mail->AltBody = $mensaje;

                $mail->send();
//                echo 'Mensaje Enviado';
            }
            catch (Exception $e) {
//                echo 'Mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
            }
        }
	}