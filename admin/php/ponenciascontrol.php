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
			case 'getactividad':
				$table = 'actividades';
				$queryarray = array(
					'table' => 'actividades',
					'columns' => array(
						'id' => 'id',
						'bloque_id' => 'bloque_id',
						'fechahora' => 'fechahora',
						'titulo' => 'titulo',
                        'cupo' => 'cupo',
						'conferencista' => 'conferencista',
						'nacionalidad' => 'nacionalidad',
						'enfoque' => 'enfoque'
					),
					'order' => array(
						'fechahora' => 'ASC'));

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

			case 'deleteactividad':
				$id = $_POST['id'];
				$queryarray = array(
					'table' => 'actividades',
					'conditions' => array(
						'id' => $id));

				$delete = $database->deleteData($queryarray);

				if($delete) {
					$respuesta = array(
						'success' => true);

					echo json_encode($respuesta);
				}

				break;

			case 'newactividad':
				$fields = json_decode($_POST['fields'],true);
				$id = $_POST['id'];

				$queryarray = array(
					'table' => 'curso',
					'columns' => array(
						'bloque_id' => $fields['bloque'],
						'fechahora' => $fields['fechahora'],
						'titulo' => $fields['titulo'],
						'conferencista' => $fields['conferencista'],
						'nacionalidad' => $fields['nacionalidad'],
						'enfoque' => $fields['enfoque'],
                        'salon' => $fields['salon'],
                        'cupo' => $fields['cupo']
					));

				$update = $database->insertData($queryarray);

				if($update) {
					$respuesta = array(
						'success' => true);
					echo json_encode($respuesta);
				}

				break;	

			case 'editcurso':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);
				$id = $_POST['id'];

				$queryarray = array(
					'table' => 'curso',
					'columns' => array(
                        'bloque_id' => $fields['bloque'],
                        'fechahora' => $fields['fechahora'],
                        'titulo' => $fields['titulo'],
                        'conferencista' => $fields['conferencista'],
                        'nacionalidad' => $fields['nacionalidad'],
                        'enfoque' => $fields['enfoque'],
                        'salon' => $fields['salon'],
                        'cupo' => $fields['cupo']
					),
					'conditions' => array(
						'id' => $id)
				);

				//print_r($queryarray);die;

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