
<?php 
if (isset($_POST['user_id'])) {
	if ($_POST['user_id'] > 0) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require('Procard.php');
	require ('../inc/conexion.php');

	$user_id = $_POST['user_id'];

	$session_id = $_POST['user_id'];

	$userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$user_id'");
	$userData = mysqli_fetch_assoc($userData);
	$userState = $userData['estado'];
	$nacionalidad = $userData['pais'];
	$estudiante = $userData['estudiante'];
	require('../inc/calcularmonto.php');
	require('../inc/calcularguaranies.php');

	

	//$montoFinal = "1000";
	if ($montoFinal == "0") {
		header('Location:'.WEB_URL.'/error.php');
		mysqli_query("INSERT INTO errores (nacionalidad, estudiante, id_error) VALUES ('$nacionalidad', '$estudiante', '$user_id')");
		exit;
	}
	$transaccion = $procard->newTransaction(strval($montoFinal), true);
	$uuid = $transaccion->uuid;

	
	mysqli_query($conexion, "INSERT INTO transacciones (uuid, id_pago, fecha) VALUES ('$uuid', '$user_id', NOW())");

   header("Location: " . procard::ECOM_ROOT_CTX . "/pagar.php?uuid=" . $transaccion->uuid);
}
}
?>
