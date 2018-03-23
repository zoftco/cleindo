<?php
//	error_reporting(E_ALL);
//	ini_set('display_errors', 1);
	set_time_limit(600);
    session_start();
	require('config.php');
    require('conexion.php');
try{
    $user_id=$_SESSION['user_id'];
    $idNumber = mysqli_real_escape_string($conexion,$_POST['idNumber']);
    $universidad = mysqli_real_escape_string($conexion,$_POST['universidad']);
    $fechaNacimiento = mysqli_real_escape_string($conexion,$_POST['fechaNacimiento']);
    $carrera = mysqli_real_escape_string($conexion,$_POST['carrera']);
    $existeImagen = mysqli_query($conexion, "DELETE FROM imagenes WHERE user_id='$user_id'");
    if($_FILES['fotoDocumento']['size'] != 0 && $_FILES['fotoDocumento']['error'] == 0){
        $locationDocumento=guardarimagenes($_FILES['fotoDocumento'],'documento',$user_id);
    }else
    {
        $locationComprobante="";
    }
    if($_FILES['fotoDocumento2']['size'] != 0 && $_FILES['fotoDocumento2']['error'] == 0){
        $locationDocumento2=guardarimagenes($_FILES['fotoDocumento2'],'documento',$user_id);
    }else
    {
        $locationDocumento2="";
    }
    if($_FILES['fotoComprobante']['size'] != 0 && $_FILES['fotoComprobante']['error'] == 0){
        $locationComprobante=guardarimagenes($_FILES['fotoComprobante'],'comprobante',$user_id);
    }else
    {
        $locationComprobante="";
    }
    mysqli_query($conexion, "INSERT INTO imagenes (fotoCedula, fotoDocumento2, fotoFactura, user_id, estado) VALUES ('$locationDocumento','$locationDocumento2', '$locationComprobante', '$user_id', 'pendiente')");
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