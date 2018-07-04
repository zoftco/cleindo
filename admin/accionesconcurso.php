<?php
    require('../inc/config.php');
	require('../inc/conexion.php');
    require 'TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
    require('TemplateMail/mandarmail.php');
    require_once('php/sessioncontrol.php');
    $session = new sessioncontrol();

    $admin_id=$_SESSION['admin_id'];
    $idconcurso=htmlspecialchars($_POST['idconcurso']);
    $estado=htmlspecialchars($_POST['accion']);
    $mensajeadmin=htmlspecialchars($_POST['mensaje']);

	$query= mysqli_query($conexion, "UPDATE concurso SET estadoDocumento = '$estado', usuarioaprobadorDocumento = '$admin_id', mensajeDocumento = '$mensajeadmin' WHERE idconcurso = '$idconcurso'");


	$userMail= mysqli_query($conexion, "SELECT * from concurso LEFT JOIN (SELECT correoElectronico,nombreyapellidoInput, id FROM login) AS perfil ON concurso.idlogin = perfil.id WHERE concurso.idconcurso='$idconcurso'");
	$userMail= mysqli_fetch_assoc($userMail);
    $correoElectronico= $userMail['correoElectronico'];
    $nombreyapellidoInput= $userMail['nombreyapellidoInput'];
    $tipoDocumento= $userMail['tipoDocumento'];
    $subject = 'Concurso de Ponencias - CLEIN República Dominicana 2018 clein.org';
    $mensaje = $mensajeadmin;
    $titulo = 'Tu documento '.$tipoDocumento.' ha sido '.$estado.'. ';
    //$nuevoUsuario = new MandarMail;
    //$nuevoUsuario->mandar($titulo,$mensaje,$correoElectronico,$subject,$nombreyapellidoInput);

	header('Location:adminconcurso.php');
?>