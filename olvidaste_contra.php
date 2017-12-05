<!-- Paso 1 Formulario de Inscripción Principal -->
<?php include 'inc/header.php'; ?>

<section id="top_title">
	<div class="container">
		<h1>Cambia tu contraseña</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
		<?php
			if (isset($_POST['correo'])) {
				$correo = trim($_POST['correo']);
				require('inc/conexion.php');
				
				$valid_email = mysqli_query($conexion, "SELECT * FROM login WHERE correoElectronico = '$correo'");
				
				if (mysqli_num_rows($valid_email) == 0) {
					header("Location:".WEB_URL."/olvidaste_contra.php?solicitud=fallida");
				} else {
					require("inc/config.php");
					require 'admin/TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
					require('admin/TemplateMail/mandarmail.php');

					$valid_email = mysqli_fetch_assoc($valid_email);
					$email_forgot = $valid_email['correoElectronico'];
					$id_forgot = $valid_email['id'];

					$titulo = "CLEIN Ecuador";
					$sujeto = "Cambia tu contraseña";
					$mensaje = 'Para cambiar tu contraseña haz click <a style="font-size:20px;color:navy" href="'.WEB_URL.'/olvido_pass.php?id='.$id_forgot.'">aquí</a>. Si no pediste un cambio de contraseña, no hagas caso a este mensaje';

					$usuario_olvido = new MandarMail;
					$usuario_olvido->mandar($titulo, $mensaje, $email_forgot, $sujeto);

					header("Location:".WEB_URL."/olvidaste_contra.php?solicitud=enviada");
				}
			}
		?>
		<?php
			if (isset($_GET['solicitud']) && $_GET['solicitud'] == 'enviada') {
		?>
				<h2 class="title">Un correo ha sido enviado a su cuenta con instrucciones para cambiar su contraseña.</h2>
		<?php
			} elseif (isset($_GET['solicitud']) && $_GET['solicitud'] == 'fallida') {
		?>
				<h2 style="color:red" class="title">EL correo que usted ingreso no esta registrado en esta página.</h2>
		<?php
			} else {
		?>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">	
					<div class="form">
						<h4 class="title">Introduzca su correo electrónico y recibira un mail con instrucciones para cambiar su contraseña.</h4>
						<div class="form-row">
							<label for="name">Correo Electrónico</label>
							<input type="text" name="correo" >
						</div>
						<div class="form-row">
							<input type="submit" value="Enviar" class="button enviarform">
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
