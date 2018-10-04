<?php
    require_once('inc/config.php');
	require('inc/conexion.php');
	if($_POST['operation'] == 'checkvisita'){
		if( !empty($_POST['visita_id']) && !empty($_POST['user_id']) ) {
			$visita_id = $_POST['visita_id'];
			$user_id = $_POST['user_id'];

			$result = mysqli_query($conexion, 
				"SELECT count(id) AS cant FROM visita WHERE id = ".$visita_id." AND DATE(fecha) not in 
					(SELECT DATE(visita.fecha) FROM visita JOIN visita_login ON visita.id = visita_login.visita_id 
					WHERE visita_login.login_id = ".$user_id.");");

			$checkVisita= mysqli_fetch_array($result);

			if($checkVisita['cant']){
				$result = mysqli_query($conexion, 
					"INSERT INTO visita_login(visita_id,login_id)
						SELECT ".$visita_id.",".$user_id." FROM visita WHERE visita.id = ".$visita_id." AND visita.cupo > 
							(SELECT COUNT(visita_login.id) FROM visita_login WHERE visita_login.visita_id = ".$visita_id.")");

				$respuesta = array();
				$result = mysqli_affected_rows($conexion);
				if($result){
					$respuesta = array(
						'success' => true,
						'message' => 'Success'
					);
				}else{
					$respuesta = array(
						'success' => false,
						'message' => 'Error: La visita a la que intenta inscribirse está llena.'
					);
				}

				echo json_encode($respuesta);
			}else{
				$respuesta = array(
					'success' => false,
					'message' => 'Error: Ya está inscrito en otra visita ese día'
				);
				echo json_encode($respuesta);
			}

		} else {
			$respuesta = array(
				'success' => false,
				'message' => 'Ha ocurrido un error, por favor vuelva a intentarlo.'
			);
			echo json_encode($respuesta);
		}
	}

	if($_POST['operation'] == 'uncheckvisita'){
		if( !empty($_POST['visita_id']) && !empty($_POST['user_id']) ) {
			$visita_id = $_POST['visita_id'];
			$user_id = $_POST['user_id'];

			/*print_r($visita_id."<br/>");
			print_r($user_id);die;*/

			$sql = "DELETE FROM visita_login WHERE visita_id = ".$visita_id." AND login_id = ".$user_id.";";

			//print_r($sql);die;

			$result = mysqli_query($conexion, $sql);

			$respuesta = array();
			$result = mysqli_affected_rows($conexion);
			if($result){
				$respuesta = array(
					'success' => true,
					'message' => 'Success'
				);
			}else{
				$respuesta = array(
					'success' => false,
					'message' => 'Ha ocurrido un error, por favor vuelva a intentarlo.'
				);
			}

			echo json_encode($respuesta);
		}else {
			$respuesta = array(
				'success' => false,
				'message' => 'Ha ocurrido un error, por favor vuelva a intentarlo.'
			);
			echo json_encode($respuesta);
		}
	}
	
?>