



<?php include 'inc/header.php'; ?>

<?php
	if (isset($_GET['uuid'])) {
		require('pago/Procard.php');
        require ('inc/config.php');
		require ('inc/conexion.php');
		$user_id = $_SESSION['user_id'];
		$uuid = $_GET['uuid'];
		$result = $procard->checkResult($uuid);
		$resultado = $result->CodRespAut;
		$descripcion = $result->DescRespAut;
		//$primerquery= mysqli_query($conexion, "INSERT INTO transacciones (id_pago, uuid, fecha) VALUES ('$user_id', '$uuid', NOW())");
		if ($resultado == '00') {
			require("inc/config.php");
			require 'admin/TemplateMail/PHPMailer-master/PHPMailerAutoload.php';
			require('admin/TemplateMail/mandarmail.php');

			$query= mysqli_query($conexion, "SELECT * FROM transacciones WHERE uuid = '$uuid'");
			$datosTrans = mysqli_fetch_assoc($query);
			$user_id = $datosTrans['id_pago'];
			$query= mysqli_query($conexion, "UPDATE login SET estado='cursos' WHERE id = '$user_id'");

			$email = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$user_id'");
			$email = mysqli_fetch_assoc($email);
			$email = $email['correoElectronico'];

			$titulo = "CLEIN Paraguay";
			$sujeto = "Transacción aceptada";
			$mensaje = 'Gracias por registrarte a nuestra página. Ingresa <a href= "'.WEB_URL.'">aquí</a> para acceder.';

			$pago_confirmado = new MandarMail;
			$pago_confirmado->mandar($titulo, $mensaje, $email, $sujeto);

			header("Location:".WEB_URL."/cursos_disponibles.php");
		} else {
			$_SESSION['descripcion'] = $descripcion;
			header("Location:".WEB_URL."/inscripciones_paso3.php?transaccion=failed");
		}
	} else {
		$hacer = 'nada';
	}
?>
<section>
	<div class="container-fluid" id="homeimage">
        <div class="mx-auto" style="height:120px;text-align:center">
            <a href="inscripcioninternacional.php" class="btn btn-lg btn-red">INSCRIPCIONES</a>
        </div>
	</div>
</section>



<section id="main">
	<div class="container">
        <div style="text-align: center;"><h1>DESAFIA TUS LÍMITES, REVOLUCIONA TU MUNDO</h1></div>
			<p>Será un escenario de encuentro, aprendizaje e intercambio de experiencias desde el sector académico, en el que nos comprometeremos como futuros ingenieros hacia un objetivo común para toda Latinoamérica: ser ejemplo de cambio a nivel mundial. En este espacio definiremos no solo propuestas, sino actos que nos garanticen tomar un rumbo innovador hacia los retos que el mundo presenta en la actualidad, alcanzando así, desde la ingeniería, un entorno adecuado para el desarrollo social y cultural, llevándonos hacia la paz y el desarrollo integral.</p>
    </div>
    <br />
        <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="ofertaacademica.php"> <img class="d-block w-100" src="img/ACT.-ACADEMICAS.jpg" alt="First slide"></a>
                </div>
                <div class="carousel-item">
                    <a href="republicadominicana.php"><img class="d-block w-100" src="img/IMAGEN-REPUBLICA-DOMINICANA.jpg" alt="Second slide"></a>
                </div>
                <div class="carousel-item">
                    <a href="pilares.php">
                    <img class="d-block w-100" src="img/PILARES-ACADEMICOS.jpg" alt="Third slide">
                    </a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <nav class="nav nav-pills nav-justified">
            <a class="nav-item nav-link" href="#">PORTAFOLIO ACADÉMICO</a>
            <a class="nav-item nav-link" href="#">CONCURSO DE PONENCIAS</a>
            <a class="nav-item nav-link" href="#">GUÍA DE ASISTENTE DEL CONGRESO</a>
        </nav>
	</div>
</section>

<?php include 'inc/footer.php'; ?>
