<?php
    require ('config.php');
    require ('conexion.php');
    require '../admin/TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
    require('../admin/TemplateMail/mandarmail.php');
    session_start();
	$numFactura=$_POST['paymentid'];
	$nomParticipante=$_POST['nombreyapellidoInput'];
    $user_id=$_SESSION['user_id'];
    if($_POST['paymentstate']=="approved")
    {
        $estado="aceptado";
        $existe = mysqli_query($conexion, "DELETE FROM pagoefectivo WHERE idUsers='$user_id'");
        $query= mysqli_query($conexion, "INSERT INTO pagoefectivo (numFactura, nomParticipante, idUsers, estado) VALUES ('$numFactura', '$nomParticipante', '$user_id', '$estado')");
        $query= mysqli_query($conexion, "UPDATE login SET estado = 'cursos' WHERE id = '$user_id'");
        $userMail= mysqli_query($conexion, "SELECT correoElectronico,nombreyapellidoInput  FROM login WHERE id = '$user_id'");
        $userMail= mysqli_fetch_assoc($userMail);
        $correoElectronico= $userMail['correoElectronico'];
        $nombreyapellidoInput= $userMail['nombreyapellidoInput'];
        $subject = 'Pago de Inscripción Aceptado - CLEIN República Dominicana 2018 clein.org';
        $mensaje = '¡BIENVENIDO/A A BORDO! Hemos recibido su pago satisfactoriamente. PRÓXIMO PASO Le recomendamos revisar a detalle la guía del asistente y finalmente visualizar el hotel sede.';
        $nuevoUsuario = new MandarMail;
        $nuevoUsuario->informarestados($correoElectronico,"paso4bienvenido.php",$subject,$nombreyapellidoInput,$mensaje);
        header("Location:../inscripciones_paso4_actividades.php");
    }
    else
    {
        header("Location:../inscripciones_paso3.php");
    }