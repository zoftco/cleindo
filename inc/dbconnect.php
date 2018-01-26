<?php
require('config.php');
require('conexion.php');

require '../admin/TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
require('../admin/TemplateMail/mandarmail.php');

$nombreyapellidoInput=mysqli_real_escape_string($conexion,utf8_decode($_POST['nombreyapellidoInput']));
$correoElectronico=mysqli_real_escape_string($conexion,$_POST['correoElectronico']);
$telefono = mysqli_real_escape_string($conexion,$_POST['telefono']);
$nivelacademico=mysqli_real_escape_string($conexion,$_POST['nivelacademico']);
$pais=mysqli_real_escape_string($conexion,$_POST['pais']);
$facebook=mysqli_real_escape_string($conexion,$_POST['facebook']);
$instagram=mysqli_real_escape_string($conexion,$_POST['instagram']);
$contrasena=hash("sha512", $_POST['contrasena']);

$resultados = true;

//if (@$resultados[$correoElectronico]) {
if ($resultados) {
	$query1 = mysqli_query($conexion, "SELECT correoElectronico FROM login WHERE correoElectronico='".$correoElectronico."'");

	if (mysqli_num_rows($query1) != 0) {
		$respuesta= array('respuesta'=>'Ya existe un usuario registrado con ese correo electrónico');
		echo json_encode($respuesta);
	} else {
		$currentState="verificacion";
		$query= mysqli_query($conexion, "INSERT INTO login (nombreyapellidoInput, pais, estudiante, 
			correoElectronico, contrasena, estado, telefono, facebook, instagram) VALUES ('$nombreyapellidoInput', '$pais', '$nivelacademico', 
			'$correoElectronico', '$contrasena', '$currentState', '$telefono','$facebook', '$instagram')") or die(mysqli_error($conexion));
		
		$user_id= mysqli_insert_id($conexion);

		$subject = "Registro de usuario CLEIN República Dominicana 2018 clein.org";
		$mensaje = "¡Saludos! Recibe una cordial bienvenida de parte del equipo CLEIN RD2018, gracias por crear su usuario y mostrar interés por el congreso Latinoamericano de Estudiantes e Ingenieros Industriales y afines, está a punto de desafiar sus límites y revolucionar su mundo. PRÓXIMO PASO Para continuar con el proceso, proceda a adjuntar algún documento que valide y compruebe su estatus estudiantil, en caso de no ser estudiante adjuntar una identificación o pasaporte. Recuerda que para nosotros será un honor contar con su presencia.";

		$nuevoUsuario = new MandarMail;
        $nuevoUsuario->informarestados($correoElectronico,"paso1saludos.php",$subject,$nombreyapellidoInput,$mensaje);

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
