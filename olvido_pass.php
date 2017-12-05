<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->

<!--Barra de Usuario Logueado-->
<section id="top_title">
	<div class="container">
		<h1>Cambio de contraseña</h1>
	</div>
</section>

<?php
	if (!isset($_GET['id']) && !isset($_GET['confirmado'])) {
		header("Location:".WEB_URL."/error.php");
	}
?>

<section id="main">
	<div class="container">
		<article>
			<?php
				error_reporting(E_ALL);
				ini_set('display_errors', 1);
				require('inc/conexion.php');

				if(isset($_POST['pass']) && isset($_POST['re_pass']) && isset($_POST['id'])) {
					$pass = $_POST['pass'];
					$repass = $_POST['re_pass'];
					$id = $_POST['id'];
					
					if ($pass != $repass) {
						header("Location:".WEB_URL."/olvido_pass.php?pass=false&id=$id");
					} elseif ($pass == $repass) {
						$passhash = hash("sha512", $pass);
						mysqli_query($conexion, "UPDATE login SET contrasena = '$passhash' WHERE id = '$id'");
						header('Location:'.WEB_URL.'/olvido_pass.php?confirmado=true');
					}
				}
			?>
			<?php
				if (isset($_GET['pass']) && $_GET['pass'] == 'false') {
			?>
				<h2 class="title" style="color:red">Las contraseñas deben ser iguales. Por favor intente de nuevo.</h2>
			<?php
				} elseif (!isset($_GET['confirmado'])) {
			?>
				<h4 class="title">¿Olvidaste tu contraseña?</h4>
			<?php
				}
			?>
			
			<?php
				if (isset($_GET['confirmado']) && $_GET['confirmado'] == 'true') {
			?>
					<h2 class="title">Su contraseña se ha cambiado con éxito.</h2>
			<?php
				} elseif (isset($_GET['id'])) {
			?>
					<p>Introduce una contraseña nueva para cambiarla.</p>
						<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
							<div class="form-row">
								<label for="name">Nueva contraseña: </label>
								<input type = "password" name = "pass" required>
							<div>
							<div class="form-row">
								<label for="name">Repetir contraseña: </label>
								<input type = "password" name = "re_pass" required>
							<div>
							<div class="form-row">
								<input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
								<input type="submit" value="Confirmar">
							</div>
						</form>
			<?php
				}
			?>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
