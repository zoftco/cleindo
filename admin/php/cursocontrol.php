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
			case 'getcursos':
				$table = 'curso';
				$queryarray = array(
					'table' => 'curso',
					'columns' => array(
						'id' => 'id',
						'pilar_id' => 'pilar_id',
						'(select CONCAT(pilar.fecha," ", pilar.pilar) from pilar where curso.pilar_id = pilar.id)' => 'pilar_nombre',
						'codigo' => 'codigo',
						'fecha' => 'fecha',
						'titulo' => 'titulo',
						'conferencista' => 'conferencista',
						'nacionalidad' => 'nacionalidad',
						'enfoque' => 'enfoque'
					),
					'order' => array(
						'pilar_nombre' => 'ASC'));

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

			case 'deletecurso':
				$id = $_POST['id'];
				$queryarray = array(
					'table' => 'curso',
					'conditions' => array(
						'id' => $id));

				$delete = $database->deleteData($queryarray);

				if($delete) {
					$respuesta = array(
						'success' => true);

					echo json_encode($respuesta);
				}

				break;

			case 'newcurso':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);
				$id = $_POST['id'];

				$queryarray = array(
					'table' => 'curso',
					'columns' => array(
						'pilar_id' => $fields['pilar'],
						'codigo' => $fields['codigo'],
						'fecha' => $fields['fecha'],
						'titulo' => $fields['titulo'],
						'conferencista' => $fields['conferencista'],
						'nacionalidad' => $fields['nacionalidad'],
						'enfoque' => $fields['enfoque']
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
						'pilar_id' => $fields['pilar'],	
						'codigo' => $fields['codigo'],
						'fecha' => $fields['fecha'],
						'titulo' => $fields['titulo'],
						'conferencista' => $fields['conferencista'],
						'nacionalidad' => $fields['nacionalidad'],
						'enfoque' => $fields['enfoque']
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