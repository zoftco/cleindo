<?php
    require_once('inc/config.php');
	require('inc/conexion.php');
	if($_POST['operation'] == 'checkcurso'){
		if( !empty($_POST['actividad_id']) && !empty($_POST['user_id']) ) {
            $actividad_id = htmlspecialchars($_POST['actividad_id']);
			$user_id =  htmlspecialchars($_POST['user_id']);
            $bloque_id =  htmlspecialchars($_POST['bloque_id']);

            $sql = "DELETE FROM actividades_login_bloque WHERE id_bloque = ".$bloque_id." AND id_login = ".$user_id.";";
            $result = mysqli_query($conexion, $sql);

			if(true){
			    $query="INSERT INTO actividades_login_bloque(id_actividad,id_bloque,id_login)
SELECT ".$actividad_id.",".$bloque_id.",".$user_id." FROM actividades WHERE actividades.id = ".$actividad_id." AND actividades.cupo >
                (SELECT COUNT(actividades_login_bloque.id) FROM actividades_login_bloque WHERE actividades_login_bloque.id_bloque = ".$bloque_id.")";
                $result = mysqli_query($conexion,$query);

				$result = mysqli_affected_rows($conexion);

                $respuesta = array();
				if($result){
					$respuesta = array(
						'success' => true,
						'message' => 'Success',
					);
				}else{
					$respuesta = array(
						'success' => false,
						'message' => 'Error: El curso en que intenta inscribirse está lleno.',
					);
				}

				echo json_encode($respuesta);
			}
			else {
				$respuesta = array(
					'success' => false,
					'message' => 'Error: Ya está inscrito en otro curso ese día',
				);
				echo json_encode($respuesta);
			}
		} else {
			$respuesta = array(
				'success' => false,
				'message' => 'Ha ocurrido un error, por favor vuelva a intentarlo.',
			);
			echo json_encode($respuesta);
		}
	}	

	if($_POST['operation'] == 'uncheckcurso'){	
		if( !empty($_POST['$actividad_id']) && !empty($_POST['user_id']) ) {

            $actividad_id = $_POST['actividad_id'];
			$user_id = $_POST['user_id'];

			/*print_r($curso_id."<br/>");
			print_r($user_id);die;*/

			$sql = "DELETE FROM actividades_login_bloque WHERE id_actividad = ".$actividad_id." AND id_login = ".$user_id.";";

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