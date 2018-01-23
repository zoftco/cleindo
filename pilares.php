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
<div class="container-fluid">
    <img src="img/pilares/LEAN-STARTUP.jpg" alt="Día 1: Integración" width="100%">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>Muchas startups se conciben con la idea de un producto o servicio que los fundadores creen que la gente quiere. Por lo tanto, dedican meses (incluso años) perfeccionando dicho producto o servicio, sin saber si logrará la aceptación de los consumidores, al no tomar en cuenta lo que existe en el mercado, lo que los consumidores realmente necesitan, o bien, entender si lo que se propone es realmente una necesidad palpable. Pero, como no se consigue la aceptación deseada por los clientes, lo cual es lo propenso a suceder por no llevar a cabo pautas y factores reales de innovación y desarrollo de productos, la empresa falla.</p>
            <p>Para convertir este caos en orden, el CLEIN República Dominicana, a través del pilar Start-up, provee de herramientas claves para tener una visión continua de la situación en la que se encuentra la idea de negocio.</p>
            <br>
        </div>
    </div>
</div>

<div class="container-fluid">
    <img src="img/pilares/PROJECT-MANAGEMENT.jpg" alt="Día 1: Integración" width="100%">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <p>La gestión de proyectos es una disciplina que engloba el planeamiento, la organización, la motivación y el control de los recursos con el propósito de alcanzar uno o varios objetivos. Muchas veces el arranque de los proyectos con la metodología Lean Startup es el óptimo, sin embargo, por fallas en la gestión de recursos, la idea de negocios no se desarrolla de la manera más adecuada.</p>

    <p> Es por esto, que para poder revolucionar el mundo de los proyectos como lo conocemos, el CLEIN República Dominicana presenta herramientas necesarias para llevar a cabo una correcta gestión de proyectos.</p>
        <br>
        </div>
    </div>
</div>

<div class="container-fluid">
    <img src="img/pilares/MEJORA-CONTINUA.jpg" alt="Día 1: Integración" width="100%">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <p>Es claro que las tendencias mundiales muestran cómo las naciones se integran en comunidades en las que se fortalecen mutuamente y buscan la fusión de culturas. Para los países latinoamericanos, penetrar en este nuevo orden implica reconocer el papel del conocimiento y de la información como generadores de desarrollo.</p>

    <p>La mejora continua es un proceso que describe la esencia de la calidad y refleja lo que las empresas necesitan hacer si quieren ser competitivas a lo largo del tiempo. Esta puede llevarse a cabo como resultado de un escalamiento en los servicios o como una actividad proactiva por parte de alguien que lleva a cabo un proceso.</p>
        <br>
        </div>
    </div>
</div>
</section>

<?php include 'inc/footer.php'; ?>
