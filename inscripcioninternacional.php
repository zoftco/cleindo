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
<div class="container-fluid" style="background-image:url('img/INSCRIPCION.jpg');background-size: contain;background-repeat: no-repeat;background-position: center;">
    <div class="mx-auto" style="height:500px;text-align:center">
    </div>
</div>

<section id="main">
	<div class="container">
        <h4 class="title">¿CÓMO INSCRIBIRME?</h4>
        <p>1. Llena el formulario de Pre-Inscripción</p>
        <p>*Si eres estudiante debes anexar un soporte (Carnet estudiantil vigente, certificado de estudio, certificado de matricula vigente).</p>
        <p>2. Espera el correo de confirmación con los medios de pago.</p>
        <p>3. Realiza tu pago y llena el formulario de Inscripción, recuerda que debes anexar evidencia de la realización del pago en el formulario.</p>
        <h4 class="title">PAGOS INTERNACIONALES</h4>
        <p>WESTERN UNION</p>
        <p>Enrique Ramirez</p>
        <p>CC. xxxxxxxx</p>
        <p>País: Republica Dominicana</p>
        <p>Ciudad: Santo Domingo
        </p>
        <h4 class="title">PAGOS PAYPAL</h4>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
