<?php include 'inc/header.php'; ?>
<?php
	if (isset($_SESSION['user_id'])) {
		header("Location:inc/intermediador.php");
		exit;
	}
?>
<section id="top_title">
	<div class="container">
		<h1>Ingresar</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p>Ingrese sus datos para acceder, si aún no ha creado un perfil, puede hacerlo <a href="inscripcion.php">aquí</a></p>

			<form action="">
				
				<div class="form formlogin">
					<div class="form-row">
						<label for="name">Email</label>
						<input type="text" name="emailLogin" id="emailLogin">
					</div>
					
					<div class="form-row">
						<label for="name">Contraseña</label>
						<input type="password" name="passLogin" id="passLogin">
						<a href="olvidaste_contra.php" class="txtSS">Olvidé mi contraseña</a>
					</div>
					

					<div class="form-row">
						<input id="botonIngresarLogin" type="button" value="Ingresar" class="button enviarform">
						<span hidden id="missingFields" style="color:red">Debes completar todos los campos para ingresar.</span>
					</div>

				</div>

			</form>

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
