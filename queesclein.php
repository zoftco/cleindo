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

<section id="main">
	<div class="container">
        <img src="img/QUE-ES-EL-CLEIN.jpg" width="100%" />
<!--			<h4 class="title">¿Qué es CLEIN?</h4>-->
<!--            <p>El congreso Latinoamericano de Estudiantes e lngenieros lndustriales y Afines, es la actividad academica, social y cultural de mayor envergadura en el area de la lngenierfa Industrial en Latinoamerica, que afio tras afio reune a estudiantes, profesionales, docentes y empresarios de diferentes pafses de la region.</p>-->
<!--            <p>Su objetivo principal es proporcionar las herramientas necesarias para ser capaces de adaptarse a cualquier sector, con el conjunto de sus especialidades, ofreciendo un lugar donde pueden expresar sus opiniones y discutir temas relevantes para el desarrollo latinoamericano.</p>-->

	</div>
</section>

<?php include 'inc/footer.php'; ?>
