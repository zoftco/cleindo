<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->
<?php
	if(isset($_SESSION['user_id'])) {
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
		<h1>Temática</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<h4 class="title">LEMA</h4>
			<p>"Afianzando la versatilidad, desde el corazón de América Latina."</p>
			
			<h4 class="title">MISIÓN</h4>
			<p>”Promover un intercambio de excelencia académica, tecnológica y cultural entre los estudiantes latinoamericanos de Ingeniería Industrial, enfocándose en los ejes temático: Sistemas de Gestión, Liderazgo y Recursos.</p>

			<h4 class="title">VISIÓN</h4>
			<p>“Que el CLEIN en Paraguay sea un evento icono de la excelencia en la promoción de investigaciones, experiencias tanto académicas como profesionales. Proporcionando a los participantes conocimientos de calidad y motivarlos antes los desafíos y oportunidades que la realidad regional presenta”.</p>

			<h4 class="title">OBJETIVO GENERAL</h4>
			<p>"Proporcionar a los estudiantes de Ingeniería Industrial y Carreras afines las herramientas necesarias para ser capaces de adaptarse a cualquier sector, con el conjunto de sus especialidades. Ofreciendo un lugar donde pueden expresar sus opiniones y discutir temas relevantes para el desarrollo latinoamericano."</p>

			<h4 class="title">OBJETIVOS ESPECIFICOS</h4>
			<ul>
				<li>Integrar a las Universidades y Facultades de Latinoamérica que posean un plan de estudios de Ingeniería Industrial y afines. </li>
				<li>Formar líderes para que contribuyan con el desarrollo social, cultural y económico de su país y Latinoamérica.</li>
				<li>Fomentar la búsqueda de desarrollo tecnológico a través de la investigación y apoyar a los estudiantes que necesiten un espacio para plasmar sus ideas en beneficio de la comunidad.</li>
			</ul>

			<h4 class="title">PILARES</h4>
			<h5>GESTIÓN</h5>
			<p>El Ingeniero Industrial es la persona más capacitada para asumir el rol de la gestión en una empresa/industria. No sólo porque le encanta el riesgo de hacerlo, sino por las funciones: encontrar la solución a todos los problemas, indicar como hay que hacerlo, tener la capacidad de relacionarse, expresarse, ser realista, producir más con lo que se tiene, planificar el futuro, encontrar la mejor estrategia, establecer sistema de gestión ya sea de la calidad, de seguridad, de proyectos o del medio ambiente.</p>

			<p>Es por eso la importancia de este pilar, para ofrecer herramientas a los estudiantes y profesionales para desarrollar e incorporar todas estas cualidades y muchas otras que los diferentes disertantes lo van a transmitir a través de sus distintas experiencias tanto profesional como de vida.</p>
			
			<h5>LIDERAZGO</h5>
			<p>Frecuentemente se dice que los ingenieros no poseen habilidades blandas o bien, poseen un grado de desarrollo muy bajo de éstas. En el contexto de las economías actuales y de la competencia entre organizaciones, el saber influenciar y motivar a las personas hacia determinados objetivos, toma un rol esencial y es en este contexto que los ingenieros industriales deben saber ejercer la función de liderazgo a nivel organizacional dado el tipo de trabajo que desempeña, el que principalmente se vincula con la formación de equipos o la relación con personas de distintos ámbitos, por lo cual, el entendimiento de los valores, actitudes, emociones y capacidades que deben tener los ingenieros en el marco de su perfil propuesto por las facultades de ingeniería, requiere de saber reconocer a esta habilidad como uno de las capacidades fundamentales que deben tener los ingenieros industriales de cara a un mundo cada vez más dinámico, turbulento y competitivo, así como también comprender sus actuales competencias y características y reconocer pautas o posibles técnicas o metodologías para potenciar la importante labor de liderazgo que desempeñan en la sociedad actual.</p>
			
			<h5>RECURSOS</h5>
			<p>El ingeniero industrial busca incrementar la eficiencia de las organizaciones mediante la integración y optimación de los recursos: humanos, materiales, económicos, de información y energía en los sistemas industriales y de servicios; así como incrementar la productividad, calidad, servicio y rentabilidad de los sistemas de actividad humana, para lograr una mayor competitividad, un mejor nivel de vida y bienestar económico y social de los integrantes de los sistemas, concentrando sus esfuerzos en la parte operativa en áreas como: producción, mantenimiento, seguridad, abastecimiento y manejo de materiales, distribución del producto y plantas industriales, análisis y evaluación de proyectos, control de calidad ó en áreas operativas de empresas de servicios.</p>

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
