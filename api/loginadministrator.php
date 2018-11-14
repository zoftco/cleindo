<?php
require ('apiheaders.php');
require ('../inc/config.php');
require ('../inc/conexion.php');

$data = json_decode(file_get_contents('php://input'), true);
$email=$data['email'];
$pass=hash("sha512", $data['pass']);


$query= mysqli_query($conexion, "SELECT * FROM administradores WHERE admin_email = '$email' AND admin_pass = '$pass'");

if (mysqli_num_rows($query) == 0) {
    $respuesta = array(
        'success' => false,
        'data' => null,
        'message' => "Credenciales Incorrectas");
} else {
    while($row = $query->fetch_assoc()) {
        $datos[] = $row;
    }

    $respuesta = array(
            'success' => true,
            'data' => $datos,
            'message' => "Credenciales Correctas");


}
echo json_encode($respuesta);

?>