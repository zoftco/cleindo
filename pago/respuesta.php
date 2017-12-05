<?php
	require('Procard.php');
	$result = $procard->checkResult();
	$resultado = $result->CodRespAut;
	$uuid = $_GET['uuid'];
	// TRANSACCION ACEPTADA 
	if ($resultado == '00') {
		echo 'hola';
		require ('../inc/conexion.php');
		$query= mysqli_query($conexion, "SELECT * FROM transacciones WHERE uuid = '$uuid'");
		$datosTrans = mysqli_fetch_assoc($query);
		$user_id = $datosTrans['id_pago'];
		$query= mysqli_query($conexion, "UPDATE login SET estado='cursos' WHERE id = '$user_id'");
		// header("Location:http://cleinecuador.com/cursos_disponibles.php");
	} else {
		// header("Location:http://cleinecuador.com/inscripciones_paso3.php");
	}
	// header("Location:http://localhost/CleinFinal/log_in.php");
?>
