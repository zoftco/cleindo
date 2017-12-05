<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->
<?php
	if(isset($_SESSION['user_name'])) {
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
		<h1>Actividad Social</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p>Se encuentre enfocada a una actividad de servicio en conjunto con el Club de Leones Asunción Metropolitano del distrito M 1 Paraguay. Por este medio del apoyo de un gran volumen de jóvenes emprendedores vamos a poder ayudar a nuestros hermanos más necesitados. A través de este voluntariado se demostrara el compromiso del joven en ayudar al más necesitado.  Pronto más informaciones al respecto.</p>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
