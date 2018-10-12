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
			case 'getpilares':
				$table = 'pilar';
				$queryarray = array(
					'table' => 'pilar',
					'columns' => array(
						'id' => 'id',
						'pilar' => 'pilar',
						'fecha' => 'fecha',
						'salon' => 'salon',
						'cupo' => 'cupo',
						'tipo' => 'tipo',
						'(SELECT COUNT(pilar_login.id) FROM pilar_login 
						 WHERE pilar.id = pilar_login.pilar_id)' => 'inscriptos'
					),
					'order' => array(
						'fecha' => 'ASC'));

				$datos = $database->getTabledata($queryarray);
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

			case 'deletepilar':
				$id = $_POST['id'];
				$queryarray = array(
					'table' => 'pilar',
					'conditions' => array(
						'id' => $id));

				$delete = $database->deleteData($queryarray);

				if($delete) {
					$respuesta = array(
						'success' => true);

					echo json_encode($respuesta);
				}

				break;

			case 'newpilar':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);
				$id = $_POST['id'];

				$queryarray = array(
					'table' => 'pilar',
					'columns' => array(
						'pilar' => $fields['pilar'],
						'salon' => $fields['salon'],
						'fecha' => $fields['fecha'],
						'tipo' => $fields['tipo'],
						'cupo' => $fields['cupo'])
					);

				//print_r($queryarray);die;

				$update = $database->insertData($queryarray);

				if($update) {
					$respuesta = array(
						'success' => true);
					echo json_encode($respuesta);
				}

				break;	

			case 'editpilar':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);
				$id = $_POST['id'];

				$queryarray = array(
					'table' => 'pilar',
					'columns' => array(
						'pilar' => $fields['pilar'],
						'salon' => $fields['salon'],
						'fecha' => $fields['fecha'],
						'tipo' => $fields['tipo'],
						'cupo' => $fields['cupo']),
					'conditions' => array(
						'id' => $id));

				$update = $database->updateData($queryarray);

				if($update) {
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