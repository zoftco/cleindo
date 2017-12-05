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
		<h1>Crea tu Negocio</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p>El taller crea tu negocio consiste en la orientación previa de los participantes por parte de los disertantes en distintas áreas, ya sea económica, operacional, logística, administrativa, etc. Su duración será de tres días, en paralelo a las ponencias de las mañanas, con cupos limitados. Es muy importante decir que esta actividad no está lejos de los pilares que planteamos en nuestra propuesta académica, los recursos (financieros, humanos, materiales), liderazgo, sistemas de gestión, sin estos pilares es casi imposible crear un negocio de manera exitosa, es por eso que decidimos realizar esta actividad, aparte de ser innovadora para el CLEIN.
Cabe mencionar que esta actividad va a estar a cargo de la Cámara de Comercio Paraguaya Americana, líderes en actividades como esta en Paraguay.</p>
				
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
