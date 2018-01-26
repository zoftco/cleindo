<?php
    require ('config.php');
    require ('conexion.php');
    session_start();
	$imgPago=$_FILES['imgPago'];
	$numFactura=$_POST['numFactura'];
	$nomParticipante=$_POST['nomParticipante'];
    $user_id=$_SESSION['user_id'];
	$existeImagen = mysqli_query($conexion, "DELETE FROM pagoefectivo WHERE idUsers='$user_id'");

	$locationPago=guardarimagenes($_FILES['imgPago'],'pago',$user_id);
	$query= mysqli_query($conexion, "INSERT INTO pagoefectivo (imgFactura, numFactura, nomParticipante, idUsers, estado) VALUES ('$locationPago', '$numFactura', '$nomParticipante', '$user_id', 'pendiente')");

	header("Location:../inscripciones_paso3.php");




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
?>