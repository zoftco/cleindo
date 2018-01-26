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
			case 'getadmins':
				$table = 'administradores';
				$queryarray = array(
					'table' => 'administradores',
					'columns' => array(
						'admin_nombre' => 'admin_nombre',
						'admin_id' => 'admin_id',
						'admin_email' => 'admin_email',
                        'admin_rol' => 'admin_rol'),
					'order' => array(
						'admin_nombre' => 'ASC'));

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
			
			case 'newadmin':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);

				$fields['newadmin_name']= strtolower($fields['newadmin_name']);
				$fields['newadmin_email']= strtolower($fields['newadmin_email']);
                $fields['newadmin_rol']= strtolower($fields['newadmin_rol']);
				$fields['newadmin_name']= ucwords($fields['newadmin_name']);
				// $fields = array_map('utf8_decode',$fields);

				$conditions = array(
					'admin_email' => $fields['newadmin_email']);
				$userexists = $database->checkifExists('administradores',$conditions);

				if($userexists) {
					$respuesta = array(
						'success' => false,
						'message' => 'Ya existe un usuario con la misma dirección de e-mail.',
						'errcode' => 'userexits');
					die(json_encode($respuesta));
				}

				$queryarray = array(
					'table' => 'administradores',
					'columns' => array(
						'admin_nombre' => $fields['newadmin_name'],
						'admin_email' => $fields['newadmin_email'],
                        'admin_rol' => $fields['newadmin_rol'],
						'admin_pass' => hash('sha512',$fields['newadmin_pass'])));

				$datos = $database->insertData($queryarray);

				$respuesta = array(
					'success' => true,
					'data' => $datos);

				echo json_encode($respuesta);
				break;

			case 'deleteadmin':
				$admin_id = $_POST['admin_id'];
				$queryarray = array(
					'table' => 'administradores',
					'conditions' => array(
						'admin_id' => $admin_id));

				$delete = $database->deleteData($queryarray);

				if($delete) {
					$respuesta = array(
						'success' => true);

					echo json_encode($respuesta);
				}

				break;

			case 'editadmin':
				$fields = json_decode($_POST['fields'],true);
				$fields = array_map('utf8_decode',$fields);
				$admin_id = $_POST['admin_id'];

				$queryarray = array(
					'table' => 'administradores',
					'columns' => array(
						'admin_nombre' => $fields['editadmin_nombre'],
                        'admin_rol' => $fields['editadmin_rol'],
						'admin_pass' => hash('sha512', $fields['editadmin_pass'])),
					'conditions' => array(
						'admin_id' => $admin_id));

				$update = $database->updateData($queryarray);

				if($update) {
					$respuesta = array(
						'success' => true);
					echo json_encode($respuesta);
				}

				$_SESSION['admin_name'] = $fields['editadmin_nombre'];

				break;
		}

		
		
	} else {
		$respuesta = array(
			'success' => false,
			'message' => 'No se está recibiendo ningún parámetro');
		echo json_encode($respuesta);
	}
?>