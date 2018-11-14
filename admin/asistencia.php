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
    if(isset($_GET['idactividad']))
    {
        $where = "AND `asistencia`.`id_actividad` = ".htmlspecialchars($_GET['idactividad']);

        $asistencia = mysqli_query($conexion, "SELECT * FROM `asistencia` INNER JOIN actividades INNER JOIN login WHERE `asistencia`.id_login = login.id AND `asistencia`.`id_actividad` = actividades.id ".$where." ORDER BY actividades.fechahora, actividades.id,  asistencia.created");
    }
    else{
        $where = "";
    }
    $inscritos = mysqli_query($conexion, "SELECT id_actividad, COUNT(id) as inscritos FROM `actividades_login_bloque` GROUP BY id_actividad");

    $actividades = mysqli_query($conexion, "SELECT * FROM `actividades` WHERE 1 ORDER BY actividades.fechahora DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrador Clein - Asistencia</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include('menu.php');?>



<div class="container pagemaincontent">
    <div class="row">
        <div class="col-sm-12">
            <div class="actividadpanel panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><span class="glyphicon glyphicon-user"></span> Actividades  </h4>
                </div>
                <div class="panel-body">
                    <div>
                        <h2 style="font-weight: bold;">Asistencia de Actividades</h2>
                        <table id="cursos-disponibles" class="table table-striped">
                            <thead>
                            <tr>
                                <th>FechaHora</th>
                                <th>Título</th>
                                <th>Listado</th>
                            </tr>
                            </thead>
                            <tbody>
                        <?php
                        foreach ($actividades as $v):
                            ?>
                            <tr>
                                <td><?php echo $v['fechahora']; ?></td>
                                <td><?php echo $v['titulo']; ?></td>
                                <td>
                                <a type="button" class="btn btn-primary btn-lg btn-block" data-modal="#dialog" href="asistenciaporactividad.php?idactividad=<?php echo $v['id']?>">Asistencia</a>
                                </td>
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
    </div>
    <div class="popalertholder"></div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/globalController.js"></script>
    <script src="js/cursosDisponibles.js"></script>
</body>
</html>