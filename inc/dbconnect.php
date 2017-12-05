<?php

require('conexion.php');

require("../inc/config.php");
require '../admin/TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
require('../admin/TemplateMail/mandarmail.php');

$nombreyapellidoInput=utf8_decode($_POST['nombreyapellidoInput']);
$idNumber=$_POST['idNumber'];
$pais=$_POST['pais'];
$estudiante=$_POST['estudiante'];
$fechaNacimiento=$_POST['fechaNacimiento'];
$correoElectronico=$_POST['correoElectronico'];
$contra = $_POST['contrasena'];
$contrasena=hash("sha512", $_POST['contrasena']);
$telefono = $_POST['telefono'];

/*require('smtp_validateEmail.class.php');
$sender = 'user@mydomain.com';
$validacionMail = new smtp_validateEmail();
$validacionMail->debug = false;
$resultados = $validacionMail->validate(array($correoElectronico), $sender);*/
$resultados = true;

//if (@$resultados[$correoElectronico]) {
if ($resultados) {
	$query1 = mysqli_query($conexion, "SELECT correoElectronico FROM login WHERE correoElectronico='".$correoElectronico."'");

	if (mysqli_num_rows($query1) != 0) {
		$respuesta= array('respuesta'=>'Ya existe un usuario registrado con ese correo electrónico');
		echo json_encode($respuesta);
	} else {
		if($pais != "PY" && $estudiante == "no") {
			$currentState="pago";
		} elseif($pais != "PY" && $estudiante == "si") {
			$currentState="verificacion";
		} elseif($pais == "PY" && $estudiante == "si") {
			$currentState="verificacion";
		} else {
			$currentState="verificacion";
		}
		$query= mysqli_query($conexion, "INSERT INTO login (nombreyapellidoInput, idNumber, pais, estudiante, 
			fechaNacimiento, correoElectronico, contrasena, estado, telefono) VALUES ('$nombreyapellidoInput', '$idNumber', '$pais', '$estudiante', 
			'$fechaNacimiento', '$correoElectronico', '$contrasena', '$currentState', '$telefono')") or die(mysqli_error($conexion));

		
		$user_id= mysqli_insert_id($conexion);

		$titulo = "CLEIN Paraguay";
		$sujeto = "Información de usuario";
		$mensaje = "Gracias por registrarte a nuestra página.</br>Tu usuario es: ".$correoElectronico." y tu contraseña es: ".$contra;

		$nuevoUsuario = new MandarMail;
	$nuevoUsuario->mandar($titulo, $mensaje, $correoElectronico, $sujeto);

		if($conexion->query($query) == false) {
			// $token =uniqid();
			// $vencimiento = date("Y-m-d H:i:s", time() + 3600);
			// $query= mysqli_query($conexion, "INSERT INTO sesion (token, vencimiento, user_id) VALUES ('$token', '$vencimiento', $user_id)");
			session_start();
			$_SESSION['user_id'] = $user_id;
			$_SESSION['time'] = time();
			$respuesta=array('user_id'=>$user_id);

			echo json_encode($respuesta);
		} else {
			echo "Error aca";
		}
	}
} else {
	$respuesta= array('respuesta'=>'Ya existe un usuario registrado con ese correo electrónico');
	echo json_encode($respuesta);
}
?>
