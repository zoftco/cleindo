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
<section id="top_title">
	<div class="container">
		<h1>Visitas técnicas</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p>CLEIN PARAGUAY 2015 contará con visitas técnicas a las industrias más importantes, que se localizan tanto en la ciudad Asunción y sus alrededores. Por otro lado la opción de conocer una de las dos hidroeléctrica con la que cuenta el País, recorrer sus instalaciones y enriquecerse con estas obras de ingeniería más renombradas de Paraguay. *más adelante se debe agregar listado con las compañías de visitas técnicas, incluyendo links o logos. Habían sugerido formulario de inscripción a las visitas técnicas</p>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
