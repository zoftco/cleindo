<?php
	if (isset($_SESSION['user_id'])) {
		header("Location:inc/intermediador.php");
		exit;
	}
?>
<?php include 'inc/header.php'; ?>
<section id="main">
	<div class="container">
			<p>Ingrese sus datos para acceder, si aún no ha creado un perfil, puede hacerlo <a href="inscripcion.php">aquí</a></p>

			<form id="formIngresarLogin" method="post">
				
				<div class="form formlogin">
					<div class="form-row">
						<label for="emailLogin">Email</label>
						<input type="text" name="emailLogin" id="emailLogin">
					</div>
					
					<div class="form-row">
						<label for="passLogin">Contraseña</label>
						<input type="password" name="passLogin" id="passLogin">
						<a href="olvidaste_contra.php" class="txtSS">Olvidé mi contraseña</a>
					</div>
					

					<div class="form-row">
						<input id="botonIngresarLogin" type="button" value="Ingresar" class="button enviarform">
						<span hidden id="missingFields" style="color:red">Debes completar todos los campos para ingresar.</span>
					</div>

				</div>

			</form>
	</div>
</section>
<script type="text/javascript" src="js/loginControl.js"></script>
<?php include 'inc/footer.php'; ?>
