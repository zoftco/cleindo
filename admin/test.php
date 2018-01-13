<?php
/**
 * Created by PhpStorm.
 * User: ferna
 * Date: 2018-01-12
 * Time: 22:26
 */

$fields['editadmin_nombre']="Fernando Chavez";
$fields['editadmin_pass']="hola";
$admin_id=1;

require_once('../inc/config.php');
require_once('php/dbconnect.php');

$dbdata = array(
    'host' => DB_HOST,
    'user' => DB_USER,
    'pass' => DB_PASSWORD,
    'db' => DB_NAME);

$database = new dbConnect();
$database->connect($dbdata);

$queryarray = array(
    'table' => 'administradores',
    'columns' => array(
        'admin_nombre' => $fields['editadmin_nombre'],
        'admin_pass' => hash('sha512', $fields['editadmin_pass'])),
    'conditions' => array(
        'admin_id' => $admin_id));

$update = $database->updateData($queryarray);

if($update) {
    $respuesta = array(
        'success' => true);
    echo json_encode($respuesta);
}