<?php
    require_once('../../inc/config.php');
	require_once('dbconnect.php');
	require_once('sessioncontrol.php');
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
			case 'adminlogin':
				$fields = json_decode($_POST['fields'],true);
				$password = $fields['userpass'];
				$password = hash('sha512',$password);
				$username = $fields['username'];

				$conditions = array(
					'admin_email' => $username,
					'admin_pass' => $password);
				$userexists = $database->checkifExists('administradores',$conditions);

				if(!$userexists) {
					$respuesta = array(
						'success' => false,
						'message' => 'Las credenciales que ingresaste son inválidas.');
					die(json_encode($respuesta));
				}

				$respuesta = array(
					'success' => true,
					'redirectUrl' => HOME_PAGE);

				echo json_encode($respuesta);

				$session->start(array('admin_id' => $userexists['admin_id'], 'time' => time()));
				$session->set('admin_name',$userexists['admin_nombre']);
                $session->set('admin_rol',$userexists['admin_rol']);

				$database->disconnect();
				break;
		}

		return;
	} elseif(isset($_GET['operation'])) {
		switch ($_GET['operation']) {
			case 'logout':
				$session->end();
				$session->redirect('../login.php');
				break;
		}
	} else {
		$respuesta = array(
			'success' => false,
			'message' => 'No se está recibiendo ningún parámetro');
		echo json_encode($respuesta);
	}
?>