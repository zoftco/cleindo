<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require ('../inc/config.php');
require ('../inc/conexion.php');
require ('php/nuevoestado.php');
require 'TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
require('TemplateMail/mandarmail.php');

$url = WEB_URL;
$query = mysqli_query($conexion, "SET @row_number=0");
$query = mysqli_query($conexion, "SELECT *,(@row_number:=@row_number + 1) AS num FROM login WHERE estado LIKE 'verificacion' ORDER BY pais");
$verificacion = array();
while($row = mysqli_fetch_assoc($query)) {
    $verificacion[] = $row;
}
$query = mysqli_query($conexion, "SET @row_number=0");
$query = mysqli_query($conexion, "SELECT *,(@row_number:=@row_number + 1) As num FROM `login` left outer join pagoefectivo ON (login.id = pagoefectivo.idUsers) where pagoefectivo.idUsers is null AND login.estado = 'pago'  ORDER BY pais");
$pago = array();
while($row = mysqli_fetch_assoc($query)) {
    $pago[] = $row;
}

$nuevoUsuario = new MandarMail;

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Administrador Clein</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body style="background-color:#e2e2e2">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

<?php
$style="background-color: #d51c29;display: block;color: white;text-decoration: none;text-align: center;font-size: 25px;vertical-align: middle;padding: 20px;border-radius: 20px;";
echo '<table class="table table-striped"><thead><tr><th>Email</th><th>Nombre</th><th>Resultado</th></tr></thead><tbody>';
//$i=1;
//foreach ($verificacion as $key=>$value) {
////    if ($i > 0){$i--;}else{break;}
//    $universidad = $verificacion[$key]['universidad'];
//    $nombre = $verificacion[$key]['nombreyapellidoInput'];
//    $email = $verificacion[$key]['correoElectronico'];
////    $email="fernandochavezgomesdasilva@gmail.com";
//    $pais = $verificacion[$key]['pais'];
//    $estudiante = $verificacion[$key]['estudiante'];
//    $universidad = $verificacion[$key]['universidad'];
//    $fechaNacimiento = $verificacion[$key]['fechaNacimiento'];
//    $carrera = $verificacion[$key]['carrera'];
//    $instagram = $verificacion[$key]['instagram'];
//    $facebook = $verificacion[$key]['facebook'];
//    $state = $verificacion[$key]['estado'];
//    $id = $verificacion[$key]['id'];
//    $num = $verificacion[$key]['num'];
//    $telefono = $verificacion[$key]['telefono'];
//
//    $titulo="Completa tu inscripción al CLEIN República Dominicana 2018";
//    $subject=$titulo;
//
//    $style="background-color: #d51c29;display: block;color: white;text-decoration: none;text-align: center;font-size: 25px;vertical-align: middle;padding: 20px;border-radius: 20px;";
//    $mensaje="<p>".$nombre."</p><p>Aun estás a tiempo. Puedes completar tu inscripción al CLEIN República Dominicana 2018</p> <a href='https://www.clein.org/log_in.php?email=".$email."' style='".$style."'>Ingresa aquí</a>";
//    echo '<tr>';
//    echo '<td>'.$email.'</td><td>'.$nombre.'</td>';
//    echo '<td>'.$nuevoUsuario->mandar2($titulo, $mensaje, $email, $subject, $nombre).'</td>';
////    echo '<td>'.'testing'.'</td>';
//    echo '</tr>';
//}
echo '</tbody></table>';

echo '<table class="table table-striped"><thead><tr><th>Email</th><th>Nombre</th><th>Resultado</th></tr></thead><tbody>';
//$i=1;
foreach ($pago as $key=>$value) {
//    if ($i > 0){$i--;}else{break;}
    $universidad = $pago[$key]['universidad'];
    $nombre = $pago[$key]['nombreyapellidoInput'];
    $email = $pago[$key]['correoElectronico'];
//    $email="fernandochavezgomesdasilva@gmail.com";
    $pais = $pago[$key]['pais'];
    $estudiante = $pago[$key]['estudiante'];
    $universidad = $pago[$key]['universidad'];
    $fechaNacimiento = $pago[$key]['fechaNacimiento'];
    $carrera = $pago[$key]['carrera'];
    $instagram = $pago[$key]['instagram'];
    $facebook = $pago[$key]['facebook'];
    $state = $pago[$key]['estado'];
    $id = $pago[$key]['id'];
    $num = $pago[$key]['num'];
    $telefono = $pago[$key]['telefono'];

    $titulo="Completa el pago de tu inscripción al CLEIN República Dominicana 2018";
    $subject=$titulo;
    $mensaje="<p>".$nombre."</p><p>Aun estás a tiempo. Puedes completar el pago de tu inscripción al CLEIN República Dominicana 2018</p> <a href='https://www.clein.org/log_in.php?email=".$email."' style='".$style."'>Ingresa aquí</a>";

    echo '<tr>';
    echo '<td>'.$email.'</td><td>'.$nombre.'</td>';
    echo '<td>'.$nuevoUsuario->mandar2($titulo, $mensaje, $email, $subject, $nombre).'</td>';
//    echo '<td>'.'testing'.'</td>';
    echo '</tr>';
}
echo '</tbody></table>';
?>

        </div>
    </div>
</div>
</body>
</html>
