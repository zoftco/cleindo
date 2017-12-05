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
		<h1>Hospedaje</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<h4 class="title">Hotel Excelsior - Ubicación Céntrica Estratégica</h4>
			<p class="txtC"><img src="images/logo_excelsior.jpg" class="noshadow" alt=""></p>
			
			<p>El Hotel Excelsior esta estratégicamente ubicado en el centro de la ciudad de Asunción, frente al Shopping Mall Excelsior, y a proximidad del las principales calles comerciales de la Capital Paraguaya.</p>

			<p class="fotos_2"><img src="images/hospedaje.jpg" alt=""><img src="images/hospedaje2.jpg" alt=""></p>

			<h5>Salones y comodidades del Hotel Excelsior</h5>

			<p>El hotel Excelsior posee 12 lujosos salones con diferentes niveles de capacidad, ambientados para congresos y eventos sociales, con 3.500 m2 de salones para y una capacidad de hasta 3.700 personas equipados con tecnología de última generación (audio, video, iluminación). Eventos hechos a la medida del cliente hacen que estos sean únicos y memorables. El staff entrenado para satisfacer las necesidades del cliente avala con su experiencia el éxito de los eventos. En formato auditorio el Salón Teatro del Hotel Excelsior tiene una capacidad de hasta 700 personas.</p>

			<h5>Habitaciones</h5>
			
			<table class="bordernone">
				<tbody>
					<tr>
						<td style="width:40%"><img src="images/habitaciones.jpg" class="imgRight" alt=""></td>
						<td>Habitaciones de 35 mt2 con dos camas queen (1.40 mts x 2 mts), vista a la calle, baños con ducha o bañera, secador de pelo, aire acondicionado calefacción, TV LCD 29” TV Cable, frigobar, conexión a WI-FI sin cargo, placard, caja de seguridad.</td>
					</tr>
				</tbody>
			</table>

			<table>
				<thead class="txtC">
					<tr>
						<th>Habitación Tipo</th>
						<th>Cantidad PAX Hab</th>
						<th>Tarifa por Persona USD</th>
						<th>Total Habitación USD</th>
						<th>Base</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Habitaciones 2 Camas Queen uso cuádruple</td>
						<td>4</td>
						<td>35</td>
						<td>140</td>
						<td>4</td>
					</tr>
					<tr>
						<td>Habitaciones 2 Camas Queen + Sofá uso quíntuple</td>
						<td>5</td>
						<td>35</td>
						<td>175</td>
						<td>5</td>
					</tr>
					<tr>
						<td>Habitaciones Standard 1 Cama Queen uso single (disertantes)</td>
						<td>1</td>
						<td>90</td>
						<td>90</td>
						<td>1</td>
					</tr>
					<tr>
						<td>Habitaciones 2 Camas Queen uso doble</td>
						<td>2</td>
						<td>57.50</td>
						<td>115</td>
						<td>2</td>
					</tr>
					<tr>
						<td>Habitaciones 1 Cama king uso single o doble (disertantes)</td>
						<td>2</td>
						<td>62.50</td>
						<td>125</td>
						<td>2</td>
					</tr>
				</tbody>
			</table>

			<p class="fotos_2"><img src="images/hospedaje3.jpg" alt=""><img src="images/hospedaje4.jpg" alt=""></p>

			<h4 class="title">Hoteles Alternativos</h4>


			<table class="bordernone">
				<tbody>
					<tr>
						<td><img src="images/hotel_margaritas.jpg" alt=""></td>
						<td><h5>Hotel Las Margaritas</h5>
							<div class="stars cuatro">4 estrellas</div>
							<p>Situado en plena calle céntrica de la ciudad de Asunción, en la cercanía inmediata de los edificios históricos, el Hotel Las Margaritas cuenta con <strong>60 habitaciones</strong> decoradas con un estilo único.</p>
							<!--<p>Mas detalles: <a href="http://www.lasmargaritas.com.py/" target="_blank">Sitio Web</a></p>-->
						</td>
					</tr>
					<tr>						
						<td colspan="2">
							<table>
								<thead class="txtC">
									<tr>
										<th>Habitación Tipo</th>
										<th>Cantidad PAX Hab</th>
										<th>Tarifa por Persona USD</th>
										<th>Total Habitación USD</th>
										<th>Base</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Habitaciones 2 Camas uso cuádruple</td>
										<td>4</td>
										<td>32</td>
										<td>128</td>
										<td>4</td>
									</tr>
									<tr>
										<td>Habitaciones 2 Twin + cama adicional</td>
										<td>3</td>
										<td>39</td>
										<td>96</td>
										<td>3</td>
									</tr>
									<tr>
										<td>Habitaciones standard dos camas twin</td>
										<td>2</td>
										<td>50</td>
										<td>100</td>
										<td>2</td>
									</tr>
								</tbody>
							</table>							

						</td>
					</tr>
					
					<tr>
						<td><img src="images/hotel_internacional.jpg" alt=""></td>
						<td><h5>Hotel Internacional</h5>
							<div class="stars cuatro">4 estrellas</div>							
							<!--<p>Ayolas 520, Asunción - Paraguay <br></p>-->
						<!--	<p>Mas detalles: <a href="http://www.hotelinternacional.com.py/" target="_blank">Sitio Web</a> - Teléf: 021 494-114</p>-->
						</td>
					</tr>
					<tr>						
						<td colspan="2">
							<table>
								<thead class="txtC">
									<tr>
										<th>Habitación Tipo</th>
										<th>Cantidad PAX Hab</th>
										<th>Tarifa por Persona USD</th>
										<th>Total Habitación USD</th>
										<th>Base</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Habitaciones quíntuples (2 camas matrimoniales + camas adicional o similar)</td>
										<td>5</td>
										<td>15</td>
										<td>75</td>
										<td>1</td>
									</tr>
									<tr>
										<td>Habitaciones cuadruples (1 cama matrimonial + camas adicionales o similar) </td>
										<td>4</td>
										<td>40</td>
										<td>160</td>
										<td>2</td>
									</tr>
								</tbody>
							</table>

							<p>* Tarifa por persona, 30 USD</p>
							<p>Tener en cuenta que el hotel acomoda a los participantes según demanda, es decir, primero las habitaciones triples, dobles y las últimas son las singles.</p>						
						</td>
					</tr>
