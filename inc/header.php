<?php
	session_start();
	require_once('config.php');
	if (isset($_SESSION['user_id'])){
		$_SESSION['time'] = time() + 3600;
		$login = true;
	} else {
		$login = false;
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="XXIV Congreso Latinoamericano de Estudiantes e Ingenieros Industriales y Afines">
	<title>XXIV Congreso Latinoamericano de Estudiantes e Ingenieros Industriales y Afines</title>
	<meta name="description" content="XXVII CLEIN Republica Dominicana 2018 - Santo Domingo del 29 de octubre a 3 de noviembre de 2018">
	<meta property="og:title" content="CLEIN Republica Dominicana 2018" />
	<meta property="og:site_name" content="CLEIN Republica Dominicana 2018">
	<meta property="og:url" content="<?php echo WEB_URL;?>">
	<meta property="og:type" content="website">
	<meta property="og:description" content="Santo Domingo - Republica Dominicana del 29 de octubre a 3 de noviembre de 2018" />
	<meta property="og:image" itemprop="image" content="<?php echo WEB_URL;?>/images/cleindominicana2018.jpg" />
	<meta property="og:image:url" content="<?php echo WEB_URL;?>/images/cleindominicana2018.jpg">
	<meta property="og:image:height" content="474">
	<meta property="og:image:width" content="1280">



	<script async="" src="https://www.google-analytics.com/analytics.js"></script><script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-66351966-3', 'auto');
		ga('send', 'pageview');

	</script>











	<!--CSS-->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/lightbox.css">

	<!--JS-->
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript">
        var host = "<?php echo WEB_URL;?>";
    </script>
	<script type="text/javascript" src="js/Login.js"></script>
	<script type="text/javascript" src="js/controlPagoTc.js"></script>
	<script type="text/javascript" src="js/loginControl.js"></script>




</head>
<body>
<?php include_once("analyticstracking.php") ?>
<header>
	<div class="container">
		<a href="index.php"><div class="logo">CLEIN República Dominicana 2018</div></a>
		<nav>
			<ul>
				<li><a href="#">Temática</a>
					<ul>
						<!-- <li><a href="tematica.php">Temática</a></li>
						<li><a href="expositores.php">Expositores</a></li>
						<li><a href="industriales.php">Visitas Industriales</a></li>
						<li><a href="concurso.php">Concurso de ponencia estudiantil</a></li> -->
					</ul>
				</li>
				<li><a href="#">Actividades</a>
					<ul>
						<!-- <li><a href="cronograma.php">Cronograma</a></li>
						<li><a href="actividades_nocturnas.php">Actividades Nocturnas</a></li>
						<li><a href="crea_tu_negocio.php">Crea tu negocio</a></li>
						<li><a href="actividad_social.php">Actividad social</a></li>
						<li><a href="visitas_tecnicas.php">Visitas Técnicas</a></li> -->
					</ul>
				</li>
				<li><a href="#">Comunidad</a>
					<ul>
						<!-- <li><a href="aleiiafpy.php">Aleiiaf Paraguay</a></li>
						<li><a href="aleiiaf.php">Aleiiaf</a></li>
						<li><a href="universidades.php">Universidades Patrocinadoras</a></li> -->
					</ul>
				</li>
				<li><a href="#">Rep. Dominicana</a>
					<ul>
						<!-- <li><a href="asuncion.php">Asunción</a></li>
						<li><a href="paraguay.php">El País</a></li>
						<li><a href="http://www.migraciones.gov.py/institucional" target="_blank">Datos Migraciones</a></li>
						<li><a href="tour_clein.php">Pre y Post Congreso</a></li> -->
					</ul>
				</li>
				<!-- <li><a href="hospedaje.php">Hospedaje</a></li>
				<li><a href="contacto.php">Contacto</a></li> -->
				<?php
					if ($login == false) {
				?>
				<li><a href="log_in.php">Entrar aqui</a></li>
				<?php
					} else {
				?>
				<li><a href="mis_cursos.php">Mi Cuenta</a>
					<ul>
						<li><a href="inc/cerrarsesion.php">Cerrar sesión</a></li>
						<li><a href="mis_cursos.php">Mis cursos</a></li>
						<li><a href="cursos_disponibles.php">Cursos Disponibles</a></li>
					</ul>
				</li>
				<?php
					}
				?>

			</ul>
		</nav>
	</div>
</header>
