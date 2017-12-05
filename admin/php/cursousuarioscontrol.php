<?php
	require_once('sessioncontrol.php');
    require_once('../../inc/config.php');
	require_once('dbconnect.php');

	$session = new sessioncontrol();

	if(isset($_POST['operation'])) {
		$dbdata = array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASSWORD,
			'db' => DB_NAME);

		$database = new dbConnect();
		$database->connect($dbdata);

		switch ($_POST['operation']) {
			case 'getcursousuarios':
				$curso_id = $_POST['curso_id'];
				$table = 'curso';
				$querystring = 'SELECT pilar_login.id,login.nombreyapellidoInput,login.idNumber,login.pais,login.correoElectronico FROM login JOIN pilar_login ON login.id = pilar_login.login_id WHERE pilar_id = '.$curso_id.' ORDER BY nombreyapellidoInput;';

				$datos = $database->getTableDataQuery($querystring);

				if($datos) {
					$respuesta = array(
						'success' => true,
						'data' => $datos);
				} else {
					$respuesta = array(
						'success' => true,
						'data' => array());
				}
				
				echo json_encode($respuesta);
				break;

			case 'deletecursousuario':
				$id = $_POST['id'];
				$queryarray = array(
					'table' => 'pilar_login',
					'conditions' => array(
						'id' => $id));

				$delete = $database->deleteData($queryarray);

				if($delete) {
					$respuesta = array(
						'success' => true);

					echo json_encode($respuesta);
				}

				break;
		}

		
		
	} else {
		$respuesta = array(
			'success' => false,
			'message' => 'No se está recibiendo ningún parámetro');
		echo json_encode($respuesta);
	}
?>