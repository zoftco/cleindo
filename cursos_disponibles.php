<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(!isset($_SESSION))
{
    session_start();
}
require_once('inc/config.php');
require('inc/conexion.php');
if (isset($_SESSION['user_id'])) {
    $session_id = $_SESSION['user_id'];
    $userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
    $userData = mysqli_fetch_assoc($userData);
    $userState = $userData['estado'];
    $_SESSION['pais'] = $userData['pais'];
    $pais = $_SESSION['pais'];
    $_SESSION['etapa'] = "";
    $estudiante = $userData['estudiante'];
    if ($userState != 'cursos') {
        header("Location:inc/intermediador.php");
        exit;
    }
} else {
    header("Location:log_in.php");
    exit;
}

$result = mysqli_query($conexion, "select 
		pilar.id as p_id, 
	    pilar.pilar as p_pilar,
	    pilar.fecha as p_fecha,
	    pilar.cupo as p_cupo,
	    pilar.salon as p_salon,	
	    pilar.tipo as p_tipo,
	    curso.id as c_id,
	    curso.fecha as c_fecha,
	    curso.titulo as c_titulo,
	    curso.conferencista as c_conferencista,
	    curso.nacionalidad as c_nacionalidad,
	    curso.enfoque as c_enfoque
	from pilar join curso on pilar.id = curso.pilar_id 
	order by pilar.fecha, curso.fecha, pilar.pilar");

$cursos = array();

while($row = mysqli_fetch_array($result)) {
    $cursos[] = array_map('utf8_encode', $row);
}

$pilares = array();
$charla = array();
$id = 0;
$idx = 0;

foreach ($cursos as $k => $v) {
    if($id != $v['p_id']){
        $id = $v['p_id'];
        $pilares[$id]['p_id'] = $v['p_id'];
        $pilares[$id]['p_pilar'] = $v['p_pilar'];
        $pilares[$id]['p_fecha'] = $v['p_fecha'];
        $pilares[$id]['p_salon'] = $v['p_salon'];
        $pilares[$id]['p_cupo'] = $v['p_cupo'];
        $pilares[$id]['p_tipo'] = $v['p_tipo'];
    }
}

foreach ($cursos as $k => $v) {
    $id = $v['p_id'];
    $charla['c_id'] = $v['c_id'];
    $charla['c_fecha'] = $v['c_fecha'];
    $charla['c_titulo'] = $v['c_titulo'];
    $charla['c_conferencista'] = $v['c_conferencista'];
    $charla['c_nacionalidad'] = $v['c_nacionalidad'];
    $charla['c_enfoque'] = $v['c_enfoque'];
    $charla['p_id'] = $id;
    $pilares[$id]['charlas'][] = $charla;
}

$result = mysqli_query($conexion, "SELECT * FROM visita");

$visitas = array();

while($row = mysqli_fetch_array($result)) {
    $visitas[] = array_map('utf8_encode', $row);
}

//print_r($visitas);die;

//print_r($pilares);die;

$result = mysqli_query($conexion, "SELECT pilar.id, pilar.fecha FROM pilar JOIN pilar_login ON pilar.id = pilar_login.pilar_id WHERE login_id = ".$_SESSION['user_id']);

$mis_cursos = array();

//print_r($result);die;

while($row = mysqli_fetch_array($result)) {
    $mis_cursos_ids[] = $row['id'];
    $mis_cursos_fechas[] = $row['fecha'];
}



$result = mysqli_query($conexion, "SELECT visita.id FROM visita JOIN visita_login ON visita.id = visita_login.visita_id WHERE login_id = ".$_SESSION['user_id']);

$visita_ids = array();

//print_r($result);die;

while($row = mysqli_fetch_array($result)) {
    $visita_ids[] = $row['id'];
}
?>
<?php include 'inc/header.php'; ?>

<section id="main">
    <div class="container">
        <div id="crumbs">
            <ul>
                <li><a href="javascript:void();" class="success">Registro</a></li>
                <li><a href="javascript:void();" class="success">Validación de cuenta</a></li>
                <li><a href="javascript:void();" class="success">Verificación de pago</a></li>
                <li><a href="mis_cursos.php" class="active">Mis Actividades</a></li>
                <li><a href="inscripciones_concurso.php">Concurso de Ponencias E&P</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-4"><?php echo $userData['nombreyapellidoInput']; ?></div>
            <div class="col-md-2"><?php echo $estudiante; ?></div>
            <div class="col-md-2"><?php echo $userData['pais']; ?></div>
            <div class="col-md-4"><a href="inc/cerrarsesion.php" class="button azul mini">Cerrar Sesión</a></div>
        </div>
    </div>
</section>

<section id="main">
    <div class="container">
        <h2 style="font-weight: bold;">Actividades Disponibles</h2>
            <table id="cursos-disponibles">
                <thead class="txtC">
                <tr>
                    <th>Pilar</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Título</th>
                    <th>Conferencista</th>
                    <th>Nacionalidad</th>
                    <th>Salón</th>
                    <th>Enfoque</th>
                    <!--<th>Cupo</th>-->
                    <!--<th>Inscriptos</th>-->
                    <th style="width: 40px;"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $color = '#FFFFFF';
                $fecha = '';
                foreach ($pilares as $k => $p):
                    if($fecha != $p['p_fecha']){
                        $fecha = $p['p_fecha'];
                        $color = ($color =='#F0FBF8') ? '#FFFFFF' : '#F0FBF8';
                    }
                    ?>

                    <?php foreach ($p['charlas'] as $i => $c): ?>
                    <tr style="background-color:<?php echo $color; ?>">
                        <td><?php echo $p['p_pilar']; ?></td>
                        <?php
                        $datetime = strtotime($p['p_fecha']);
                        $date = date("d/m/Y", $datetime);
                        $datetime = strtotime($c['c_fecha']);
                        $time = date("H:i", $datetime);
                        ?>
                        <td class="txtR"><?php echo $date; ?></td>
                        <td class="txtR"><?php echo $time; ?></td>
                        <td><?php echo $c['c_titulo']; ?></td>
                        <td><?php echo $c['c_conferencista']; ?></td>
                        <td><?php echo $c['c_nacionalidad']; ?></td>
                        <td><?php echo $p['p_salon']; ?></td>
                        <td><?php echo $c['c_enfoque']; ?></td>
                        <?php
                        $cant_c = count($p['charlas']);
                        ?>

                        <?php if ($i == 0 ): ?>
                            <!--<td class="txtR" rowspan="<?php echo $cant_c; ?>"><?php echo $p['p_cupo']; ?></td>-->
                            <!--<td class="txtR" id="ins_<?php echo $curso['id'] ?>"><?php echo $curso['inscriptos']; ?></td>-->
                            <?php
                            $check_id = '';
                            if(isset($mis_cursos_ids)){
                                $check_id = in_array($p['p_id'], $mis_cursos_ids) ? 'checked' : '';
                            }
                            /*$check_fechas = '';
                            if(isset($mis_cursos_fechas)){
                                $check_fechas = in_array($curso['fecha'], $mis_cursos_fechas) ? 'is_date' : '';
                            }*/
                            ?>
                            <!--<?php
                            $disabled = '';
                            if($curso['cupo'] <= $curso['inscriptos'] && $check_id == ''){
                                $disabled = 'disabled';
                            }
                            if($check_id == '' && $check_fechas == 'is_date'){
                                $disabled = 'disabled';
                            }
                            ?>-->
                            <td rowspan="<?php echo $cant_c; ?>" style="text-align: center; vertical-align: middle;">
                                <img id="img_<?php echo $c['c_id'] ?>" style="display:none;" src="images/loading.gif"/>

                                <?php
                                $checked = '';
                                $disabled = '';
                                if($p['p_tipo']){
                                    $checked = 'checked';
                                    $disabled = 'disabled';
                                }else{
                                    $checked = $check_id;
                                }
                                ?>
                                <input data-pilarid="<?php echo $p['p_id'] ?>"  data-id="<?php echo $c['c_id']; ?>"; class="checkCurso" data-tipo="<?php echo $p['p_tipo']; ?>" <?php echo $checked; ?>
                                    <?php echo $disabled; ?> data-modal="#dialog" type="checkbox" name="r_<?php echo $fecha."_".$p['p_tipo'];  ?>"
                                       onclick="checkCurso(this, <?php echo $_SESSION['user_id']?>);" />
                                <?php //endif ?>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
                <?php endforeach ?>
                </tbody>
            </table>
            <div class="clearfix"></div>
            </br>
            </br>
            <h2 style="font-weight: bold;">VISITAS</h2>
                <table id="visitas">
                    <thead class="txtC">
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
                                <input data-visitaid="<?php echo $v['id'] ?>" data-modal="#dialog" type="checkbox" onclick="checkVisitas(this, <?php echo $_SESSION['user_id']?>);" <?php echo $check_id; ?> />
                                <?php //endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
    </div>
</section>

<div id="boxes">
    <div id="dialog" class="window">
        <a href="#"><button type="button" class="close" aria-label="Close">×</button></a>
        <span class="boxspan">Ha ocurrido un error. Por favor vuelta a intentarlo.</span>
    </div>

    <!-- Mask to cover the whole screen -->
    <div id="mask"></div>
</div>

<?php include 'inc/footer.php'; ?>
<script type="text/javascript" src="js/cursosDisponibles.js"></script>