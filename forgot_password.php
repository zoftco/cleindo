<?php include 'inc/header.php'; ?>

<section id="top_title">
	<div class="container">
		<h1>Recuperar contraseña</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p>Para recuperar su contraseña, ingrese su correo electrónico.</p>

			<form action="forgotpass.php" method="post">
				
				<div class="form formlogin">
					<div class="form-row">
						<label for="name">Email</label>
						<input type="text" name="email" id="">
					</div>
					

					<div class="form-row">
						<input type="submit" value="Enviar" class="button enviarform">
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
