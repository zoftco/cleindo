<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require ('apiheaders.php');
require ('../inc/config.php');
require ('../inc/conexion.php');

$sql="SELECT * from actividades WHERE 1";

$query = mysqli_query($conexion, $sql);

if (!$query) {
    $respuesta = [
        'success' => false,
        'data' => null,
        'message' => 'Error',
        ];
} else {
    $respuesta = [
            'success' => true,
            'data' => $query,
            'message' => 'Aceptado',
            ];
}
echo json_encode($respuesta);