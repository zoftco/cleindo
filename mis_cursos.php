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

	$result = mysqli_query($conexion, "SELECT pilar.id as pilar_id, curso.titulo, 
				curso.conferencista, pilar.fecha, curso.fecha as hora FROM curso  
				JOIN pilar ON curso.pilar_id = pilar.id 
				JOIN pilar_login ON pilar_login.pilar_id = pilar.id
				WHERE login_id = ".$session_id." ORDER BY pilar.fecha, curso.fecha;");
	
	$cursos = array();

	while($row = mysqli_fetch_array($result)) { 
	  $cursos[] = $row;
	}

	//print_r($cursos);die;

	$result = mysqli_query($conexion, "SELECT visita.contacto, visita.fecha, visita.direccion, visita.id, visita.lugar FROM visita JOIN visita_login ON visita.id = visita_login.visita_id 
		WHERE visita_login.login_id = ".$session_id." ORDER BY visita.fecha;");
	
	$visitas = array();

	while($row = mysqli_fetch_array($result)) { 
	  $visitas[] = $row;
	}

	//print_r($visitas);die;
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
                <li><a href="cursos_disponibles.php" class="active">Actividades Disponibles</a></li>
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
			<div id="crumbs" class="crumb_pages">
				<ul>
					<li><a href="javascript:void();" class="active">Actividades</a></li>
<!--					<li><a href="cursos_disponibles.php">Actividades Disponibles</a></li>-->
				</ul>
			</div>

			<div class="listado_cursos">
				<!--Item Curso-->
				<?php foreach ($cursos as $key => $value): ?>
				<div class="item_curso" id="p_div-<?php echo $value['pilar_id']; ?>">
					<div class="info">
						<?php 
							$datetime = strtotime($value['fecha']);
							$date = date("d/m/Y", $datetime);
							$datetime = strtotime($value['hora']);
							$time = date("H:i", $datetime);
						?>	
						<h2><?php echo $value['titulo'] ?></h2>
						<p>Dictado por: <strong><?php echo $value['conferencista'] ?></strong><br> Fecha y Hora: <strong><?php echo $date ?> - <?php echo $time ?></strong></p>
					</div>
					<div class="opciones">
						<a href="#" data-id="<?php echo $value['pilar_id']; ?>" onclick="deleteCurso(this);"  class="button azul mini">Eliminar</a>
					</div>
				</div>
				<?php endforeach ?>
				<!--Item Curso-->
				<div class="clearfix"></div>
			</div>

			<div id="crumbs" class="crumb_pages">
				<ul>
					<li><a href="javascript:void();" class="active">Visita Técnica</a></li>
<!--					<li><a href="cursos_disponibles.php">Disponibles</a></li>-->
				</ul>
			</div>

			<div class="listado_cursos">
				<!--Item Curso-->
				<?php foreach ($visitas as $key => $value): ?>
				<div class="item_curso" id="v_div-<?php echo $value['id']; ?>">
					<div class="info">
						<?php 
							$datetime = strtotime($value['fecha']);
							$date = date("d/m/Y", $datetime);
							$time = date("H:i", $datetime);
						?>	
						<h2><?php echo $value['lugar'] ?></h2>
						<p>Fecha y Hora: <strong><?php echo $date ?> - <?php echo $time ?></strong></p>
						<p>Dirección: <strong><?php echo $value['direccion'] ?></strong></p>
					</div>
					<div class="opciones">
						<a href="#" data-id="<?php echo $value['id']; ?>" onclick="deleteVisita(this);"  class="button azul mini">Eliminar</a>
					</div>
				</div>
				<?php endforeach ?>
				<!--Item Curso-->
				<div class="clearfix"></div>
			</div>

	</div>
</section>

<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
    function deleteCurso(e) {
    	var id = $(e).attr('data-id');   
		$.ajax({
			url: 'cursos_disponibles_controller.php',
			type: 'post',
			data: { operation: 'uncheckcurso', pilar_id: id, user_id: <?php echo $_SESSION['user_id']?>},
			success: function(response){
				var obj = jQuery.parseJSON(response);
				if(obj.success == false) {
				}
				if(obj.success == true) {
					$('#p_div-'+id).remove();
				}
			},
			error: function(response){}
		});
    };

    function deleteVisita(e) {
    	var id = $(e).attr('data-id');   
		$.ajax({
			url: 'visitas_controller.php',
			type: 'post',
			data: { operation: 'uncheckvisita', visita_id: id, user_id: <?php echo $_SESSION['user_id']?>},
			success: function(response){
				var obj = jQuery.parseJSON(response);
				if(obj.success == false) {
				}
				if(obj.success == true) {
					$('#v_div-'+id).remove();
				}
			},
			error: function(response){}
		});
    };
</script>