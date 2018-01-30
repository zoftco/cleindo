<!-- Paso 2 Extranjero Estudiante - Subir Factura -->
<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->
<?php
	if(isset($_SESSION['user_id'])) {
?>
	<div class="userbar">
		<div class="container">
			Bienvenido/a <strong><?php echo $_SESSION['user_name'];?></strong> <!-- <a href="mis_cursos.php" class="button azul mini">Mis Cursos</a> --> <a href="cursos_disponibles.php" class="button azul mini">Cursos Disponibles</a> <a href="inc/cerrarsesion.php" class="button azul mini">Salir</a>
		</div>
	</div>
<?php
	}
?>

<!--Barra de Usuario Logueado-->

<?php
	require('inc/conexion.php');
	if (isset($_SESSION['user_id'])) {
		if (($_SESSION['time'] + 3600) > time()) {
			$_SESSION['time'] = time() + 3600;
			$session_id = $_SESSION['user_id'];
			$userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
			$userData = mysqli_fetch_assoc($userData);
			$userState = $userData['estado'];
			if ($userState != 'verificacion') {
				$redirection = array('pago'=>'inscripciones_paso3.php' , 'cursos'=>'cursos_disponibles.php');
				header("Location:".$redirection[$userData['estado']]);
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

	$checkifUploaded = mysqli_query($conexion, "SELECT * FROM imagenes WHERE user_id='$session_id'");
	$imageExists = mysqli_num_rows($checkifUploaded);
	if ($imageExists == 0) {
		$contenido = "normal";
	} else {
		$imgData = mysqli_fetch_assoc($checkifUploaded);
		$imgState = $imgData['estado'];
		if ($imgState == 'pendiente') {
			$contenido = 'pendiente';
		} elseif ($imgState == 'rechazado') {
			$contenido = 'rechazado';
		}
	}
?>
<section id="top_title">
	<div class="container">
		<h1>Inscripciones</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>

			<div id="crumbs">
				<ul>
					<li><a href="javascript:void();" class="success">Registro</a></li>
					<li><a href="javascript:void();" class="active">Validación de cuenta</a></li>
					<li><a href="javascript:void();">Verificación de pago</a></li>
					<li><a href="javascript:void();">Cursos</a></li>
				</ul>
			</div>
			<?php
				if ($contenido == 'pendiente') {
			?>
				<form action="inc/uploadimages.php" method="post" enctype="multipart/form-data">
					<div class="form">
						<h4 class="title">Tus documentos se han recibido correctamente y se encuentran en estado de verificación.</h4>
						Recibiras un mail confirmando la validación de tus documentos.


					</div>

				</form>
			<?php
				} elseif ($contenido == 'rechazado') {
			?>
				<form action="inc/uploadimages.php" method="post" enctype="multipart/form-data">
					<div class="form">
						<h4 class="title"><?php echo $imgData['mensaje'];?></h4>
						
						<div class="form-row">
							<label for="name">Foto de Factura de Cuota o Matrícula de estudios. Obs: La imagen debe estar en los formatos .png, .pdf o .jpg.</label>
							<input type="file" name="fotoFactura" id="fotoFactura" required>
						</div>

						<div class="form-row">
						<label for="name">Nombre de la Universidad</label>
						<input type="text" name="universidad" id="universidad" required>
					</div>
						
						<div class="form-row">
							<div class="obs_block"><strong>Observación:</strong> <br>Una vez recibidos los archivos, validaremos su cuenta para proceder al pago de su inscripción.</div>
						</div>

						<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
						<input type="hidden" name="step" value="3">

						<div class="form-row">
							<input type="submit" value="Siguiente" class="button enviarform">
						</div>

					</div>

				</form>
			<?php
				} else {
			?>
				<form action="inc/uploadimages.php" method="post" enctype="multipart/form-data">
					<div class="form">
						<h4 class="title">Validación de cuenta</h4>
						
						<div class="form-row">
							<label for="name">Foto de Factura de Cuota o Matrícula de estudios. Obs: La imagen debe estar en los formatos .png, .pdf o .jpg.</label>
							<input type="file" name="fotoFactura" id="fotoFactura" required>
						</div>

						<div class="form-row">
						<label for="name">Nombre de la Universidad</label>
						<input type="text" name="universidad" id="universidad" required>
					</div>
						
						<div class="form-row">
							<div class="obs_block"><strong>Observación:</strong> <br>Una vez recibidos los archivos, validaremos su cuenta para proceder al pago de su inscripción.</div>
						</div>

						<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
						<input type="hidden" name="step" value="3">

						<div class="form-row">
							<input type="submit" value="Siguiente" class="button enviarform">
						</div>

					</div>

				</form>
			<?php
				}
			?>


		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
