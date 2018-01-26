<?php
	session_start();
	
	$email=$_POST['email'];
	$pass=hash("sha512", $_POST['pass']);
    require ('config.php');
	require ('conexion.php');

	$query= mysqli_query($conexion, "SELECT * FROM login WHERE correoElectronico = '$email' AND contrasena = '$pass'");
	
	$datos = array();
	while($row = $query->fetch_assoc()) {
		$datos[] = $row;
	}
	foreach($datos as $key=>$value) {
		$user_id = $datos[$key]['id'];
		$user_name = $datos[$key]['nombreyapellidoInput'];
	}
	
	if (mysqli_num_rows($query) == 0) {
		echo 'Credenciales incorrectas.';
	} else {
		$_SESSION['user_id'] = $user_id;
		$_SESSION['user_name'] = $user_name;
		$_SESSION['time'] = time();
		echo $user_id;
	} 
?>