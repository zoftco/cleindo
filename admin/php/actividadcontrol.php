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
			case 'getusuarios':
				$table = 'login';
				$queryarray = array(
					'table' => 'login, (SELECT @rowno:=0) r',
					'columns' => array(
						'id' => 'id',
						'@rowno:=@rowno+1' => 'numero',
						'nombreyapellidoInput' => 'nombre',
						'correoElectronico' => 'correo',
						'telefono' => 'telefono'
					),
					'conditions' => array(
						'estado' => 'cursos'
					),
					'order' => array(
						'nombre' => 'ASC'));

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
		}
		
	} else {
		$respuesta = array(
			'success' => false,
			'message' => 'No se est� recibiendo ning�n par�metro');
		echo json_encode($respuesta);
	}
?>