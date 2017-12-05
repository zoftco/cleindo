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
		<h1>Visitas técnicas</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<!--<h4 class="title txtBold">Expositores Nacionales</h4>-->
			
			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/terport.png" class="img_expositor" alt="">
					<h5>TERPORT</h5>
					
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Terport inició actividades en el año 2002 y se ha convertido en una empresa de referencia en servicios portuarios, almacenaje, puerto seco, transporte terrestre y operaciones con cargas especiales.  La terminal está en la Ciudad de San Antonio, en el Km 363 del Rio Paraguay y 1603 de la Hidrovía Paraguay-Paraná.</p>
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/mazzei.png" alt="" class="img_expositor">
					<h5>MAZZEI</h5>
				
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Mazzei es una empresa procesadora de alimentos. Produce galletitas dulces y saladas, bajo estándares de calidad mundial capaces de aprobar los más exigentes exámenes alimenticios de institutos tecnológicos del rubro.</p>
					
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/fluoder.png" alt="" class="img_expositor">
					<h5>FLUODER</h5>
					
				<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Ingeniero Civil egresado de la Universidad Nacional de Asunción, Certificado PMP (Project Management Professional) por el PMI y egresado de la Universidad de Iowa como PhD. Civil Engineering – Structures & Project Management.</p>
					<p>FLUODER S.A. es una compañía líder en Paraguay en la Industria Química Básica. En 1982 instala en la ciudad portuaria de Villeta las primeras plantas industriales, una para la fabricación de ácido sulfúrico y la otra de sulfato de aluminio, los cuaaes son sus principales productos.</p>
					
				</div>
			</div>


			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/pepsi.png" alt="" class="img_expositor">
					<h5>PEPSI</h5>
					
				<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Pepsi, antiguamente conocida como Pepsi Cola, es una bebida carbonatada de cola originaria de Estados Unidos y producida por la compañía PepsiCo. Inicio su producción en septiembre de 2011 en la ciudad de San Antonio.
En la planta se producen todos los productos Pepsi: Pepsi Cola, Seven Up, Mirinda Guaraná, Mirinda Naranja y Paso de los Toros, Gatorade y H20h.</p>
					
				</div>
			</div>


	<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/worksafe.png" alt="" class="img_expositor">
					<h5>WORKSAFE</h5>
					
				<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p> El proyecto MARSEG (Maquiladora de artículos de seguridad) se inició en Julio de 2008 con la producción de capellada. Marseg identificó una oportunidad de negocio en el mercado de calzados “terminados”. Por lo tanto, diseñó una nueva línea de producción para inyección de la suela (terminación del calzado con la marca Worksafe) con enfoque de ventas directo de Paraguay para los mercados locales y de exportación. Tiene una capacidad productiva de más de 8 millones de pares al año, con un total de más de 1000 personas trabajando.</p>
					
				</div>
			</div>
		



<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/cervepar.png" alt="" class="img_expositor">
					<h5>CERVEPAR</h5>
					
				<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p> La mayor industria de cerveza en Paraguay, su planta industrial se encuentra en la ciudad de Ypane a 30 km de Asunción, en ella se fabrican las marcas: Pilsen, Budweiser, Corona, Stella Artois, Baviera, Skol, Ouro Fino, Brahma.Hacia el 2001, AmBev, la compañía fruto de la fusión de Brahma y Antártica en Brasil, selló con Cervecería Paraguaya una asociación estratégica que culminaría en 2006 con la adquisición del paquete accionario. </p>
					
				</div>
			</div>
			


<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/chacomer.png" alt="" class="img_expositor">
					<h5>CHACOMER</h5>
					
				<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p> En el año 2002, Chacomer S.A.E., ha instalado en la ciudad de Fernando de la Mora - en un predio de 20.000 m2 - una planta industrial del rubro metal mecánica, equipada con tecnología de última generación. En la planta industrial se fabrican motocicletas, bicicletas y equipos de gimnasia, donde cada unidad fabricada es sometida a estrictos controles de calidad, para garantizar el cumplimiento de las normas de producción y lograr así los más altos estándares de calidad. </p>
					
				</div>
			</div>
			




		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
