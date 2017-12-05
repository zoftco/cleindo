<?php
	session_start();
	require ('conexion.php');
	$user_id = $_SESSION['user_id'];
	$userState = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$user_id'");
	$userData = mysqli_fetch_assoc($userState);
	$userState = $userData['estado'];
	$userCountry = $userData['pais'];
	$userStudent = $userData['estudiante'];

	switch ($userState) {
		case 'verificacion':
			if ($userCountry == "PY" && $userStudent == "si") {
				header("Location:../inscripciones_paso2.php");
			} elseif ($userCountry == "PY" && $userStudent == "no") {
				header("Location:../inscripciones_paso2_ci.php");
			} elseif ($userCountry != "PY" && $userStudent == "si") {
				header("Location:../inscripciones_paso2_exg.php");
			}
		break;
		case 'pago':
			header("Location:../inscripciones_paso3.php");
		break;
		case 'cursos':
			header("Location:../cursos_disponibles.php");
		break;
	}

?>
