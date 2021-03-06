<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require ('config.php');
    require ('conexion.php');
    session_start();
    $mensaje="";
	$documento=$_FILES['documento'];
    $autor1=mysqli_real_escape_string($conexion, $_POST['autor1']);
	$autor2=mysqli_real_escape_string($conexion, $_POST['autor2']);
    $asesor=mysqli_real_escape_string($conexion, $_POST['asesor']);
    $universidadasesor=mysqli_real_escape_string($conexion, $_POST['universidadasesor']);
    $tipoDocumento=mysqli_real_escape_string($conexion, $_POST['tipoDocumento']);
    $user_id=$_SESSION['user_id'];
    $userDocumento = mysqli_query($conexion, "SELECT * FROM concurso WHERE idlogin = '$user_id' AND tipoDocumento='$tipoDocumento' AND estadoDocumento LIKE 'aprobado'");
    if($_FILES['documento']['size'] != 0 && array_sum($_FILES['documento']['error']) == 0)
    {
        if (mysqli_num_rows($userDocumento) != 0) {
            $mensaje .= "Ya tiene un archivo aprobado. No necesita reemplazarlo";
        } else {
            $reemplazarDocumento = mysqli_query($conexion, "DELETE FROM concurso WHERE idlogin='$user_id' AND tipoDocumento='$tipoDocumento' AND estadoDocumento NOT LIKE 'aprobado'");
            $rutaDocumento = guardardocumento($documento, $tipoDocumento, $user_id);
            $mensaje.=mysqli_num_rows($reemplazarDocumento);
            $query = mysqli_query($conexion, "INSERT INTO concurso (rutaDocumento, tipoDocumento, autor1, autor2, asesor, universidadasesor, idlogin, estadoDocumento) VALUES ('$rutaDocumento', '$tipoDocumento','$autor1', '$autor2','$asesor', '$universidadasesor', '$user_id', 'pendiente')");
            if (mysqli_num_rows($reemplazarDocumento) != 0) {
                $mensaje .= "Se reemplazó el archivo con éxito";
            } else {
                $mensaje .= "El archivo se subió con éxito";
            }
        }
    }
    else
    {
        $mensaje .= "Error en la subida de archivo".print_r($_FILES['documento']['error']);
    }

    if($_FILES['titulo']['size'] != 0 && array_sum($_FILES['titulo']['error']) == 0)
    {
        $titulo=$_FILES['titulo'];
        $tipoDocumento="titulo";
        $userDocumento = mysqli_query($conexion, "SELECT * FROM concurso WHERE idlogin = '$user_id' AND tipoDocumento='$tipoDocumento' AND estadoDocumento LIKE 'aprobado'");
        if(mysqli_num_rows($userDocumento)!=0)
        {
            $mensaje.="Ya tiene un archivo aprobado. No necesita reemplazarlo";
        }
        else {
            $reemplazarDocumento = mysqli_query($conexion, "DELETE FROM concurso WHERE idlogin='$user_id' AND tipoDocumento='$tipoDocumento' AND estadoDocumento NOT LIKE 'aprobado'");
            $rutaDocumento=guardardocumento($titulo,$tipoDocumento,$user_id);
            $mensaje.=mysqli_num_rows($reemplazarDocumento);
            $query= mysqli_query($conexion, "INSERT INTO concurso (rutaDocumento, tipoDocumento, autor1, autor2, asesor, universidadasesor, idlogin, estadoDocumento) VALUES ('$rutaDocumento', '$tipoDocumento','$autor1', '$autor2','$asesor', '$universidadasesor', '$user_id', 'pendiente')");
            if(mysqli_num_rows($reemplazarDocumento)!=0)
            {
                $mensaje.="Se reemplazó el archivo con éxito";
            }
            else
            {
                $mensaje.="El archivo se subió con éxito";
            }
        }
    }






    header("Location:../inscripciones_concurso.php?mensaje=".$mensaje);




function guardardocumento($file,$tipo,$user_id)
{
    if (isset($file) && $file['size'] < 4200000) {
        $uniqid=uniqid("_doc_");
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
        return "Archivo Mayor a 4MB";
    }
}
?>