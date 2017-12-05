<?php include 'inc/header.php'; ?>

<!--Barra de Usuario Logueado-->
<div class="userbar">
	<div class="container">
		Bienvenido/a <strong>Juan Perez</strong> <a href="mis_cursos.php" class="button azul mini">Mis Cursos</a> <a href="cursos_disponibles.php" class="button azul mini">Cursos Disponibles</a> <a href="#" class="button azul mini">Salir</a>
	</div>
</div>
<!--Barra de Usuario Logueado-->


<section id="top_title">
	<div class="container">
		<h1>Inscripciones</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			
			<div class="mensaje">
				<h4>Su inscripción ha sido enviada!</h4>
				<p>Gracias!, se ha enviado con éxito los datos de inscripción, verificaremos sus datos para confirmar su cuenta y acceder a los cursos disponibles.</p>
			</div>
			
			
			<div class="mensaje">
				<h4>Su cuenta está en estado de verificación</h4>
				<p>Su cuenta aún se encuentra en estado de verificación. Le notificaremos por correo electrónico cuando su cuenta sea habilitada.</p>
			</div>
			
			<a href="#" class="button azul">Volver</a>

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
