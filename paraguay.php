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
		<h1>Paraguay</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<h4 class="title">Ubicación Geográfica en el corazón de Sudamérica</h4>
			<p class="txtC"><img src="images/paraguay.jpg" alt=""></p>
			
			<p>Paraguay está situado en pleno Corazón de Sudamérica, al lado de Argentina y Brasil, que tradicionalmente son los que más participantes llevan a los congresos internacionales.</p>

			<h4 class="title">Un Mercado Emergente con una economía en constante crecimiento</h4>

			<p>La economía paraguaya viene experimentando un crecimiento sin precedentes en los últimos años. En el 2013 la tasa de crecimiento del PIB fue de 13,6%, la tercera de mayor crecimiento en el mundo y la primera en las Américas. Por varias razones enunciadas aquí abajo, Paraguay es una importante economía emergente que despierta el interés de los inversionistas extranjeros. </p>

			<p class="txtC"><img src="images/paraguay2.jpg" alt=""></p>

			<p><strong>Cifras 2013</strong></p>

			<ul>
				<li>1er Exportador Mundial de Energía Eléctrica.</li>
				<li>Mayor Productor Mundial de Azúcar Orgánica.</li>
				<li>2do Productor y Exportador Mundial de Stévia.</li>
				<li>4to Exportador Mundial de Soja</li>
				<li>8vo Exportador Mundial de Carne Bovina (210.000 toneladas).</li>
			</ul>


		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
