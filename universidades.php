<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->
<?php
if(isset($_SESSION['user_id'])) {
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
		<h1>Universidades Patrocinadoras</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p class="fotos_2"><a href="http://www.una.py/"><img src="images/univ_una.jpg" alt=""></a><a href="http://www.uamericana.edu.py/"><img src="images/univ_ua.jpg" alt=""></a></p>
			<p class="fotos_2"><a href="http://www.ucsa.edu.py/"><img src="images/univ_ucsa.jpg" alt=""></a><a href="http://www.uc.edu.py/"><img src="images/univ_uc.jpg" alt=""></a></p>
			<p class="fotos_2"><a href="http://www.upa.edu.py/"><img src="images/upa.png" alt=""></a></p>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
