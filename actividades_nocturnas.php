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
		<h1>Actividades Nocturnas</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<h5 class="title">Halloween</h5>
			<p>Siempre presente en todos los congresos, se realizará la fiesta de noche de brujas con premios a los mejores disfraces.</p>

			<h5 class="title">OktoberFest</h5> 
			<p>Estas fiestas temáticas tienen un fin común promover la integración y la comunicación entre todos los participantes en la fiesta Pre-Clein. La Secretaría de Turismo de la Organización Paraguaya de Cooperación Intermunicipal (OPACI) considera que la fiesta de la cerveza, conocida como la Oktoberfest, ya forma parte de los atractivos turísticos del Paraguay. Es así que, acompaña y alienta a los organizadores de los eventos y por sobre todo, insta a todos a participar de los mismos.</p>

			<h5 class="title">Pubcrawl CLEIN</h5> 
			<p>Un pub crawl (a veces llamado un recorrida de bares, bar tour o ida de bar en bar, ir de bares) es el acto de una o más personas que visitan múltiples bares en una sola noche, normalmente trasladándose a pie, siendo ésta una oportunidad única para conocer lo mejor de la vida nocturna asuncena en la zona céntrica de la ciudad. La idea, para adaptarlo al CLEIN es recorrer dos bares y luego terminar en una discoteca tradicional del centro donde cerraríamos con una fiesta. Buscaremos promover la integración de los participantes haciendo actividades en el escenario, por ejemplo, concurso de baile y talentos</p>

			<h5 class="title">Noche de las Naciones</h5> 
			<p>Esta noche es una de las más importantes ya que cada país participante tendrá un stand donde podrán mostrar todo lo relacionado a su país, empezando por sus comidas, bebidas, vestimentas y bailes típicos. Una noche para conocer e integrar las culturas Latinoamericanas, así dar a conocer la cultura del país anfitrión, cuyo stand tendrá como temática una verdadera fiesta típica paraguaya con todo lo que le caracteriza, juegos y comidas tradicionales, conocida como “San Juan ára”.</p>

			<h5 class="title">Cena de Gala</h5> 
			<p>El CLEIN PARAGUAY 2015 cerrará este magnífico evento como se merece homenajeando a todos los participantes con una cena de gala para que todos compartamos nuestras experiencias y conocimientos adquiridos como hermanos Latinoamericanos.</p>


			<h5 class="title">Imágenes</h5>
			<p class="fotos_3"><img src="images/nocturno1.png" alt=""><img src="images/nocturno2.png" alt=""><img src="images/nocturno3.png" alt=""><img src="images/nocturno4.png" alt=""><img src="images/nocturno5.png" alt=""></p>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
