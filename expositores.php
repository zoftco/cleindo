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
		<h1>Expositores</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<h4 class="title txtBold">Expositores Nacionales</h4>
			
			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_solenunez.jpg" class="img_expositor" alt="">
					<h5>Ing. Soledad Núñez</h5>
					<strong>Paraguaya</strong> <br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Egresada de la Facultad de Ingeniería UNA e integrante del cuadro de honor. Tesis con énfasis en vivienda social y entorno urbano. Estudió en la Universidad Politécnica de Madrid un curso de posgrado en Gestión de Proyectos de Construcción.</p>
					<p>Lideró la ONG TECHO Paraguay desde sus comienzos, en el cual ocupó el cargo de Directora Social Nacional durante 5 años. Egresada del curso de Liderazgo para la Competitividad Global de la Escuela de Negocios en la Universidad de Georgetown – Washington. Hoy ocupa el cargo de Ministra Secretaria Ejecutiva de la Secretaría Nacional de la Vivienda y el Hábitat. (SENAVITAT).</p>
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_kelo.jpg" alt="" class="img_expositor">
					<h5>Kelo (Eligio) Kriskovich</h5>
					<strong>Paraguayo</strong> <br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Dirige Jobs, empresa paraguaya experta  en servicios de Recursos Humanos.  Es además representante de la Dirección para la administración de los recursos humanos de Indufar CISA, laboratorio líder de la industria farmacéutica paraguaya.</p>
					<p>A partir de su licenciatura en Análisis de Sistemas y de la maestría en Administración de Empresas ha orientado su investigación y labor profesional hacia el ámbito de la ejecución de la estrategia, el comportamiento organizacional y el desarrollo del capital humano, para optimizar el valor agregado por las personas a las organizaciones y de esta manera contribuir al desarrollo de empresas más competitivas con personas más felices y realizadas.</p>
					<p>Como consultor, él diseña y conduce programas de gestión de la estrategia, de desarrollo de familias empresarias y de capacitación a medida para numerosas empresas de la región.  Ha sido docente en programas de post-grado en universidades locales y en programas de grado tanto en el ámbito de sistemas de información como en el de administración de los recursos humanos.</p>
					
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_idelin.jpg" alt="" class="img_expositor">
					<h5>Ing. Idelin Molinas</h5>
					<strong>Paraguayo</strong> <br>
				<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Ingeniero Civil egresado de la Universidad Nacional de Asunción, Certificado PMP (Project Management Professional) por el PMI y egresado de la Universidad de Iowa como PhD. Civil Engineering – Structures & Project Management.</p>
					<p>Actualmente es Secretario Ejecutivo del Consejo Nacional de Ciencias y Tecnología, Profesor de la Universidad Católica de las Cátedras: Gestión de Calidad, Gestión de Proyectos y Proyecto Final. Miembro del Consejo Directivo del PMI (Project Management Institute) Capítulo Paraguay, Ingeniero de Proyectos en Desarrollo de Axion Energy Paraguay./p>
					
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_fdoduarte.jpg" alt="" class="img_expositor">
					<h5>Fernando Duarte de TECHO Paraguay</h5>
					<strong>Paraguayo</strong> <br>
				</div>
			</div>
			
			<!--ad-->
			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/walter.png" alt="" class="img_expositor">
					<h5>Dr. Walter Bastos</h5>
					<strong>Paraguayo</strong> <br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Master por Camegie University. New York. USA.</p>
					<p>Presidente de Dale Camegie desde 1992. Presidente de W.Bastos. Grupo Empresarial que integran: Ganadera La Iluminada en Caaguazu. Ganadera W en Santiago Misiones. Cadenas de Estaciones de Servicio La Susana. Transportadora TLS. Estudio B Industria Gráfica</p>
					<p>Además es Director estratégico de los siguientes grupos empresariales : Grupo Protek. GMM del grupo Luminotecnia . Grupo Modiga . Grupo Editorial Atlas. Grupo Amiria . BMW ( Perfecta Automotores)  Grupo Coinpa . Unión Global . ( Industria de cosmética marcas New Color , Carey )</p>
				</div>
			</div>


			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/roberto.png" alt="" class="img_expositor">
					<h5>Roberto Urbieta</h5>
					<strong>Paraguayo</strong> <br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Presidente de la Fundación AMCHAM Paraguay, Emprendedor Social, Empresario, Educador, Fundador, Impulsor y activo Miembro del Consejo de diversas Organizaciones de la Sociedad Civil.</p>
					<p>Experiencia en la elaboración de estrategias hacia el crecimiento .Conocido por su empuje activo en el crecimiento de la Educación Emprendedora, no sólo en el Paraguay, sino también en otros países. Su trabajo de promoción de la Semana Mundial del Emprendimiento y la Semana Mundial del Dinero, son relevantes. </p>
					<p>Ha tenido destacada participación en intervenciones internacionales. Con el YABT tiene una estrecha relación desde el año 2004, habiendo actuado como Juez Internacional de la Competencia Talento e Innovación de las Américas (TIC Américas), organizado por el YABT y teniendo las Finales en distintos países de las Américas, en el marco de la Asamblea General de la OEA, y en el 2012 previo a las VI Cumbre de las Américas. </p>
					<p>Egresado de la carrera de Ciencias Contables y Administrativas de la Universidad Católica de Asunción. Realizó cursos de post grado con énfasis en Management en Latinoamérica, Estados Unidos y Japón, actualmente se desempeña como Directivo de la Universidad San Ignacio de Loyola.</p>
				</div>
			</div>




			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/gloria.png" alt="" class="img_expositor">
					<h5>Ing. Gloria Ortega</h5>
					<strong>Paraguaya</strong> <br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Ingeniera Industrial egresada de la Universidad Nacional de Asunción. Con experiencia en las industrias de Telecomunicaciones, Cadena de Abastecimiento, Tarjetas de Crédito, Internet y Tecnologías de la Informacion. Fue Gerente General o Regional de 6 subsidiarias de Millicom International en Latino América y África.</p>
					<p>Lideró y participó en mejoras sustanciales, comerciales y financieras de las operaciones que me toco dirigir. Trabajó en proyectos de transformación del negocio para lograr eficiencias. Condujo proyectos multi nacionales de gran escala en ambientes multi-culturales. </p>
					<p>Logró que mas de 35 paraguayos puedan realizar una exitosa carrera en el exterior de Paraguay llevando las mejores practicas en entornos culturalmente diferentes, con alto éxito comercial y financiero. </p>
				</div>
			</div>




			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/sebas.png" alt="" class="img_expositor">
					<h5>Sebastián Acha</h5>
					<strong>Paraguayo</strong> <br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Abogado egresado de la Universidad Nacional de Asunción.  Electo Diputado Nacional para el periodo 2003-2008 por el entonces Movimiento Patria Querida. Fue el Diputado más joven de este periodo parlamentario y uno de los más jóvenes de la historia del Paraguay. Reelecto Diputado Nacional para el periodo 2008 – 2013 por el Partido Patria Querida.</p>
					<p>Principales Proyectos/ Leyes Impulsados como Legislador:</br>
