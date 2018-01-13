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
			<h4 class="title">Dias del CLEIN</h4>
        <p>Día 1: Integración</p>
        <p>Este sera un día cargado de emociones para todos los asistentes, buscando sentar las bases para toda una semana de integración latinoamericana, se lograra a través de actividades de integración y social. Para finalizar el día se realizara la apertura oficial del evento acompañados de figuras importantes, tanto nacionales como internacionales.</p>
        <p>Día 2: Lean Startup</p>
        <p>Hagámoslo!, aprenderemos a materializar nuestras ideas. No todo será perfecto en sus inicios pero lo importante es empezar.</p>
        <p>Actividades: Ponencias estudiantiles, ponencias magistrales, caso de éxito, taller.</p>
        <p>Día 3: Project Management</p>
        <p>Aprenderemos a manejar los recursos con los que contamos para mantener vivo nuestro proyecto de vida, social o cultural.</p>
        <p>Actividades: Ponencias estudiantiles,  ponencias profesionales, ponencias magistrales, taller.</p>
        <p>
        Día 4: Mejora Continua</p>
        <p>En este mundo tan cambiante no podemos quedarnos estáticos, escalemos nuestro start-up a un nivel mayor.</p>
        <p>Actividades: Ponencias profesionales, ponencias magistrales, casos de éxitos, taller.</p>
        <p>Día 5: Networking</p>
        <p>Conoceremos las practicas de Start-Up, Project Management y Mejor Continua que tienen diferentes empresas nacionales y multinacionales, contaremos con una feria de empresa donde espacio para networking.</p>


    </div>
</section>

<?php include 'inc/footer.php'; ?>
