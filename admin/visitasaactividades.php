<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../inc/config.php');
require('../inc/conexion.php');

$visitas = mysqli_query($conexion, "SELECT * FROM actividades where id > 99999");

$query="";

foreach($visitas as $visita)
{
echo '{id:'.$visita["id"].',titulo:"'.$visita["titulo"].'"}';
}

echo $query;