• Proyecto “Una computadora por Niño”</br>
• Proyecto que crea “Incentivo a vehículos eléctricos”.</br>
• Proyectos a favor de la Juventud y la inversión en la educación y salud.</br>
• Denuncias Penales contra actos de corrupción y deficiencia en la Administración Pública. </br>
• Ley de inserción laboral juvenil.</br>
• Ley de la Capitalidad.</p>
					<p>Fundador de la Organización sin fines de lucro “TIERRA NUEVA” de desarrollo rural.
Profesor Titular de Cátedras de Introducción a la Ciencia Política, Pensamientos Políticos y Sociales y Análisis Político en la Universidad de Integración de las América (UNIDA) – Asunción.</p>
				</div>
			</div>
			
			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_maximiliano_bellassai.png" alt="" class="img_expositor">
					<h5>Maximiliano Bellassai</h5>
					<strong>Paraguayo</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
			
				<div class="info_expositor">
					<p>
						Máster en Administracion de Empresas, Director de la Unidad de Negocios Móviles en Tigo Paraguay.
					</p>
					<p>
						Ha dedicado parte de su carrera a las finanzas y el sector bancario en países como Francia e Italia, en la banca local ha desempeñado el cargo de Gerente de Banca Corporativa de Sudameris Bank. Actualmente se desempeña como Director de la Unidad de Negocios Móviles en Tigo Paraguay, luego de haber pasado por Tigo Colombia, Guatemala, El Salvador y Costa Rica. 
					</p>
					<p>
						Egresado del curso de "Desarrollo del Auténtico Liderazgo" en Harvard Business School de la Hardvard University en Boston, Estados Unidos. Egresado del curso de "Vida Digital de las empresas y las personas"  de la INCAE Business School en  San José, Costa Rica
					</p>
				</div>
			</div>
			<!--ad-->



			<h4 class="title txtBold">Expositores Internacionales</h4>


			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_anibalcofone.jpg" alt="" class="img_expositor">
					<h5>Ing. Anibal Cofone</h5>
					<strong>Argentino</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Ingeniero industrial, graduado en la universidad de buenos aires, realizó dos programas de postgrado en Japón, en 1992 y 2009, en temáticas de diseño industrial y apoyo a pequeñas y medianas empresas, respectivamente, hizo en el año 2002 un máster en ingeniería de la innovación en Italia, en la Universidad de Bologna y completó un doctorado en ingeniería en temáticas de innovación en pequeñas y medianas empresas también en Bologna en 2006.</p>
					<p>Es profesor universitario desde hace 25 años, en temáticas, de diseño e innovación en la UBA y otras universidades, fue director de ingeniería del ITBA-instituto tecnológico de Buenos Aires, trabaja en empresas y con empresas en temáticas de ingeniería industrial desde hace 25 años.</p>
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_marjorie.jpg" alt="" class="img_expositor">
					<h5>Ing. Marjorie Liz Morales Casetti</h5>
					<strong>Chilena</strong><br>
					<a href="javascript:void(0);">Ver más</a>					
				</div>
				<div class="info_expositor">
					<p>Ingeniera Civil Industrial mención Informática de la Universidad de La Frontera, Chile. Diplomado de Postítulo en Herramientas Cuantitativas de Planificación y Gestión Estratégica de la Universidad de Valparaíso, Chile.</p>
					<p>Experiencia laboral en docencia, control de gestión, análisis y rediseño de procesos, diseño de sistemas de información, presupuestos, seguimiento de inversión y control de riesgos. Competencias para el diseño, gestión, coordinación y ejecución de proyectos sociales e investigativos.</p>
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_marta.jpg" alt="" class="img_expositor">
					<h5>Ing. Martha Teresa Ramírez Valdivia</h5>
					<strong>Nicaragüense</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Doctor en Ciencias de la Ingeniería: Pontificia Universidad Católica de Chile (2010). Santiago, Chile. Becario CONICYT. Ingeniero Industrial: Universidad Nacional de Ingeniería (1992). Managua, Nicaragua. Certified Lean Six Sigma Green Belt – Institute of Industrial Engineers (2013), Atlanta, GA, USA. Profesor del Departamento de Ingeniería de Sistemas: Universidad de La Frontera, Temuco, Chile</p>
					<p>Directora Programa Magíster en Sistemas de Gestión Integral de la Calidad: Universidad de La Frontera, Temuco, Chile Ayudante curso Logística (Supply Chain Management) y Eficacia Operacional, Diplomado La Clase Ejecutiva (2008-2009); Ingeniero de proyectos, GEPUC (2006-2008): Pontificia Universidad Católica de Chile, Santiago de Chile.</p>
					<p>Consultoría: Movistar, Temuco, Chile (2014); Rosen S.A.I.C. (2014), Temuco, Chile; Casagrande, S.A., Temuco, (2001-2002); Enterprise Systems Center, Lehigh University, Pennsylvania, Estados Unidos (1998-2001); Programa Bolívar de Formación de Emprendedores, Managua, Nicaragua (1996-1997); Programa de Apoyo a la Microempresa, Managua, Nicaragua (1996-1997); Banco Centroamericano de Integración Económica/Ministerio de Economía y Desarrollo, Managua, Nicaragua (1993).</p>
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_nicolasgarcia.jpg" alt="" class="img_expositor">
					<h5>Nicolás García Mayor</h5>
					<strong>Argentino</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Diseñador industrial argentino, ha enfocado sus desarrollos a la ayuda humanitaria y la preservación del medio ambiente, resaltando la función y la estética orgánica en cada proyecto. En la actualidad sus diseños recorren y se exponen en distintas partes del mundo. Entre otros premios, <strong>ha sido reconocido por la JCI TOYP como uno de los Diez Jóvenes Sobresalientes del Mundo 2014 por su contribución a la Niñez, la Paz Mundial y los Derechos Humanos.</strong></p>
				</div>
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_pablomoscoso.jpg" alt="" class="img_expositor">
					<h5>Ing. Pablo Moscoso Roure (Taller)</h5>
					<strong>Chileno</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
				<div class="info_expositor">
					<p>Magister Innovación Tecnológica y Emprendimiento e Ingeniero Civil Industrial, Mención Proyectos ambos grados obtenidos en la Universidad Técnica Federico Santa María. Caracterizado por su liderazgo, creatividad, innovación, proactividad, capacidad de adaptación, compromiso con las tareas emprendidas, poseer excelentes relaciones interpersonales y dominio de idiomas. Actualmente se desarrolla como expositor en temas de Emprendimiento e Innovación y al desarrollo de Emprendimientos de índole personal.</p>
					<p>Profesor Curso MODELOS DE NEGOCIOS para ejecutivos 2014. Universidad Privada de Santa Cruz. BOLIVIA- SANTA CRUZ <br>
					Consultor Asociado en Indago – Soluciones de Ingeniería (www.indagoconsultora.com) 2014 <br>
					Profesor Part Time de Curso Introducción Ingeniería Civil Industrial USM 2012 <br>
					Profesor Part Time de Curso Introducción Ingeniería Comercial USM 2010-2011 <br>
					Profesor Part Time de Consultor Pyme USM 2010-2012 <br>
					Dueño Fundador Empresa Alto Piacere y Rolling Chef 2013 a la fecha Empresas Gastronómica – Valparaíso. Creación de 2 Empresas ligadas al rubro gastronómico y que actualmente operar en ConCon - Chile. <br>
					Dueño Fundador Empresa Met Pizza 2011 - 2014 <br>
					Universidad Técnica Federico Santa María 2009 a 2012 Departamento de Industrias (Escuela de Negocios) Sub Director de Comunicaciones.</p>
				</div>
			
			</div>

			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/exp_gustavotapia.jpg" alt="" class="img_expositor">
					<h5>Ing. Gustavo Adolfo Plaza Tapia</h5>
					<strong>Ecuatoriano</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
			
				<div class="info_expositor">
					<p>Ing. Industrial Ecuatoriano, máster en prevención de riesgos laborales, realizó cursos de auditoría de la ISO 9001, IRCA 14001, SART - IESS,   y sistemas de gestión integrados. Actualmente se desempeña como auditor de Sistema de Gestión Integrado en la CORPORACION ECUATORIANA DE ALUMINIO y como docente en la UNIVERSIDAD TÉCNICA DE COTOPAXI.</p>
				</div>
			</div>



			<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/alejandro.png" alt="" class="img_expositor">
					<h5>Alejandro Conti</h5>
					<strong>Argentino</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
			
				<div class="info_expositor">
					<p>Ingeniero Industrial de profesión por el ITBA de Buenos Aires, Argentina con Máster en Negocios y Economía del ESEADE, con extensa y fructífera carrera en el mundo corporativo. 28 años de trabajo en una de las compañías más grandes del mundo como es EXXON MOBIL, ha liderado el crecimiento interno y externo de las afiliadas en Argentina, Honduras y Paraguay, a través de su liderazgo y excelentes capacidades gerenciales y directivas. </p>
				<p>Ha gestionado exitosamente las estrategias de expansión local e internacional (Paraguay, Uruguay y Brasil) del Grupo Vierci para su franquicia Burger King. Logró la instalación de Dómino's Pizza para Paraguay y consiguió la Master Franquicia para Uruguay.</p>
