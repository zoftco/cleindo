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
}
if(!isset($_GET['idlogin']))
{
    exit;
}else
{
    $session_id= htmlspecialchars($_GET['idlogin']);
    $userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
    $userData = mysqli_fetch_assoc($userData);

    $result = mysqli_query($conexion, "SELECT * FROM visita");
    $visitas = $result;

    $result_visita = mysqli_query($conexion, "SELECT visita.id FROM visita JOIN visita_login ON visita.id = visita_login.visita_id WHERE login_id = ".$session_id);
    $visita_ids = array();
    while($row = mysqli_fetch_array($result_visita)) {
        $visita_ids[] = $row['id'];
    }

    $inscritos = mysqli_query($conexion, "SELECT id_actividad, COUNT(id) as inscritos FROM `actividades_login_bloque` GROUP BY id_actividad");

    $actividades = mysqli_query($conexion, "SELECT actividades.`id`,`titulo`,`conferencista`,actividades.`fechahora`,`nacionalidad`,`enfoque`,`salon`,`cupo`,`bloque_id`,`bloque` FROM actividades INNER JOIN bloque WHERE actividades.bloque_id = bloque.id ORDER BY actividades.fechahora");

    $mis_actividades = mysqli_query($conexion,"SELECT id_actividad FROM actividades_login_bloque WHERE id_login= ".$session_id);

    while ($row= mysqli_fetch_array($mis_actividades))
    {
        $mis_actividades_ids[]=$row['id_actividad'];
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrador Clein</title>

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
                <div class="row">
                    <div class="col-md-4"><?php echo $userData['nombreyapellidoInput']; ?></div>
                    <div class="col-md-2"><?php echo $userData['estudiante']; ?></div>
                    <div class="col-md-2"><?php echo $userData['pais']; ?></div>
                    <div class="col-md-4"><a href="actividades.php">Volver</a></div>
                </div>
                <div class="panel-body">
                    <div>
                        <h2 style="font-weight: bold;">Actividades Disponibles</h2>
                        <p>Debe seleccionar una actividad en cada bloque</p>
                        <?php
                        $table='<table id="cursos-disponibles" class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Conferencista</th>
                                <th>Nacionalidad</th>
                                <th>Salón</th>
                                <th>Enfoque</th>
                                <th style="width: 40px;"></th>
                            </tr>
                            </thead>
                            <tbody>';
                            ?>
                                <?php
                                $fecha="";
                                $color="";
                                $opentable = false;
                                foreach ($actividades as $v):
                                    $datetime = strtotime($v['fechahora']);
                                    $date = date("Y/m/d H:i", $datetime);
                                    $checked="";
                                    $disabled="";
                                    if( $fecha!= $v['fechahora']){
                                        $fecha = $v['fechahora'];
                                        $color = ($color =='#F0FBF8') ? '#FFFFFF' : '#F0FBF8';
                                        if($opentable)
                                        {
                                            echo "</tbody></table>";
                                        }
                                        echo '<hr /><h3>'.$v['bloque'].' '.$date.'</h3>';
                                        echo $table;
                                        $opentable = true;
                                    }
                                    if(isset($mis_actividades_ids)){
                                        $checked = in_array($v['id'], $mis_actividades_ids) ? 'checked' : '';
                                    }
                                    $v['inscritos']=0;
                                    foreach ($inscritos as $i)
                                    {
                                        if($v['id']==$i['id_actividad'])
                                        {
                                            $v['inscritos']=$i['inscritos'];
                                        }
                                    }
                                    if($v['cupo'] <= $v['inscritos'] && $checked == ''){
                                        $disabled = 'disabled';
                                    }
                                    ?>
                                <tr style="background-color:<?php echo $color;?>">

                                    <td><?php echo $v['titulo']; ?></td>
                                    <td><?php echo $v['conferencista']; ?></td>
                                    <td><?php echo $v['nacionalidad']; ?></td>
                                    <td><?php echo $v['salon'].' '.$v['inscritos'].'/'.$v['cupo']; ?></td>
                                    <td><?php echo $v['enfoque']; ?></td>
                                    <td>
                                        <input data-actividadid="<?php echo $v['id'] ?>"
                                               name="<?php echo $v['bloque']; ?>"
                                               data-bloqueid="<?php echo $v['bloque_id'] ?>"
                                               data-userid="<?php echo $session_id; ?>"
                                               class="checkCurso"
                                            <?php echo $checked; ?>
                                            <?php echo $disabled; ?>
                                               data-modal="#dialog"
                                               type="radio"
                                               onclick="checkCurso(this, <?php echo $session_id?>);"
                                        />
                                    </td>
                                </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h2 style="font-weight: bold;">VISITAS</h2>
                        <table id="visitas" class="table">
                            <thead>
                            <tr>
                                <th>Industria</th>
                                <th>Hora de visita</th>
                                <th>Cant de personas</th>
                                <th>Dirección</th>
                                <th>Contacto</th>
                                <th>Teléfono</th>
                                <th style="width: 40px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($visitas as $k => $v): ?>
                                <tr>
                                    <td><?php echo $v['lugar']; ?></td>
                                    <?php
                                    $datetime = strtotime($v['fecha']);
                                    $date = date("d/m/Y H:i", $datetime);
                                    ?>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $v['cupo']; ?></td>
                                    <td><?php echo $v['direccion']; ?></td>
                                    <td><?php echo $v['contacto']; ?></td>
                                    <td><?php echo $v['telefono']; ?></td>
                                    <td rowspan="<?php echo $cant_c; ?>" style="text-align: center; vertical-align: middle;">
                                        <img id="v_img_<?php echo $v['id'] ?>" style="display:none;" src="images/loading.gif"/>
                                        <?php
                                        $check_id = '';
                                        if(isset($visita_ids)){
                                            $check_id = in_array($v['id'], $visita_ids) ? 'checked' : '';
                                        }
                                        ?>
                                        <input data-visitaid="<?php echo $v['id'] ?>" data-modal="#dialog" type="checkbox" onclick="checkVisitas(this, <?php echo $session_id?>);" <?php echo $check_id; ?> />
                                        <?php //endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
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