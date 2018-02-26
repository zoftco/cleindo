<?php
	session_start();
	require ('config.php');
	require ('conexion.php');
	$user_id = $_SESSION['user_id'];
	$userState = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$user_id'");
	$userData = mysqli_fetch_assoc($userState);
	$userState = $userData['estado'];
	$userCountry = $userData['pais'];
	$userStudent = $userData['estudiante'];

	switch ($userState) {
		case 'verificacion':
			header("Location:../inscripciones_paso2.php");
		break;
		case 'pago':
			header("Location:../inscripciones_paso3.php");
		break;
		case 'cursos':
			header("Location:../inscripciones_paso4_actividades.php");
		break;
	}

?>
