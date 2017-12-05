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
			case 'getvisitas':
				$table = 'visita';
				$queryarray = array(
					'table' => 'visita',
					'columns' => array(
						'id' => 'id',
						'lugar' => 'lugar',
						'fecha' => 'fecha',
						'cupo' => 'cupo',
						'direccion' => 'direccion',
						'contacto' => 'contacto',
						'telefono' => 'telefono',
						'(SELECT COUNT(visita_login.id) FROM visita_login 
						 WHERE visita.id = visita_login.visita_id)' => 'inscriptos'
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

			case 'deletevisita':
				$id = $_POST['id'];
				$queryarray = array(
					'table' => 'visita',
					'conditions' => array(
						'id' => $id));

				$delete = $database->deleteData($queryarray);

				if($delete) {
					$respuesta = array(
						'success' => true);

					echo json_encode($respuesta);
				}

				break;

			case 'newvisita':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);
				$id = $_POST['id'];

				$queryarray = array(
					'table' => 'visita',
					'columns' => array(
						'lugar' => $fields['lugar'],
						'fecha' => $fields['fecha'],
						'cupo' => $fields['cupo'],
						'direccion' => $fields['direccion'],
						'contacto' => $fields['contacto'],
						'telefono' => $fields['telefono']
						
						)
					);

				$update = $database->insertData($queryarray);

				if($update) {
					$respuesta = array(
						'success' => true);
					echo json_encode($respuesta);
				}

				break;	

			case 'editvisita':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);
				$id = $_POST['id'];

				$queryarray = array(
					'table' => 'visita',
					'columns' => array(
						'lugar' => $fields['lugar'],
						'fecha' => $fields['fecha'],
						'cupo' => $fields['cupo'],
						'direccion' => $fields['direccion'],
						'contacto' => $fields['contacto'],
						'telefono' => $fields['telefono']
						),
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
			'message' => 'No se est� recibiendo ning�n par�metro');
		echo json_encode($respuesta);
	}
?>