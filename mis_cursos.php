<?php include 'inc/header.php'; ?>

<?php
	require('inc/conexion.php');
	if (isset($_SESSION['user_id'])) {
		if (($_SESSION['time'] + 3600) > time()) {
			$_SESSION['time'] = time() + 3600;
			$session_id = $_SESSION['user_id'];
			$userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
			$userData = mysqli_fetch_assoc($userData);
			$userState = $userData['estado'];
			$nacionalidad = $userData['pais'];
			$estudiante = $userData['estudiante'];
			if ($userState != 'cursos') {
				header("Location:inc/intermediador.php");
				exit;
			}
		} else {
			unset($_SESSION['time']);
			unset($_SESSION['user_id']);
			header("Location:log_in.php");
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
	  $cursos[] = array_map('utf8_encode', $row); 
	}

	//print_r($cursos);die;

	$result = mysqli_query($conexion, "SELECT visita.contacto, visita.fecha, visita.direccion, visita.id, visita.lugar FROM visita JOIN visita_login ON visita.id = visita_login.visita_id 
		WHERE visita_login.login_id = ".$session_id." ORDER BY visita.fecha;");
	
	$visitas = array();

	while($row = mysqli_fetch_array($result)) { 
	  $visitas[] = array_map('utf8_encode', $row); 
	}

	//print_r($visitas);die;
?>
<!--Barra de Usuario Logueado-->
<div class="userbar">
	<div class="container">
		Bienvenido/a <strong><?php echo $_SESSION['user_name'];?></strong> 
		<a href="mis_cursos.php" class="button azul mini">Mis Cursos</a>
		<a href="inscripciones_paso4_actividades.php" class="button azul mini">Cursos Disponibles</a>
		<a href="inc/cerrarsesion.php" class="button azul mini">Salir</a>
	</div>
</div>
<!--Barra de Usuario Logueado-->


<section id="top_title">
	<div class="container">
		<h1>Mis Cursos</h1>
	</div>
</section>

<section id="main">
	<div class="container">
		<article>

			<div id="crumbs" class="crumb_pages">
				<ul>
					<li><a href="javascript:void();" class="active">Mis Cursos</a></li>
					<!--<li><a href="cursos_disponibles.php">Cursos Disponibles</a></li>-->
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
						<h3><?php echo $value['titulo'] ?></h3>
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

			

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>


		<article>

			<div id="crumbs" class="crumb_pages">
				<ul>
					<li><a href="javascript:void();" class="active">Visita</a></li>
					<!--<li><a href="cursos_disponibles.php">Cursos Disponibles</a></li>-->
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
						<h3><?php echo $value['lugar'] ?></h3>
						<p>Dictado por: <strong><?php echo $value['contacto'] ?></strong><br> Fecha y Hora: <strong><?php echo $date ?> - <?php echo $time ?></strong></p>
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

			

		</article>	
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