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
			case 'getvisitausuarios':
				$visita_id = $_POST['visita_id'];
				$table = 'visita';
				$querystring = 'SELECT visita_login.id,login.nombreyapellidoInput,login.idNumber,login.pais,login.correoElectronico FROM login JOIN visita_login ON login.id = visita_login.login_id WHERE visita_id = '.$visita_id.' ORDER BY nombreyapellidoInput;';

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

			case 'deletevisitausuario':
				$id = $_POST['id'];
				$queryarray = array(
					'table' => 'visita_login',
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