<?php
    require_once('inc/config.php');
	require('inc/conexion.php');
	if($_POST['operation'] == 'checkcurso'){
		if( !empty($_POST['pilar_id']) && !empty($_POST['user_id']) ) {
			$pilar_id = $_POST['pilar_id'];
			$user_id = $_POST['user_id'];

			$result = mysqli_query($conexion, 
				"SELECT count(id) AS cant FROM pilar WHERE id = ".$pilar_id." AND fecha not in 
					(SELECT pilar.fecha FROM pilar JOIN pilar_login ON pilar.id = pilar_login.pilar_id WHERE login_id = ".$user_id.");");

			$checkDate = mysqli_fetch_array($result);
			if($checkDate['cant']){
				$result = mysqli_query($conexion, 
					"INSERT INTO pilar_login(pilar_id,login_id)
						SELECT ".$pilar_id.",".$user_id." FROM pilar WHERE pilar.tipo = 0 AND pilar.id = ".$pilar_id." AND pilar.cupo > 
							(SELECT COUNT(pilar_login.id) FROM pilar_login WHERE pilar_login.pilar_id = ".$pilar_id.")");

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
						'message' => 'Error: El curso en que intenta inscribirse está lleno.'
					);
				}

				echo json_encode($respuesta);
			}
			else {
				$respuesta = array(
					'success' => false,
					'message' => 'Error: Ya está inscrito en otro curso ese día'
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

	if($_POST['operation'] == 'uncheckcurso'){	
		if( !empty($_POST['pilar_id']) && !empty($_POST['user_id']) ) {

			$pilar_id = $_POST['pilar_id'];
			$user_id = $_POST['user_id'];

			/*print_r($curso_id."<br/>");
			print_r($user_id);die;*/

			$sql = "DELETE FROM pilar_login WHERE pilar_id = ".$pilar_id." AND login_id = ".$user_id.";";

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
		}
		else {
			$respuesta = array(
				'success' => false,
				'message' => 'Ha ocurrido un error, por favor vuelva a intentarlo.'
			);
			echo json_encode($respuesta);
		}
	}
?>