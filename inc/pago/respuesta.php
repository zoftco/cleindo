<?php
	require('Procard.php');
	$result = $procard->checkResult();
	$resultado = $result->CodRespAut;
	$uuid = $_GET['uuid'];
	echo gettype($uuid);
	// TRANSACCION ACEPTADA 
	if ($resultado == '00') {
		require ('../inc/conexion.php');
		$query= mysqli_query($conexion, "SELECT * FROM transacciones WHERE uuid = '$uuid'");
		$datosTrans = mysqli_fetch_assoc($query);
		$user_id = $datosTrans['id_pago'];
		$query= mysqli_query($conexion, "UPDATE login SET estado='cursos' WHERE id = '$user_id'");
		header("Location:../cursos_disponibles.php");
	} else {
		header("Location:../inscripciones_paso3.php");
	}
	// header("Location:http://localhost/CleinFinal/log_in.php");
?>