<tr>
						<td><img src="images/hotel_chaco.jpg" alt=""></td>
						<td><h5>Hotel Chaco</h5>
							<div class="stars tres">3 estrellas</div>							
							<p>El Hotel Chaco esta situado en el pleno centro de la ciudad de Asunción. Posee <strong>70 habitaciones</strong>, sonorizadas con ventanas dobles, frigobar, Tv por cable, WIFI, finamente decoradas al más puro estilo inglés.</p>
					<!--		<p>Mas detalles: <a href="http://www.booking.com/hotel/py/chaco.es.html" target="_blank">Sitio Web</a></p>-->

						</td>
					</tr>
					<tr>						
						<td colspan="2">
							<table>
								<thead class="txtC">
									<tr>
										<th>Habitación Tipo</th>
										<th>Cantidad PAX Hab</th>
										<th>Tarifa por Persona USD</th>
										<th>Total Habitación USD</th>
										<th>Base</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Habitaciones singles una cama</td>
										<td>4</td>
										<td>12</td>
										<td>48</td>
										<td>1</td>
									</tr>
									<tr>
										<td>Habitaciones dobles dos camas</td>
										<td>5</td>
										<td>46</td>
										<td>230</td>
										<td>2</td>
									</tr>
									<tr>
										<td>Habitaciones dobles, una cama matrimonial</td>
										<td>1</td>
										<td>32</td>
										<td>32</td>
										<td>2</td>
									</tr>
									<tr>
										<td>Habitaciones triples, 2 camas twin + 1 adicional</td>
										<td>2</td>
										<td>51</td>
										<td>102</td>
										<td>3</td>
									</tr>
								</tbody>
							</table>

							<p>* Tarifa por persona, 27 USD</p>
							<p>Tener en cuenta que el hotel acomoda a los participantes según demanda, es decir, primero las habitaciones triples, dobles y las últimas son las singles.</p>						
						</td>
					</tr>
					<tr>
						<td><img src="images/hotel_urbanian.jpg" alt=""></td>
						<td><h5>Hotel Urbanian</h5>
							<p>Este Hostal esta ubicado en el centro de Asunción. Todas las habitaciones son compartidas y muy confortables, con cortinas que dan privacidad, luces individuales. además de casilleros individuales, aire condicionado, calefacción y wifi. Especial para grupos de estudiantes. <br> Tarifa en habitación de 4 a 8 personas:
								<br><br>
								<strong>Tarifa Individual por noche:</strong> USD 15
							</p>
							<!--<p>Reservar habitaciones: <a href="mailto:info@urbanianhostel.com">Correo electrónico</a> - Teléf: 021 441-209</p>-->

						</td>
					</tr>
				</tbody>
			</table>

			<h4 class="title">Pasos para la reserva</h4>

			<p><strong>PASO 1:</strong> Llene el formulario de garantía de reserva, descárguelas haciendo <a href="files/formulario tarjeta garantia hotel.doc">click aquí</a> <br>Para reservas solo debe elegir el método de reserva si abona la totalidad o la primera noche en tarjeta de crédito y enviar por email a <a href="mailto:incoming@martintravel.com.py">incoming@martintravel.com.py</a></p>
			<p>El formulario de garantía debe estar completo en todos los campos para proceder con la reserva.</p>

			<img src="images/LOGO MARTIN TRAVEL ALTA_500 copia.jpeg" style = "width:200px">
			<p>Ante cualquier duda que tenga referente al su viaje 
se puede comunicar a Martin Travel
Mail: incoming@martintravel.com.py
Web: www.martintravel.com.py
Tel: +59521211747</p>

		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
