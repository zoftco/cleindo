<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require ('apiheaders.php');
require ('../inc/config.php');
require ('../inc/conexion.php');

$data = json_decode(file_get_contents('php://input'), true);

$user=$data['user'];
$actividad=$data['actividad'];
$admin=$data['admin'];

$sql="INSERT INTO `asistencia` ( `id_login`, `id_actividad`, `id_administrador`) VALUES (".$user.", ".$actividad.", ".$admin.")";

$query = mysqli_query($conexion, $sql);

if (!$query) {
    $respuesta = [
        'success' => false,
        'data' => null,
        'message' => "Error"];
} else {
    $respuesta = [
            'success' => true,
            'data' => null,
            'message' => "Asistencia Registrada"];
}
echo json_encode($respuesta);

?>