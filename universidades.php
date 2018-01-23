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
    <img src="img/VINCULARSE.jpg" alt="Día 1: Integración" width="100%">
</div>

<section id="main">
	<div class="container">
        <h4 class="title">VINCÚLESE COMO UNIVERSIDAD</h4>
        <p>Su Universidad puede vincularse al evento, siendo universidad auspiciadora, vincularse como apoyo científico o comprando cupos a precios preferenciales para estudiantes o docentes.</p>
        <h4 class="title">CONTACTO</h4>
        <p>Génesis Vargas</p>
        <p>Directora de Mercadeo y Patrocinios CLEIN República Dominicana 2018</p>
        <p>marketing.clein@gmail.com</p>
        <p>John Guzman Diaz</p>
        <p>Director de Academica CLEIN República Dominicana 2018</p>
        <p>academico.clein@gmail.com</p>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
