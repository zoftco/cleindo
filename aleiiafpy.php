<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->
<?php
if(isset($_SESSION['user_name'])) {
?>
<div class="userbar">
<div class="container">
Bienvenido/a <strong><?php echo $_SESSION['user_name'];?></strong> <!-- <a href="mis_cursos.php" class="button azul mini">Mis Cursos</a> --> <a href="inscripciones_paso4_actividades.php" class="button azul mini">Cursos Disponibles</a> <a href="inc/cerrarsesion.php" class="button azul mini">Salir</a>
</div>
</div>
<?php
}
?>

<!--Barra de Usuario Logueado-->
<section id="top_title">
	<div class="container">
		<h1>ALEIIAF Paraguay</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<p class="txtC"><img src="images/aleiiaf.png" class="noshadow" alt=""></p>

			<p>La <strong>Asociación Latinoamericana de Estudiantes de Ingeniería Industrial y Carreras Afines —Filial Paraguay (ALEIIAF PARAGUAY)</strong> fue constituida en marzo del 2012, por jóvenes emprendedores que tomaron interés por dicha Asociación y la volvieron a activar después de varios años de sólo haber estado participando en el evento del Congreso realizado por ALEIIAF MATRIZ denominado CLEIN.</p>
		
			<p>El primer logro fue la realización en el mes de mayo del año 2012 el <strong>"PRIMER CONGRESO PARAGUAYO DE ESTUDIANTES DE INGENIERÍA INDUSTRIAL Y CARRERAS AFINES"</strong> denominado CPEII, bajo el lema "La Ingeniería: Motor Del Desarrollo Hacia Un Nuevo Paraguay"; realizado en la "UNION INDUSTRIAL PARAGUAYA" - UIP, dicho congreso tuvo una participación de 240 jóvenes estudiantes y recibidos de la carrera. </p>

			<p>Asi como se obtuvo y se superó la meta propuesta de la cantidad de inscriptos del mismo modo fue bastante buena la receptividad y apoyo brindado para las distintas empresas y entidades que apoyaron nuestro primer evento a nivel Asociación.</p>
			
			<p><strong>CPEII - "CONGRESO PARAGUAYO DE ESTUDIANTES DE INGENIERÍA INDUSTRIAL Y CARRERAS AFINES"</strong> se celebra una vez al año, dicho evento invita a estudiantes de todo el país y países vecinos a beneficiarse de información de vanguardia a través de múltiples actividades entre las que destacan magnas conferencias impartidas por los más distinguidos especialistas</p>

			<p>En el año 2013 se realizó el "SEGUNDO CONGRESO PARAGUAYO DE ESTUDIANTES DE INGENIERÍA INDUSTRIAL Y CARRERAS AFINES". en la ciudad de Asunción, los días 30 de abril; 02,03,04 de mayo del 2013; bajo el lema."Excelencia en gestión y producción como base del desarrollo sustentable en el Paraguay", en el Centro Paraguayo del Ingeniero asistiendo 250 estudiantes y profesionales.</p>

			<h5 class="title">Fotos del Primer Congreso</h5>

			<p class="fotos_3"><img src="images/congreso1_1.jpg" alt=""><img src="images/congreso1_2.jpg" alt=""><img src="images/congreso1_3.jpg" alt=""><img src="images/congreso1_4.jpg" alt=""><img src="images/congreso1_5.jpg" alt=""><img src="images/congreso1_6.jpg" alt=""></p>
			
			<h5 class="title">Fotos del Segundo Congreso</h5>

			<p class="fotos_3"><img src="images/congreso2_1.jpg" alt=""><img src="images/congreso2_2.jpg" alt=""><img src="images/congreso2_3.jpg" alt=""><img src="images/congreso2_4.jpg" alt=""><img src="images/congreso2_5.jpg" alt=""></p>


		<hr></br>
			<p>Presidente ALEIIAF Paraguay: Francisco Pino</p>
<p>Vice-Presidenta ALEIIAF Paraguay: Violeta Ortellado</p>
<p>Presidente CLEIN Paraguay 2015: Julian Serrano</p>
<p>Directora Logistica: Paloma Baez</p>
<p>Directora Academica: Betania Aguilera</p>
<p>Director de Finanzas: Ing. Arturo Toñanez</p>
<p>Directora de Marketing: Karina Kriskovich</p>
		<hr>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
