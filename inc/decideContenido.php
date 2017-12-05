<?php
	if (isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		$host="localhost";
		$user="root";
		$clave="";
		$db="zadmin_clein";

		$conexion= mysqli_connect($host, $user, $clave, $db) or die ("Error");
		$query= mysqli_query($conexion, "SELECT * FROM sesion WHERE token = '$token'");
		$datos= array();

		// $count= mysqli_num_rows($query);
		// $fecha= $datos['vencimiento'];
		// $fecha= strtotime($fecha);
		// $ahora= time();
		
		// if($count == 0){
		// 	echo "no hay token";
		// 	header("Location:log_in.php");
		// 	exit;
		// }elseif ($fecha < $ahora) {
		// 	echo "token vencido";
		// 	header("Location:log_in.php");
		// 	exit;
		// } 



		while ($row = $query->fetch_assoc()) {
			$datos[] = $row;
		}




		foreach($datos as $key=>$value) {
			$user_id = $datos[$key]['user_id'];
		}
		$query1 = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$user_id'");
		$datos1 = array();
		while ($row1 = $query1->fetch_assoc()) {
			$datos1[] = $row1;
		}
		foreach ($datos1 as $key=>$value) {
			$estado = $datos1[$key]['estado'];
			$mensaje = $datos1[$key]['mensaje'];
		}
		if ($estado == "rechazado") {
			$contenido="rechazado";
		} elseif ($estado == "pendiente") {
			$contenido="pendiente";
		} else {
			$contenido = "";
		}
	} else {
		header("Location:log_in.php?nohaytoken");
	}
?>
<!-- 
	preguntarle a david como subir al servidor 
 -->