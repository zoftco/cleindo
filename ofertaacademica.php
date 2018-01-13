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
        <h1>Oferta Académica</h1>
    </div>
</section>

<section id="main">
	<div class="container">
        <img src="img/ofertaacademica/CONFERENCIAS-MAGISTRALES.jpg" width="100%" />
        <p>El congreso contara con conferencistas de talla nacional como internacional, los cuales, a través de sus experiencias diversas, buscarán enlazar cada uno de los temas con el objetivo de lograr la meta central del congreso.
        </p>

        <img src="img/ofertaacademica/PONENCIAS.jpg" width="100%" />
        <p>En el transcurso del congreso el asistente tendrá acceso a estudiantiles y profesionales. Se realizará la convocatoria para aquellos que decidan participar en este espacio de socialización investigativa.
        </p>


        <img src="img/ofertaacademica/CASOS-DE-EXITO.jpg" width="100%" />
        <p>Los casos de éxitos permiten transmitirlas experiencias de innovación y liderazgo como ejemplo de buenas prácticas que pretenden servir de estímulo a las personas, intentando transformar en los distintos ámbitos.
        </p>

        <img src="img/ofertaacademica/PONENCIA-CULTURAL.jpg" width="100%" />
        <p>En la situación actual en la que nos encontramos donde muchas veces, importa más la generación de beneficios económicos y triunfos personales; se hace necesario contar con personas que han tomado la iniciativa de entregar lo mejor de sí, combinando la pasión por lo que les gusta con el bienestar social.
        </p>

        <img src="img/ofertaacademica/TALLERES.jpg" width="100%" />
        <p>Ayudarán tanto a aumentar el sentido creativo y trabajo en equipo como proporcionar un contacto con la vida real, donde se dote de la capacidad para la interpretación de los hechos; basados en los tres pilares: Lean Start-up, Mejora Continua y Project Management.
        </p>

        <h4 class="title">Ferias Empresariales:</h4>
        <p>Se contara con la presencia de empresas patrocinadoras, donde cada una ofrecerá a los asistentes sus productos y/o servicios.
        </p>

        <img src="img/ofertaacademica/VISITAS-TECNICAS.jpg" width="100%" />
        <p>Brindar al participante una experiencia palpable de manera que puedan conocer los pilares y valores reflejados en las empresas e industrias a visitar.</p>

    </div>
</section>

<?php include 'inc/footer.php'; ?>
