<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	set_time_limit(600);
	$step = $_POST['step'];
	require('conexion.php');
	if ($step == 1) {
		$user_id=$_POST['user_id'];
		$universidad = $_POST['universidad'];
		$existeImagen = mysqli_query($conexion, "DELETE FROM imagenes WHERE user_id='$user_id'");
		$fotoCedula=$_FILES['fotoCedula'];
		$fotoFactura=$_FILES['fotoFactura'];
		$newstringCedula = substr($fotoCedula['type'], -3);
		$newstringFactura = substr($fotoFactura['type'], -3);
		$locationCedulas='../images/userfiles/paraguayosEstudiantes/cedulas/cedula='.$user_id.'.'.$newstringCedula;
		$locationFacturas='../images/userfiles/paraguayosEstudiantes/facturas/factura='.$user_id.'.'.$newstringFactura;
		$move = true;
		if ($fotoCedula['size'] > 5000000) {
			echo "muy grande la cedula";
			$move = false;
		}
		if ($fotoFactura['size'] > 5000000) {
			echo "my grande la factura";
			$move = false;
		}
		if ($move == true) {
			move_uploaded_file($fotoCedula['tmp_name'], $locationCedulas);
			move_uploaded_file($fotoFactura['tmp_name'], $locationFacturas);
			$locationCedulas4Db='/images/userfiles/paraguayosEstudiantes/cedulas/cedula='.$user_id.'.'.$newstringCedula;
			$locationFacturas4Db='/images/userfiles/paraguayosEstudiantes/facturas/factura='.$user_id.'.'.$newstringFactura;
			$query= mysqli_query($conexion, "INSERT INTO imagenes (fotoCedula, fotoFactura, user_id, estado) VALUES ('$locationCedulas4Db', '$locationFacturas4Db', '$user_id', 'pendiente')");

			mysqli_query($conexion, "UPDATE login SET universidad = '$universidad' WHERE id = '$user_id'");

			header("Location:../inscripciones_paso2.php");

		}
	} elseif ($step == 2) {
		$user_id=$_POST['user_id'];
		$existeImagen = mysqli_query($conexion, "DELETE FROM imagenes WHERE user_id='$user_id'");

		$fotoCedula=$_FILES['fotoCedula'];
		$newstringCedula = substr($fotoCedula['type'], -3);
		
		$locationCedulas='../images/userfiles/paraguayosProfesionales/cedulas/cedula='.$user_id.'.'.$newstringCedula;
		$move = true;
		if ($fotoCedula['size'] > 5000000) {
			echo "muy grande la cedula";
			$move = false;
		}
		if ($move == true) {
			move_uploaded_file($fotoCedula['tmp_name'], $locationCedulas);
			$locationCedulas4Db='/images/userfiles/paraguayosProfesionales/cedulas/cedula='.$user_id.'.'.$newstringCedula;
			$query= mysqli_query($conexion, "INSERT INTO imagenes (fotoCedula, user_id, estado) VALUES ('$locationCedulas4Db', '$user_id', 'pendiente')");
		

			header("Location:../inscripciones_paso2_ci.php");
		}
	} elseif($step == 3) {
		$user_id=$_POST['user_id'];
		$universidad = $_POST['universidad'];
		$existeImagen = mysqli_query($conexion, "DELETE FROM imagenes WHERE user_id='$user_id'");
		
		$fotoFactura=$_FILES['fotoFactura'];
		$newstringFactura = substr($fotoFactura['type'], -3);
		$locationFacturas='../images/userfiles/extranjerosEstudiantes/facturas/factura='.$user_id.'.'.$newstringFactura;
		$move = true;
		if ($fotoFactura['size'] > 5000000) {
			echo "my grande la factura";
			$move = false;
		}
		if ($move == true) {
			move_uploaded_file($fotoFactura['tmp_name'], $locationFacturas);
			$locationFacturas4Db='/images/userfiles/extranjerosEstudiantes/facturas/factura='.$user_id.'.'.$newstringFactura;

			mysqli_query($conexion, "UPDATE login SET universidad = '$universidad' WHERE id = '$user_id'");

			$query= mysqli_query($conexion, "INSERT INTO imagenes (fotoFactura, user_id, estado) VALUES ('$locationFacturas4Db', '$user_id', 'pendiente')");

			header("Location:../inscripciones_paso2_exg.php");
		}
	}
	// header("Location:")
?>
<!-- Acordate de condicionar los files, solo jpg gif png y pdf menores a 5 megas -->
