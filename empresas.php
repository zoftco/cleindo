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
        <h4 class="title">CONVIÉRTASE EN SOCIO DEL CLEIN REPÚBLICA DOMINICANA 2018</h4>
        <p>Nuestro evento es la oportunidad perfecta para posicionar su marca, hacer negocios y actualizarse para generar competitividad en su organización, contáctenos y conozca como puede vincularse.</p>
        <h4 class="title">CONTACTO</h4>
        <p>Génesis Vargas</p>
        <p>Directora de Mercadeo y Patrocinios CLEIN República Dominicana 2018</p>
        <p>marketing.clein@gmail.com</p>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
