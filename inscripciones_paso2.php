<?php
	// session_start();
    require('inc/config.php');
	require('inc/conexion.php');
    session_start();
	if (isset($_SESSION['user_id'])) {
	    $session_id = $_SESSION['user_id'];
	    $user = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
		$userData = mysqli_fetch_assoc($user);
		$userState = $userData['estado'];
		if ($userState != 'verificacion') {
			$redirection = array('pago'=>'inscripciones_paso3.php' , 'cursos'=>'cursos_disponibles.php');
			header("Location:".$redirection[$userData['estado']]);
			exit;
		}
	} else {
		header("Location:log_in.php");
		exit;
	}

	$checkifUploaded = mysqli_query($conexion, "SELECT * FROM imagenes WHERE user_id='$session_id'");
	$imageExists = mysqli_num_rows($checkifUploaded);
	if ($imageExists == 0) {
		$contenido = "";
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
<?php
include 'inc/header.php';
?>

<section id="main">
	<div class="container">

			<div id="crumbs">
				<ul>
					<li><a href="javascript:void();" class="success">Registro</a></li>
					<li><a href="javascript:void();" class="active">Validación de cuenta</a></li>
					<li><a href="javascript:void();">Verificación de pago</a></li>
					<li><a href="javascript:void();">Actividades</a></li>
				</ul>
			</div>
			
			<!-- php -->
			<?php
				if($contenido == "rechazado") {
			?>
			<form action="inc/uploadimages.php" method="post" enctype="multipart/form-data">
				<div class="form">
					<h4 class="title"><?php echo $imgData['mensaje'];?></h4>

                    <div class="form-row">
                        <label for="idNumber">Nro. de Cédula o Pasaporte</label>
                        <input type="text" name="idNumber" id="idNumber">
                    </div>

                    <div class="form-row">
                        <label for="name">Fecha de Nacimiento</label>
                        <input type="date" name="" id="fechaNacimiento">
                        <span id="debesSerMayor" class="mayorEdad" style="color:red">Debes ser mayor de edad para poder inscribirte.</span>
                    </div>

                    <div class="form-row">
                        <label for="fotoDocumento">Foto Documento Identidad o Pasaporte</label>
                        <input type="file" name="fotoDocumento" id="fotoDocumento" required>
                    </div>

                    <div class="form-row">
                        <label for="universidad">Universidad de Procedencia</label>
                        <input type="text" name="universidad" id="universidad">
                    </div>

                    <div class="form-row">
                        <label for="carrera">Carrera Universitaria</label>
                        <input type="text" name="carrera" id="carrera" list="carreraList">
                        <datalist id="carreraList">
                            <option value="Ingeniería Industrial">
                            <option value="Ingeniería Civil y/o de Construcción">
                            <option value="Ingeniería de Sistemas o Informática">
                            <option value="Ingeniería de Eléctrica o Electrónica">
                            <option value="Ingeniería Mecánica">
                            <option value="Otras Ingenierías">
                            <option value="Administración de Empresas y Afines">
                            <option value="Contabilidad y Afines">
                            <option value="Mercadeo y Afines">
                            <option value="Arquitectura y Afines">
                            <option value="Artes Plásticas, Visuales y Afines">
                            <option value="Ciencias y Afines">
                            <option value="Comunicación Social">
                            <option value="Derecho y Afines">
                            <option value="Economía">
                            <option value="Educacion y Afines">
                            <option value="Medicina y Afines">
                            <option value="Diseño y Afines">
                            <option value="Otra">
                        </datalist>
                    </div>
                    <?php
                    if($userData['estudiante']=="Estudiante")
                    {
                    ?>
					<div class="form-row">
						<label for="fotoComprobante">Foto Comprobante de Estudiante</label>
						<input type="file" name="fotoComprobante" id="fotoComprobante" required>
					</div>

                    <?php
                    }
                    // end if $userData['estudiante']=="estudiante")
                    ?>
					
					<div class="form-row">
						<div class="obs_block"><strong>Observación:</strong> <br>Una vez recibidos los archivos, validaremos tu cuenta para proceder al pago de su inscripción. La imagen debe estar en los formatos .png, .pdf o .jpg.</div>
					</div>

					<div class="form-row">
						<input type="submit" value="Siguiente" class="button enviarform">
					</div>

				</div>
			</form>
			<?php
				} elseif ($contenido == "pendiente") {
			?>
				<form action="inc/uploadimages.php" method="post" enctype="multipart/form-data">
					<div class="form">
						<h4 class="title">Tus documentos se han recibido correctamente y se encuentran en estado de verificación.</h4>
						Recibiras un mail confirmando la validación de tus documentos.
					</div>
				</form>
			<?php
				} else {
			?>
				<form action="inc/uploadimages.php" method="post" enctype="multipart/form-data">
					<div class="form">
						<h4 class="title">Validación de cuenta</h4>

                        <div class="form-row">
                            <label for="idNumber">Nro. de Cédula o Pasaporte</label>
                            <input type="text" name="idNumber" id="idNumber">
                        </div>

                        <div class="form-row">
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                            <input type="date" name="fechaNacimiento" id="fechaNacimiento">
                            <span id="debesSerMayor" class="mayorEdad" style="color:red">Debes ser mayor de edad para poder inscribirte.</span>
                        </div>

                        <div class="form-row">
                            <label for="fotoDocumento">Foto Documento Identidad o Pasaporte</label>
                            <input type="file" name="fotoDocumento" id="fotoDocumento" required>
                        </div>

                        <div class="form-row">
                            <label for="universidad">Universidad de Procedencia</label>
                            <input type="text" name="universidad" id="universidad">
                        </div>

                        <div class="form-row">
                            <label for="carrera">Carrera Universitaria</label>
                            <input type="text" name="carrera" id="carrera" list="carreraList">
                            <datalist id="carreraList">
                                <option value="Ingeniería Industrial">
                                <option value="Ingeniería Civil y/o de Construcción">
                                <option value="Ingeniería de Sistemas o Informática">
                                <option value="Ingeniería de Eléctrica o Electrónica">
                                <option value="Ingeniería Mecánica">
                                <option value="Otras Ingenierías">
                                <option value="Administración de Empresas y Afines">
                                <option value="Contabilidad y Afines">
                                <option value="Mercadeo y Afines">
                                <option value="Arquitectura y Afines">
                                <option value="Artes Plásticas, Visuales y Afines">
                                <option value="Ciencias y Afines">
                                <option value="Comunicación Social">
                                <option value="Derecho y Afines">
                                <option value="Economía">
                                <option value="Educacion y Afines">
                                <option value="Medicina y Afines">
                                <option value="Diseño y Afines">
                                <option value="Otra">
                            </datalist>
                        </div>
                        <?php
                        if($userData['estudiante']=="Estudiante")
                        {
                            ?>
                            <div class="form-row">
                                <label for="fotoComprobante">Foto Comprobante de Estudiante</label>
                                <input type="file" name="fotoComprobante" id="fotoComprobante" required>
                            </div>

                            <?php
                        }
                        // end if $userData['estudiante']=="estudiante")
                        ?>
						
						<div class="form-row">
							<div class="obs_block"><strong>Observación:</strong> <br>Una vez recibidos los archivos, validaremos tu cuenta para proceder al pago de su inscripción. La imagen debe estar en los formatos .png, .pdf o .jpg.</div>
						</div>

						<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
						<input type="hidden" name="step" value="1">

						<div class="form-row">
							<input type="submit" value="Siguiente" class="button enviarform">
						</div>

					</div>
				</form>
			<?php
				}
			?>
			<!-- php -->
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
