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
		<h1>Concurso de Ponencia Estudiantil</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>

			<h4 class="title">Cronograma de Concurso de Ponencia Estudiantil</h4>
			<p>Los estudiantes que quieran participar en el concurso de ponencias 
				estudiantiles deberán inscribirse enviando un correo a la Comisión 
				Académica del CLEIN a ponenciasclein2015@gmail.com y cumplir las diversas etapas:</p>
			<table>
				<thead>
					<tr>
						<th style="width:50%">Actividad</th>
						<th style="width:50%">Fecha límite</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Inscripción y recepción de resúmenes</td>
						<td>Domingo 26 de Julio</td>
					</tr>
					<tr>
						<td>Selección Preliminar de resúmenes</td>
						<td>Viernes 31 de Julio</td>
					</tr>
					<tr>
						<td>Resultados de la Selección Preliminar</td>
						<td>Lunes 3 de Agosto</td>
					</tr>
					<tr>
						<td>Presentación de trabajos finales</td>
						<td>Lunes 31 de Agosto</td>
					</tr>
					<tr>
						<td>Anuncio de Finalistas</td>
						<td>Lunes 7 de Septiembre</td>
					</tr>
					<tr>
						<td>Plazo de Confirmación</td>
						<td>Lunes 14 de Septiembre</td>
					</tr>
					<tr>
						<td>Notificación (en caso de que no todos los ganadores confirmen) </td>
						<td>Miércoles 16 de Septiembre</td>
					</tr>
					<tr>
						<td>Publicación Oficial</td>
						<td>Viernes 25 de Septiembre</td>
					</tr>
				</tbody>
			</table>

			<!--<h4 class="title">DESCRIPCIÓN DE LAS ETAPAS CONCURSO PONENCIA ESTUDIANTIL</h4>

			<p><strong>Etapa de Inscripción</strong><br> Los interesados en participar en el concurso de ponencias deben enviar a la Comisión Académica del CLEIN lo siguiente:</p>
			<ul>
				<li>Carta electrónica dirigida a la Comisión Académica del Congreso (ponenciasclein2015@gmail.com) expresando el deseo de participar en el concurso e indicando sus datos personales [nombre(s) completo(s), número(s) de identificación, correo(s) electrónico(s), número(s) de teléfono.</li>
				<li>Constancia de estudios, certificando el ciclo o año que cursa así como la carrera y universidad.</li>
				<li>Datos personales del o los profesores que asesorarán el trabajo (nombre completo, correo electrónico, número de teléfono y grado académico).</li>
				<li>El trabajo completo de la ponencia en formato Word o PDF dirigido a la Comisión Académica del Congreso (academica.paraguay@gmail.com).No debe exceder 30 páginas incluyendo carátula. Se envía de manera electrónica.</li>
			</ul>
			<p>Nota: Una vez revisados los requisitos solicitados, se darán a conocer las personas que aprobaron la etapa inicial.</p>

			<p><strong>Etapa de Selección Preliminar</strong><br> Una vez finalizada la etapa de inscripción se revisarán los requisitos y la alineación de las ponencias con los pilares temáticos del congreso; realizado esto, se darán a conocer los resultados de las personas que clasificaron a la siguiente fase. El anuncio se publicará en la página web oficial del evento y a su vez, se enviará a los participantes, profesores y universidades un correo comunicando el resultado.</p>

			<p><strong>Etapa de Presentación</strong><br> Las personas clasificadas deberán enviar un archivo digital que contenga un video con la presentación oral de su ponencia. La exposición debe tener una duración mínima de 20 minutos y máxima de 30 minutos. Las 9 ponencias ganadorasse darán a conocer el 21 de agosto de 2015.</p>

			<p>-->
				<strong>Resúmenes</strong><br>
				El archivo deberá contar con una carátula según se muestra en el formato del anexo N°1 del documento adjunto más abajo.
				<ul>
					<li>El contenido del trabajo iniciará con el título en mayúscula, negrita y centrado (Arial 14) del trabajo de investigación a desarrollar. 
						Dos renglones abajo se ubicará en el que se deberán tratar 
						los siguientes aspectos: 
						<ul>
							<li>Idea principal del tema a investigar. </li>
							<li>Justificación breve de la elección. </li>
							<li>Alcance y fines que se persiguen con la elaboración del trabajo.</li>
						</ul>
					</li>
				</ul>
			</p>

			<p>
				<strong>El trabajo completo</strong><br>
				<ul>
					<li>El trabajo debe contener un número de 30 (treinta) páginas como máximo, incluida la carátula. </li>
					<li>Los trabajos se presentarán en extensión pdf. El nombre del archivo deberá seguir 
						la siguiente estructura: [“Numero en romanos del desafío elegido en el que se 
						participará” – “Titulo del trabajo” – “Apellido del primer autor”.pdf].</li>
					<li>El trabajo deberá contener la siguiente secuencia de secciones: 
						<ul>
							<li>Carátula</li>
							<li>Índice</li>
							<li>Resumen</li>
							<li>Introducción</li>
							<li>Desarrollo</li>
							<li>Anexos (en caso de que sea necesario)</li>
							<li>Conclusiones</li>
							<li>Bibliografía</li>
						</ul>
					</li>
					<li>La carátula será elaborada de acuerdo al modelo que se indica en el anexo N°2 del documento adjunto.</li>
					<li>El resumen debe informar brevemente sobre los principales puntos a tratar y no debe superar una página. </li>
					<li>En el caso del índice, se deberá desarrollar uno para la parte textual y otro para los gráficos o tablas a considerar.</li>
					<li>Finalmente, se deben seguir los siguientes detalles de estilo: </li>
					<li>Tamaño de papel: Hoja tipo A4.</li>
					<li>Márgenes: 3 cm a cada lado.</li>
					<li>Fuente: Arial tamaño 11, empleando énfasis en negrita para títulos y subtítulos.</li>
					<li>Justificación: Todo el texto deberá ser justificado.</li>
					<li>Interlineado: 1,5 líneas</li>
				</ul>
			</p>

			<!--<p><strong>Etapa de Confirmación</strong><br> Los participantes de las ponencias ganadoras deberán confirmar su asistencia al congreso. Ponencia que no sea confirmada antes del viernes 28 de agosto no será tomada en cuenta para el CLEIN Paraguay, de manera que se seleccionarán otras ponencias que llegaron a la etapa anterior (se notificará el lunes 7 de setiembre).</p>

			<p><strong>La Publicación Oficial se realizará el lunes 14 de Setiembre del 2015</strong></p>

			<p><strong>BENEFICIOS PARA LOS PONENTES GANADORES</strong></p>
			<ul>
				<li>Exoneración de la Inscripción al CLEIN Paraguay 2015.</li>
				<li>Certificado de participación como ponente estudiantil del CLEIN Paraguay 2015.</li>
				<li>Premios adicionales.</li>
			</ul>

			<p><strong>JURADO CALIFICADOR</strong><br> El jurado calificador estará compuesto por Prof. Ing. Sebastián Denis, Prof. Dr. Ing. Agustin Mejias y el Prof. Ing. Manuel M. Benitez Codas, a su vez también serán miembros el Prof. Ing. Diógenes Sartorio y el Prof. Ing. Cirilo Hernaez y el Prof. Ingeniero Idelín Molinas, así como también los integrantes de la Comisión Académica, los cuales son estudiantes de la carrera de Ingeniería Industrial representantes de distintas universidades del país y con un grado avanzado de la carrera.</p>

			<p><strong>CRITERIOS DE EVALUACIÓN</strong></p>
			<ul>
				<li><strong>Contenido (50%)</strong>
					<ul>
						<li>Soporte bibliográfico y conceptual (2%)</li>
						<li>Aportes innovadores, útiles y sustentables (20%)</li>
						<li>Impacto integral del tema (7%)</li>
						<li>Correspondencia con alguno de los pilares temáticos del CLEIN Paraguay 2015 (15%)</li>
						<li>Dominio práctico (5%)</li>
					</ul>
				</li>
				<li><strong>Presentación y formato (10%)</strong>
					<ul>
						<li>Ortografía del documento escrito (4%)</li>
						<li>Redacción (4%)</li>
						<li>Formato (2%)</li>
					</ul>
				</li>
				<li><strong>Presentación oral (40%)</strong>
					<ul>
						<li>Cobertura del tema (10%)</li>
						<li>Estilo divulgativo (2%)</li>
						<li>Presentación personal (3%)</li>
						<li>Dominio conceptual (25%)</li>
					</ul>
				</li>
			</ul>-->
			<p>Descargue la base de ponencias haciendo <a href="files/CLEIN 2015 bases de ponencias.pdf">click aquí.</a></p>
		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
