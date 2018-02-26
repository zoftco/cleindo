<?php
//	error_reporting(E_ALL);
//	ini_set('display_errors', 1);
	set_time_limit(600);
    session_start();
	require('config.php');
    require('conexion.php');
try{
    $user_id=$_SESSION['user_id'];
    $idNumber = htmlspecialchars($_POST['idNumber']);
    $universidad = utf8_decode($_POST['universidad']);
    $fechaNacimiento = htmlspecialchars($_POST['fechaNacimiento']);
    $carrera = utf8_decode($_POST['carrera']);
    $existeImagen = mysqli_query($conexion, "DELETE FROM imagenes WHERE user_id='$user_id'");
    $locationDocumento=guardarimagenes($_FILES['fotoDocumento'],'documento',$user_id);
    if(isset($_FILES['fotoComprobante'])){
        $locationComprobante=guardarimagenes($_FILES['fotoComprobante'],'comprobante',$user_id);
    }else
    {
        $locationComprobante="";
    }
    mysqli_query($conexion, "INSERT INTO imagenes (fotoCedula, fotoFactura, user_id, estado) VALUES ('$locationDocumento', '$locationComprobante', '$user_id', 'pendiente')");
    mysqli_query($conexion, "UPDATE login SET universidad = '$universidad', idNumber = '$idNumber', fechaNacimiento = '$fechaNacimiento', carrera = '$carrera' WHERE id = '$user_id'");
    $respuesta=array('user_id'=>$user_id);
    echo json_encode($respuesta);
    }catch(Exception $exception)
    {
        $respuesta=array('error'=>"Hubo un error al guardar");
        echo json_encode($respuesta);
    }


		function guardarimagenes($file,$tipo,$user_id)
		{
            if (isset($file) && $file['size'] < 5000000) {
                $uniqid=uniqid("_img_");
                $ext=substr($file['name'],-4);
                if(move_uploaded_file($file['tmp_name'], '..' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $tipo . DIRECTORY_SEPARATOR . $user_id.$uniqid.$ext))
                {
                $locationfordb = "/upload/" . $tipo . "/" . $user_id.$uniqid.$ext;
                return $locationfordb;
                }
                else {
                    return "Error";
                }
            }
            else
			{
				return null;
			}
		}