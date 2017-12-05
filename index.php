



<?php include 'inc/header.php'; ?>

<?php
	if (isset($_GET['uuid'])) {
		require('pago/Procard.php');
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
<!--Barra de Usuario Logueado-->
<?php
	if(isset($_SESSION['user_name'])) {
?>
	<div class="userbar">
		<div class="container">
			Bienvenido/a <strong><?php echo $_SESSION['user_name'] ;?></strong> <!-- <a href="mis_cursos.php" class="button azul mini">Mis Cursos</a> --> <a href="cursos_disponibles.php" class="button azul mini">Cursos Disponibles</a> <a href="inc/cerrarsesion.php" class="button azul mini">Salir</a>
		</div>
	</div>
<?php
	}
?>

<!--Barra de Usuario Logueado-->

<section id="top_title">
	<div class="container">
		<div class="text_izq">
			<h3>XXVII CONGRESO LATINOAMERICANO <br> DE ESTUDIANTES E INGENIEROS INDUSTRIALES Y AFINES</h3>
			<h5>DEL 29 DE OCTUBRE AL 03 DE NOVIEMBRE 2018<br>SANTO DOMINGO - REPÚBLICA DOMINICANA</h5>
		</div>
		<div class="inscribirse_holder">
			<a href="inscripcion.php" class="button btn_inscribirse">INSCRIPCIONES</a>
		</div>
		<div class="clearfix"></div>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>

			<h4>DESAFIA TUS LÍMITES, REVOLUCIONA TU MUNDO<br>
                <strong>CLEIN 2018</strong></h4>
			<p>
				<img src="" width="100%">
			</p>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>
	</div>
</section>

<?php include 'inc/footer.php'; ?>
