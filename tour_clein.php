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
		<h1>Pre y Post Congreso</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<h4 class="title">Tour Clein 2015</h4>

			<p class="txtC"><img src="images/tour_asuncion.jpg" class="noshadow" alt=""></p>
			<h5 class="title txtBold">Asunción - City Tour Panorámico (Duración 3 horas)</h5>
			<p>Partida desde el hotel para realizar un completo recorrido por la ciudad de ASUNCIÓN, ciudad con una pintoresca combinación de arquitectura moderna y colonial, incluyendo el centro histórico de la ciudad visitando La Casa de la Independencia, La Catedral, el Palacio de Gobierno, El Panteón Nacional de Los Héroes donde yacen los restos de los máximos héroes de nuestra historia, continuando por las áreas residenciales, la Avenida Mariscal López, también conocida como la Avenida de las embajadas, y terminando en el popular mercado artesanal La Recova.</p>

			
			<table class="txtC">
				<caption>Precios por persona en USD</caption>
				<thead>
					<tr>
						<th>Base 2 paxs</th>
						<th>Base 3 paxs</th>
						<th>Base 4 a 6 paxs</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>32,00</td>
						<td>27,00</td>
						<td>22,00</td>
					</tr>
				</tbody>
			</table>			
		
			<p class="txtC"><img src="images/tour_artesanal.jpg" class="noshadow" alt=""></p>
			<h5 class="title txtBold">Pueblos Artesanales & Lago Ypacaraí (Duración 5 horas)</h5>
			<p>Salida temprano de Asunción, a la ida visitaremos al pueblo artesanal de Luque con sus rústicas fábricas de arpas y guitarras hechas a mano, así como joyas en oro y plata hechas en tallado filigrana. Seguidamente continuaremos la visita a la ciudad artesanal de Aregua, antiguo pueblo de veraneo que todavía mantiene su sabor del principio del siglo XX. Alfarerías y centros artesanales exhiben sus obras todo el año.</p>

			<p>Posteriormente seguiremos a San Bernardino, ubicado a orillas del Lago Ypacaraí, actual centro de veraneo. Almuerzo en restaurante de la ciudad.</p>

			<p>Posteriormente visitaremos la ciudad de Itauguá, hogar del famoso Ñandutí (tela de la araña en idioma guaraní) encaje hecho a mano cuyo diseño está basado en las telas de las arañas, el excursionista puede adquirir artesanías como manteles, individuales, hamacas, cubrecamas etc. Regreso a Asunción al atardecer.</p>

			
			<table class="txtC">
				<caption>Precios por persona en USD</caption>
				<thead>
					<tr>
						<th>Base 2 paxs</th>
						<th>Base 3 paxs</th>
						<th>Base 4 a 6 paxs</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>47,00</td>
						<td>37,00</td>
						<td>32,00</td>
					</tr>
				</tbody>
			</table>
		
			<p class="txtC"><img src="images/tour_circuitodeoro.jpg" class="noshadow" alt=""></p>
			<h5 class="title txtBold">Circuito de Oro (Duración 7 horas)</h5>
			<p>La combinación de la artesanía, la cultura, la historia y la naturaleza, harán de esta excursión una experiencia inolvidable y placentera.</p>

			<p>En nuestro recorrido visitaremos la ciudad artesanal de Itá, tradicionalmente conocida por la fabricación de la "Gallinita de la suerte", posteriormente visita a la iglesia de Yaguarón, templo franciscano del siglo XVIII, continuación hacia las sierras de Paraguarí. Visita a la ciudad histórica de Piribebuy, continuación hacia la Basílica de Caacupé, donde se encuentra la Catedral de la Santa Patrona de todos los Paraguayos la Virgen de Caacupé.</p>

			<p>Posterior llegada a San Bernardino, principal centro de veraneo del país, ubicado junto al famoso "Lago Ypacaraí". Almuerzo incluido.</p>

			<p>Por la tarde regreso a Asunción, visitando la ciudad de Itauguá, famosa por su artesanía en tejidos donde se destaca la imitación de la tela de araña (ñanduti). Regreso a Asunción.</p>

			
			<table class="txtC">
				<caption>Precios por persona en USD</caption>
				<thead>
					<tr>
						<th>Base 2 paxs</th>
						<th>Base 3 paxs</th>
						<th>Base 4 a 6 paxs</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>87,00</td>
						<td>77,00</td>
						<td>62,00</td>
					</tr>
				</tbody>
			</table>
		
			<p class="txtC"><img src="images/tour_jesuiticas.jpg" class="noshadow" alt=""></p>
			<h5 class="title txtBold">Misiones Jesuíticas (Tour de 1 día) Servicio Regular</h5>
			<p>Salida desde su hotel, para trasladarse a la terminal de buses y embarcar un bus con destino a la ciudad de Encarnación. Incluye los pasajes en bus regular Asunción /Encarnación /Asunción (ida y vuelta).</p>

			<p>Llegada en la ciudad de Encarnación para continuar el viaje en vehículo privado hasta llegar a las ruinas de las reducciones jesuíticas de Santísima Trinidad (acceso incluido), donde tendremos la oportunidad de recorrer los vestigios que quedaron de lo que fuera la gran campaña evangelizadora de los padres Jesuitas. Trinidad, que data del año 1706, fue declarada patrimonio histórico de la humanidad por la Unesco.</p>

			<p>Al finalizar esta visita, traslado de retorno a Encarnación para tomar el bus de línea retornando hacia la capital, Asunción. Llegada a la terminal de buses y traslado a su hotel en Asunción.</p>

			<p><strong>Observación:</strong> Este paquete debe salir con el bus a las 07:30 hs y debe regresar con el bus saliendo a las 18:00 hs de Encarnación el mismo día. Es obligatorio para el cumplimiento del programa. No incluye servicio de alimentación.</p>

			
			<table class="txtC">
				<caption>Precios por persona en USD</caption>
				<thead>
					<tr>
						<th>Base 2 paxs</th>
						<th>Base 3 paxs</th>
						<th>Base 4 a 6 paxs</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>150,00</td>
						<td>130,00</td>
						<td>120,00</td>
					</tr>
				</tbody>
			</table>
		
			<p class="txtC"><img src="images/tour_cataratas.jpg" class="noshadow" alt=""></p>
			<h5 class="title txtBold">Cataratas del Iguazú lado Brasilero y Represa de Itaipu desde Asunción (Tour de 1 día) Servicio Regular</h5>
			<p>Salida desde su hotel en Asunción, en vehículo tipo van con aire acondicionado, para trasladarse a la terminal de buses y tomar un bus con destino a Ciudad del Este. Llegada, desayuno a su llegada (no incluido) y posteriormente visita a la Represa de Itaipú (Lado paraguayo). Luego de esta visita, nos trasladaremos a la ciudad de Foz de Iguazú, tiempo libre para almorzar (no incluido) y seguidamente visitaremos las Cataratas del Iguazú -lado brasilero (no incluye entrada al parque nacional) donde disfrutaremos de las majestuosas caídas de agua considerada una de las maravillas naturales de la región Sur de América. Finalizado el tour, salida a las 18h30 de retorno por bus de línea regular con destino a Asunción. Llegada, y traslado a su hotel.</p>

			<p><strong>Observación:</strong> Este paquete debe salir con el bus a las 01:30 hs y debe regresar con el bus saliendo a las 18:30 en el mismo día. Es obligatorio para el cumplimiento del programa. No incluye servicio de alimentación ni entrada al Parque Nacional de Cataratas.</p>

			
			<table class="txtC">
				<caption>Precios por persona en USD</caption>
				<thead>
					<tr>
						<th>Base 2 paxs</th>
						<th>Base 3 paxs</th>
						<th>Base 4 a 6 paxs</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>160,00</td>
						<td>140,00</td>
						<td>130,00</td>
					</tr>
				</tbody>
			</table>
			<p>*Consultar por tarifas para grupo de personas, mayores a la cantidad indicada.</p>


			<h5 class="title txtBold">Cataratas del Iguazú lado Brasilero desde Itaipú - Servicio Regular</h5>
			<p>Recogida desde de Itaipú (Lado paraguayo) donde nos trasladaremos a la ciudad de Foz de Iguazú, tiempo libre para almorzar (no incluido) y seguidamente visitaremos las Cataratas del Iguazú -lado brasilero (no incluye entrada al parque nacional) donde disfrutaremos de las majestuosas caídas de agua considerada una de las maravillas naturales de la región Sur de América. Finalizado el tour, salida a las 18h30 de retorno por bus de línea regular con destino a Asunción. Llegada, y traslado a su hotel.</p>

			<p><strong>Observación:</strong> Se debe regresar con el bus saliendo a las 18:30. Es obligatorio para el cumplimiento del programa. No incluye servicio de alimentación ni entrada al Parque Nacional de Cataratas.</p>

			
			<table class="txtC">
				<caption>Precios por persona en USD</caption>
				<thead>
					<tr>
						<th>Base 2 paxs</th>
						<th>Base 3 paxs</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>103,00</td>
						<td>79,00</td>
					</tr>
				</tbody>
			</table>

			<p>*Consultar por tarifas para grupo de personas, mayores a la cantidad indicada.</p>



			<h5 class="title txtBold">Cataratas del Iguazú lado Brasilero desde Itaipú (1 noche de hotel) Servicio Regular</h5>
			<p>Recogida desde de Itaipú (Lado paraguayo) donde nos trasladaremos a la ciudad de Foz de Iguazú, para trasladarnos al hotel de su elección, tarde libre. Al día siguiente visitaremos las Cataratas del Iguazú -lado brasilero (no incluye entrada al parque nacional) donde disfrutaremos de las majestuosas caídas de agua considerada una de las maravillas naturales de la región Sur de América. Finalizado el tour, tiempo libre para almorzar (no incluido) salida a las 16:00 hs de retorno por bus de línea regular con destino a Asunción. Llegada, y traslado a su hotel.</p>

			<p><strong>Observación:</strong> Se debe regresar con el bus saliendo a las 16:00 hs. Es obligatorio para el cumplimiento del programa. No incluye servicio de alimentación ni entrada al Parque Nacional de Cataratas.</p>

			
			<table class="txtC">
				<caption>Precios por persona en USD</caption>
				<thead>
					<tr>
						<th>Hotel</th>
						<th>Categoría</th>
						<th>Habilitación</th>
						<th>Doble</th>
						<th>Triple</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Carima 3*</td>
						<td>Turista</td>
						<td>Estándar</td>
						<td>222</td>
						<td>160</td>
					</tr>
					<tr>
						<td>Panorama 3*</td>
						<td>Turista</td>
						<td>Estándar</td>
						<td>219</td>
						<td>158</td>
					</tr>
				</tbody>
			</table>


			<h4 class="title">Pasos para la reserva</h4>

			<p><strong>PASO 1:</strong> Llene el formulario de la tarjeta Tour Aleiiaf 2015, descárguela haciendo <a href="files/form_tarjeta_tour_aleiiaf_2015.doc">click aquí</a> y enviar por email a <a href="mailto:incoming@martintravel.com.py">incoming@martintravel.com.py</a></p>
			<p>El formulario debe estar completo en todos los campos para proceder con la reserva.</p>




		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
