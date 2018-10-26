<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../inc/config.php');
require('../inc/conexion.php');
require_once('php/sessioncontrol.php');
$session = new sessioncontrol();
if(!$session->isValid('admin_id')) {
    $session->redirect('login.php');
    exit;
}else
{
    if(!isset($_GET['id']))
    {
        exit;
    }else
    {
        $id_actividad=htmlspecialchars($_GET['id']);
        $participantes = mysqli_query($conexion, "SELECT * FROM `actividades_login_bloque` INNER JOIN login WHERE login.id = actividades_login_bloque.id_login AND actividades_login_bloque.id_actividad = ".$id_actividad." ");
        $inscritos = mysqli_query($conexion, "SELECT id_actividad, COUNT(id) as inscritos FROM `actividades_login_bloque` GROUP BY id_actividad");

        $actividad = mysqli_query($conexion, "SELECT actividades.`id`,`titulo`,`conferencista`,actividades.`fechahora`,`nacionalidad`,`enfoque`,`salon`,`cupo` FROM actividades WHERE actividades.id =".$id_actividad." ");
        $actividad = mysqli_fetch_array($actividad);

        $inscritos = mysqli_query($conexion, "SELECT id_actividad, COUNT(id) as inscritos FROM `actividades_login_bloque` WHERE id_actividad =".$id_actividad." GROUP BY id_actividad");
        $inscritos = mysqli_fetch_array($inscritos);
    }





    $actividades = mysqli_query($conexion, "SELECT actividades.`id`,`titulo`,`conferencista`,actividades.`fechahora`,`nacionalidad`,`enfoque`,`salon`,`cupo`,`bloque_id`,`bloque` FROM actividades INNER JOIN bloque WHERE actividades.bloque_id = bloque.id ORDER BY actividades.fechahora");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Actividades</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
         <?php include('menu.php');?>  

  
 
        <div class="container pagemaincontent">
            <div class="row">      
            <div class="col-sm-12">
                <div>
                    <a type="button" class="btn btn-primary btn-lg btn-block" data-modal="#dialog" href="actividadeslistado.php">Actividades</a>
                </div>
                <div class="actividadpanel panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><span class="glyphicon glyphicon-tasks"></span> Actividad</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <th>Fecha Hora</th>
                            <th>Titulo</th>
                            <th>Conferencista</th>
                            <th>Nacionalidad</th>
                            <th>Salon</th>
                            <th>Cupo</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $actividad['fechahora']; ?></td>
                                <td><?php echo $actividad['titulo']; ?></td>
                                <td><?php echo $actividad['conferencista']; ?></td>
                                <td><?php echo $actividad['nacionalidad']; ?></td>
                                <td><?php echo $actividad['salon']; ?></td>
                                <td><?php echo $inscritos['inscritos'].'/'.$actividad['cupo']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="actividadpanel panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><span class="glyphicon glyphicon-user"></span> Participantes</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Apellido</th>
                                    <th>País</th>
                                    <th>Teléfono</th>
                                    <th>Correo Electrónico</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach ($participantes as $v):
                            ?>
                            <tr>
                                <td><?php echo $i; $i++; ?></td>
                                <td><?php echo $v['nombreyapellidoInput']; ?></td>
                                <td><?php echo $v['pais']; ?></td>
                                <td><?php echo $v['telefono']; ?></td>
                                <td><?php echo $v['correoElectronico']; ?></td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="popalertholder"></div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/globalController.js"></script>
    </body>
 </html>       