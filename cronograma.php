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

<section id="top_title">
	<div class="container">
		<h1>Cronograma Clein 2015</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article class="fullsize">
			<p><img src="images/cronograma_clein.jpg" class="noshadow" alt=""></p>

			<p>Como podemos observar en el cronograma, estamos implementando un taller innovador en los horarios de la mañana. Dicha actividad tiene como finalidad ofrecer un trabajo dinámico, donde el participante no sólo asistirá a la charla, sino también deberá realizar un trabajo dinámico donde se pondrá en práctica casos reales a los que comúnmente un ingeniero industrial se enfrenta y deberá saber cómo resolver. Es importante recalcar que los participantes, en la resolución de sus problemas, tendrán el acompañamiento del disertante.</p>

		</article>
	
	</div>
</section>

<?php include 'inc/footer.php'; ?>
