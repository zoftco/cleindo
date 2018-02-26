<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->
<?php
if(isset($_SESSION['user_name'])) {
?>
<div class="userbar">
<div class="container">
Bienvenido/a <strong><?php echo $_SESSION['user_name'];?></strong> <!-- <a href="mis_cursos.php" class="button azul mini">Mis Cursos</a> --> <a href="inscripciones_paso4_actividades.php" class="button azul mini">Cursos Disponibles</a> <a href="inc/cerrarsesion.php" class="button azul mini">Salir</a>
</div>
</div>
<?php
}
?>

<!--Barra de Usuario Logueado-->
<section id="top_title">
	<div class="container">
		<h1>Error</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p>Ha ocurrido un error. Por favor intente de nuevo.</p>

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
