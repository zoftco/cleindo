<?php
require('../inc/config.php');
require('../inc/conexion.php');
require 'TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
require('TemplateMail/mandarmail.php');
$user_id=$_POST['user_id'];
$userMail= mysqli_query($conexion, "SELECT correoElectronico, nombreyapellidoInput, estudiante FROM login WHERE id = '$user_id'");
$userMail= mysqli_fetch_assoc($userMail);
$correoElectronico= $userMail['correoElectronico'];
$nombreyapellidoInput= $userMail['nombreyapellidoInput'];
$estudiante= $userMail['estudiante'];
$subject = $_POST['sujeto'];
$mensaje = $_POST['mensaje'];
$titulo = $_POST['titulo'];

$nuevoUsuario = new MandarMail;
$nuevoUsuario->mandar($titulo, $mensaje, $correoElectronico, $subject,$nombreyapellidoInput);

header('Location:totalregistrados.php?emailenviado=si');