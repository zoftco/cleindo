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
		<h1>ALEIIAF</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p class="txtC"><img src="images/aleiiaf.png" class="noshadow" alt=""></p>
			<h4 class="title">¿Quiénes somos?</h4>
			<p>Somos la <strong>Asociación Latinoamericana de Estudiantes de Ingeniería Industrial y Afines</strong>, que agrupa a jóvenes estudiantes de la rama de Ingeniería Industrial y Afines, tal como su nombre lo indica.</p>
			
			<p><strong>ALEIIAF</strong> es gestora de la <strong>integración</strong> de la Ingeniería Industrial, por medio de la promoción y coordinación de proyectos y eventos relacionados <strong>a nivel estudiantil y profesional</strong>, con el objetivo de <strong>actualizar y complementar los conocimientos</strong> involucrados con las nuevas tendencias del mercado latinoamericano y mundial.</p>
			
			<h4 class="title">Historia</h4>

			<p>ALEIIAF fue fundada en 1991 con sede en Lima-Perú, gracias al impulso de estudiantes de la mayoría de los países de América Latina y el Caribe, hoy en día está posicionada y es representada en 20 países.En 1999, ALEIIAF se reestructura e incluye como miembros de la asociación a los asistentes al CLEIN.</p>

			<p>En la actualidad ALEIIAF es considerada como gestora, promotora y coordinadora de proyectos multinacionales de Ingeniería Industrial.</p>

			<h4 class="title">Misión</h4>

			<p>Promover el desarrollo integral de estudiantes y profesionales a través de actividades que propicien el intercambio académico, cultural y social; logrando así la generación de conocimientos y habilidades propias de la ingeniería industrial en Latinoamérica.</p>

			<h4 class="title">Visión</h4>

			<p>Ser líderes en brindar oportunidades para el desarrollo integral de estudiantes y profesionales de ingeniería industrial y afines, que propicien un espíritu creativo y emprendedor con compromiso social en pos del desarrollo sustentable de Latinoamérica.</p>

			<h4 class="title">Objetivos</h4>

			<p>Impulsar actividades de carácter profesional, cultural y social de cada país dando a conocer las últimas tendencias de la ingeniería industrial y afines <br>
			Promover el vínculo entre estudiantes y profesionales de ingeniería industrial y afines. <br>
			Generar alternativas de financiamiento para la gestión de la asociación. <br>
			Participar activamente en la organización y realización de CLEIN (Congreso Latinoamericano de Estudiantes e Ingenieros Industriales). <br></p>

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