<p>Desarrolló actividades sociales fundando y presidiendo la Fundación Operación Sonrisa en Paraguay en el año 2005. Ex Director del Colegio Americano (ASA) por 6 años y fuertemente involucrado en Junior Achievement durante similar periodo.</p>
<p>Siempre muy relacionado con la comunidad americana a través de Exxonmobil y como Director y Presidente de la Cámara Paraguaya Americana. Actualmente Director del grupo BICOLOR SA  operando con la licencia de franquicias en Paraguay de TGI Friday´s , Freddo y La Guitarrita.   </p>
				</div>
			</div>



	<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/marc.png" alt="" class="img_expositor">
					<h5>Marc Kirst</h5>
					<strong>Brasilero</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
			
				<div class="info_expositor">
					<p>Emprendedor social, fundador del instituto Prove dió charlas en Brasil, EE.UU, Portugal y Angola y también en dos ediciones de TEDx en Brasil. Sobre su trayectoria:
Fue estudiante de Administración en la UFSCar Sorocaba, donde asumió posiciones de liderazgo en organizaciones universitárias como Empresa Jr., AIESEC y diversos eventos. Decidió hacer una pausa en sus estudios para trabajar con una Startup de Impacto Social. Fundo Prove - Programa Visión Emprendedora -  con el propósito de despertar el potencial en protagonista y transformador en jóvenes universitários y que estén en el bachillerato. Participo de una competecencia internacional de liderazgo "Your Big Year", llegando al puesto de vice-campeón en la fase final en San Francisco - EE.UU, después de 6 meses entre más de 60 mil jóvenes del mundo entero. Actualmente, trabaja a tiempo completo para expandir y fortalecer el Prove como un movimiento catalizador de transformación personal en el Brasil y en el mundo. </p>
				</div>
			</div>



<div class="perfil_expositor">
				<div class="datos_expositor">
					<img src="images/edu.png" alt="" class="img_expositor">
					<h5>Eduardo Migliano</h5>
					<strong>Brasilero</strong><br>
					<a href="javascript:void(0);">Ver más</a>
				</div>
			
				<div class="info_expositor">
					<p>Fundadores de 99 Jobs, una comunidad colaborativa online de reclutamiento y selección que tiene como objetivo rediseñar la forma en cómo las organizaciones y personas se conectan, con base en sus creencias y valores. Ellos sueñan con un mundo en que cada vez más personas, puedan hacer lo que ellas aman. </p>
<p>Son  la cuarta empresa en el mundo de RRHH que utiliza el método company description en vez de job description; tienen programas como workshops, innovation labs, speed dating con empresas, summer jobs, company rotation y muchas otras actividades.</p>
				</div>
			</div>




		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
