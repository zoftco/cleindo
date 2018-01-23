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
<section>
    <div class="container-fluid">
        <img src="img/diasdelclein/INTEGRACION-1.jpg" alt="Día 1: Integración" width="100%">
    </div>
    <div class="container">
        <p>Este sera un día cargado de emociones para todos los asistentes, buscando sentar las bases para toda una semana de integración latinoamericana, se lograra a través de actividades de integración social. Para finalizar el día se realizara la apertura oficial del evento acompañados de figuras importantes, tanto nacionales como internacionales.</p>

    </div>
    <div class="container-fluid">
        <img src="img/diasdelclein/STARTUP-2.jpg" alt="Día 2: Startup" width="100%">
    </div>
    <div class="container">
        <p>¡Hagámoslo!, aprenderemos a materializar nuestras ideas. No todo será perfecto en sus inicios pero lo importante es empezar.</p>
        <p>Actividades: Ponencias estudiantiles, ponencias magistrales, caso de éxito, taller.</p>
    </div>
    <div class="container-fluid">
        <img src="img/diasdelclein/PROJECT-MANAGEMENT-3.jpg" alt="Día 3: Project Management" width="100%">
    </div>
    <div class="container">
        <p>Aprenderemos a manejar los recursos con los que contamos para mantener vivo nuestro proyecto de vida, social o cultural.</p>
        <p>Actividades: Ponencias estudiantiles,  ponencias profesionales, ponencias magistrales, taller.</p>
    </div>
    <div class="container-fluid">
        <img src="img/diasdelclein/MEJORA-CONTINUA-4.jpg" alt="Día 4: Mejora Continua" width="100%">
    </div>
    <div class="container">
        <p>En este mundo tan cambiante no podemos quedarnos estáticos, escalemos nuestro start-up a un nivel mayor.</p>
        <p>Actividades: Ponencias profesionales, ponencias magistrales, casos de éxitos, taller.</p>
    </div>
    <div class="container-fluid">
        <img src="img/diasdelclein/NETWORKING-5.jpg" alt="Día 5: Networking" width="100%">
    </div>
    <div class="container">
        <p>Conoceremos las prácticas de Start-Up, Project Management y Mejora Continua que tienen diferentes empresas nacionales y multinacionales, contaremos con una feria de empresa donde espacio para networking.</p>


    </div>
</section>

<?php include 'inc/footer.php'; ?>
