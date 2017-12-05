<?php include 'inc/header.php'; ?>

<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require('inc/conexion.php');
	if (isset($_SESSION['user_id'])) {
		if (($_SESSION['time'] + 3600) > time()) {
			$_SESSION['time'] = time() + 3600;
			$vencimiento = $_SESSION['time'];
			$session_id = $_SESSION['user_id'];
			$userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
			$userData = mysqli_fetch_assoc($userData);
			$userState = $userData['estado'];
			$nacionalidad = $userData['pais'];
			$estudiante = $userData['estudiante'];
			if ($userState != 'pago') {
				header("Location:cursos_disponibles.php");
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

	$checkifUploaded = mysqli_query($conexion, "SELECT * FROM pagoefectivo WHERE idUsers='$session_id'");
	$imageExists = mysqli_num_rows($checkifUploaded);
	if ($imageExists == 0) {
		$contenido = "";
	} else {
		$imgData = mysqli_fetch_assoc($checkifUploaded);
		$imgState = $imgData['estado'];
		$mensaje = $imgData['mensaje'];
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
					<li><a href="javascript:void();" class="success">Validación de cuenta</a></li>
					<li><a href="javascript:void();" class="active">Verificación de pago</a></li>
					<li><a href="javascript:void();">Cursos</a></li>
				</ul>
			</div>
			<?php
				if (isset($_GET['transaccion'])) {
			?>
				<h4 class="title">La transacción no se pudo realizar, por favor intente de nuevo.</h4>
				<p><?php echo $_SESSION['descripcion']; ?></p>
			<?php
				}
			?>

				<?php
					if ($contenido == "pendiente") {
				?>
					<form action="inc/uploadimages.php" method="post" enctype="multipart/form-data">
						<div class="form">
							<h4 class="title">Tu comprobante se ha recibido correctamente y se encuentra en estado de verificación.</h4>
							Recibiras un mail confirmando la validación de tu pago.
						</div>
					</form>
				<?php
					} elseif ($contenido == "") {
				?>
				<div class="form">
					<h4 class="title">Verificación de Pago</h4>


					<div class="form-row">
						<p>Proximamente se habilitarán los medios de pago. Enviaremos un email cuando esten disponibles.</p>
					</div>


					<div class="form-row pagoTarjeta">
						<div class="obs_block">
							<p><strong>Pago por Tarjeta de crédito</strong><br>
							Haga click en <strong>Siguiente</strong> para pasar al pago seguro con tarjeta de crédito.</p>
							
						</div>
						<div class="obs_block">
							<p>El monto total a pagar es de: <strong><?php require('inc/calcularmonto.php'); require('inc/calcularguaranies.php'); echo $pagar;?> U$S</strong></p>
							<input name="user_id" type="hidden" value="<?php echo $session_id?>"></input>
						</div>
						<div class="form-row">
							<input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
						</div>
					</div>
	
					<div class="westernUnion">
						<div class="form-row">
							<div class="obs_block">
								<p><strong>Pago por Western Union</strong><br>
								Para realizar el pago por Western Union, debe realizar el envio a:</p>
								<ul>
<!--									<li><strong>A Nombre de:</strong> Arturo Arnaldo Toñanez Benitez</li>-->
<!--									<li><strong>CI N°:</strong> 4.143.492</li>		-->
								</ul>
								<p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
							</div>
							<div class="obs_block">
								<p>El monto total a pagar es de: <strong><?php echo $pagarefectivo;?> U$S</strong> más el recargo de envio.</p>
								<p><strong>Obs:</strong> El monto no incluye el recargo por envío.</p>
							</div>
						</div>
						
						<h5>Datos del pago</h5>

						<form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
							<div class="form-row">
								<label for="name">Código del Envío</label>
								<input type="file" name="imgFactura" id="" required>
							</div>

							<div class="form-row">
								<label for="name">Nro. de Factura</label>
								<input type="text" name="numFactura" id="" required>
							</div>

							<div class="form-row">
								<label for="name">Participante a acreditar pago</label>
								<input type="text" name="nomParticipante" id="" required>
								<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
							</div>
							<div class="form-row">
								<input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
							</div>
						</form>
						
						
					</div>
					<!-- pago en efectivo -->
					<div class="pagoefectivo">
						<div class="form-row">
							<div class="obs_block">
								<p><strong>Pago en Efectivo</strong><br>
<!--								Para realizar el pago en efectivo, debe acercarse a las oficinas de Aleiiaf:</p>-->
<!--								<ul>-->
<!--									<li><strong>Dirección:</strong> Tte. Mellones 1506 Barrio los Laureles</li>-->
<!--									<li><strong>Teléfono:</strong> +595981353560</li>		-->
<!--								</ul>-->
								<p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
							</div>
							<div class="obs_block">
								<p>El monto total a pagar es de: <strong><?php echo $pagarefectivo;?> U$S</strong></p>
							</div>
						</div>
						
						<h5>Datos del pago</h5>

					<form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
						<div class="form-row">
							<label for="name">Foto de Factura</label>
							<input type="file" name="imgFactura" id="" required>
						</div>

						<div class="form-row">
							<label for="name">Número de Factura</label>
							<input type="text" name="numFactura" id="" required>
						</div>

						<div class="form-row">
							<label for="name">Participante a acreditar pago</label>
							<input type="text" name="nomParticipante" id="" required>
							<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
						</div>
						<div class="form-row">
							<input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
						</div>
					</form>

					</div>
					<!-- pago en efectivo -->

					

				</div>
				<?php
					} elseif ($contenido == "rechazado") {
				?>
				<div class="form">
					<h4 class="title"><?php echo $mensaje;?></h4>


					<div class="form-row">
						<label for="name">Seleccione un método de pago</label>
						<select name="" id="metodopago">
							<option value="0">Seleccionar una opción</option>
							<?php
								if($_SERVER['REMOTE_ADDR'] == '186.2.229.224') {
							?>
							<option id="tcPago" value="TC">Pago vía Tarjeta de Crédito</option>
							<?php
								}
							?>
							<option value="EF">Pago en Efectivo</option>
							<option value="WU">Western Union</option>
						</select>
					</div>


					<div class="form-row pagoTarjeta">
						<div class="obs_block">
							<p><strong>Pago por Tarjeta de crédito</strong><br>
							Costos de manejo:
							Haga click en <strong>Siguiente</strong> para pasar al pago seguro con tarjeta de crédito.</p>
						</div>
						<div class="obs_block">
							<p>El monto total a pagar es de: <strong><?php require('inc/calcularmonto.php'); echo $pagar;?> U$S</strong></p>
						</div>
						<div class="form-row">
							<input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
						</div>
					</div>
					
					<div class="westernUnion">
						<div class="form-row">
							<div class="obs_block">
								<p><strong>Pago por Western Union</strong><br>
								Para realizar el pago por Wester Union, debe realizar el envio a:</p>
								<ul>
									<li><strong>A Nombre de:</strong> Arturo Arnaldo Toñanez Benitez</li>
									<li><strong>CI N°:</strong> 4.143.492</li>		
								</ul>
								<p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
							</div>
							<div class="obs_block">
								<p>El monto total a pagar es de: <strong><?php echo $pagarefectivo;?> U$S</strong> más el recargo de envio.</p>
							</div>
						</div>
						
						<h5>Datos del pago</h5>

						<form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
							<div class="form-row">
								<label for="name">Código del Envío</label>
								<input type="file" name="imgFactura" id="" required>
							</div>

							<div class="form-row">
								<label for="name">Nro. de Factura</label>
								<input type="text" name="numFactura" id="" required>
							</div>

							<div class="form-row">
								<label for="name">Participante a acreditar pago</label>
								<input type="text" name="nomParticipante" id="" required>
								<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
							</div>
							<div class="form-row">
								<input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
							</div>
						</form>
						
						
					</div>
					<!-- pago en efectivo -->
					<div class="pagoefectivo">
						<div class="form-row">
							<div class="obs_block">
								<p><strong>Pago en Efectivo</strong><br>
								Para realizar el pago en efectivo, debe acercarse a las oficinas de Aleiiaf Paraguay:</p>
								<ul>
									<li><strong>Dirección:</strong> Tte. Mellones 1506 Barrio los Laureles</li>
									<li><strong>Teléfono:</strong> +595981353560</li>		
								</ul>
								<p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
							</div>
							<div class="obs_block">
								<p>El monto total a pagar es de: <strong><?php echo $pagarefectivo;?> U$S</strong></p>
							</div>
						</div>
	
						
						<h5>Datos del pago</h5>

					<form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
						<div class="form-row">
							<label for="name">Foto de Factura</label>
							<input type="file" name="imgFactura" id="" required>
						</div>

						<div class="form-row">
							<label for="name">Número de Factura</label>
							<input type="text" name="numFactura" id="" required>
						</div>

						<div class="form-row">
							<label for="name">Participante a acreditar pago</label>
							<input type="text" name="nomParticipante" id="" required>
							<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
						</div>
						<div class="form-row">
							<input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
						</div>
					</form>

					</div>
					<!-- pago en efectivo -->

					

				</div>
			<?php
				}

			?>

			<!-- </form> -->
			<form action="pago/Pago.php" method="post">
				<input type="hidden" name="user_id" value="<?php echo $session_id;?>">
				<input type="hidden" name="vencimiento" value="<?php echo $vencimiento;?>">
				<input type="hidden" name="monto" value="<?php echo $montoFinal?>">
				<input id="botonSubmit" type="submit" value="submit" name="botonSubmit" style="position: absolute; left: -9999px; display: none">
			</form>

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
<!-- GENERAR INPUT ESCONDIDO PARA SABER QUE USUARIO ESTA LOGUEADO Y CUAL NO-->
