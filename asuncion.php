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
		<h1>Asunción</h1>
	</div>
</section>



<section id="main">
	<div class="container">
		<article>
			<h4 class="title">Asunción, Capital verde de Iberoamérica</h4>
			<p class="txtC"><img src="images/asuncion.jpg" alt=""></p>
			
			<p>Asunción fue declarada por unanimidad Capital Verde de Iberoamérica 2015, en el marco de la realización de la XVI Asamblea Plenaria de la Unión de Ciudades Capitales Iberoamericanas (UCCI), que se realizó del 25 al 26 de setiembre, en la ciudad de Buenos Aires – Argentina. </p>

			<p>Entre las razones que sustentaron la obtención del título está la <strong>superficie total de áreas verdes</strong> que posee, de <strong>23.396.490,62 m2</strong>, lo cual hace que se tenga <strong>45,38 m2 de áreas verdes públicas</strong> y privadas por habitante y donde solamente <strong>el área verde pública por habitante es de 26,03 m2.</strong></p>
			<div class="clearfix"></div>
			<p class="fotos_2"><img src="images/asuncion2.jpg" alt=""><img src="images/asuncion3.jpg" alt=""></p>

			<p>Fundada en 1537, a la orilla del Río Paraguay, en la Bahía, Asunción es la Capital de Paraguay. La ciudad tiene un poco más de 500.000 habitantes, aunque con las ciudades periféricas que componen el Gran Asunción supera el millón de habitantes.</p>

			<p>Asunción es hoy una ciudad acogedora, coloreada en primavera con flores de lapacho y jacarandá, con alguna nostalgia y sus amplias avenidas. Asunción, está asentada sobre un terreno ondulado identificado por sus <strong>“siete colinas”</strong> que de alguna manera imponen las diferencias entre sus distintos barrios. Su altura sobre el nivel del mar no va más de los 120 metros y su superficie abarca 117 km2 </p>
	
			<h4 class="title">Asunción, Sede de eventos Internacionales</h4>
			<p class="txtC"><img src="images/bourbon.jpg" alt=""></p>
			<p><strong>Centro de Convenciones del Hotel Bourbon / Conmebol</strong></p>

			<p>Moderno Centro de Convenciones para 3.000 personas, con un salón principal de 2.000 m2, un foyer de 1.200 m2, un salón adicional de 400 m2, y un estacionamiento para 600 vehículos. En el interior también se encuentra el Museo del Futbol Sudamericano, con las copas tan codiciadas.</p>

			<p>Asunción cuenta con unas 2.500 habitaciones en hoteles de 4 y 5 estrellas, entre los cuales hoteles nacionales y hoteles de cadenas internacionales, con salones con capacidad de 20 a 1.200 personas.</p>

			<p class="txtC"><img src="images/bourbon2.jpg" alt=""></p>
	
			<h4 class="title">Vida Nocturna y Gastronomía</h4>
			<p>La gastronomía paraguaya ofrece un sinnúmero de exquisitos platos y deliciosos postres. La comida típica es preparada con productos frescos y naturales, ya que es costumbre consumir lo que se cosecha en el día. La carne junto con los platos “subtropicales” son los más comunes. En Paraguay encontrará excelentes platos preparados a base de maíz y mandioca. Además existe una gran diversidad de frutas gran parte del año.</p>
			
			<p class="txtC"><img src="images/gastronomia.jpg" alt=""></p>


			<p> <img src="images/terere.jpg" class="imgLeft" alt=""> El consumo de la ilex paraguayensis o yerba mate es una de las mayores tradiciones del Paraguay, ya que con esta yerba se prepara <strong>el Tereré</strong>, bebida refrescante elaborada con hierbas medicinales y agua fría, que se consume en grandes cantidades.</p>
			<div class="clearfix"></div>
			<p class="fotos_2"><img src="images/vida_nocturna.jpg" alt=""><img src="images/vida_nocturna2.jpg" alt=""></p>
			
			<p>Como en las principales capitales del mundo, la actividad nocturna en Asunción presenta una interesante variedad de opciones: pubs, bares, discotecas, restaurantes, lounges, cafeterías, cines, teatros y conciertos. Se pueden identificar dos zonas en la ciudad donde se concentra la escena nocturna: La zona del centro histórico y el puerto de la ciudad, característica por sus cafés, bares, pubs, karaokes y choperías. Al otro lado de la ciudad la exclusiva zona de Villa Morra y la zona de Carmelitas alberga las mejores discotecas, lounges y restaurantes. </p>

			<h4 class="title">Clima e Informaciones Útiles</h4>
 
			<table class="txtC">
				<thead>
					<tr>
						<th></th>
						<th>Ene</th>
						<th>Feb</th>
						<th>Mar</th>
						<th>Abr</th>
						<th>May</th>
						<th>Jun</th>
						<th>Jul</th>
						<th>Ago</th>
						<th>Sep</th>
						<th>Oct</th>
						<th>Nov</th>
						<th>Dic</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Temp. Media</td>
						<td>27</td>
						<td>26</td>
						<td>25</td>
						<td>22</td>
						<td>19</td>
						<td>17</td>
						<td>17</td>
						<td>20</td>
						<td>21</td>
						<td>23</td>
						<td>25</td>
						<td>26</td>
					</tr>
					<tr>
						<td>Temp. Máxima Media</td>
						<td>34</td>
						<td>32</td>
						<td>31</td>
						<td>29</td>
						<td>25</td>
						<td>23</td>
						<td>25</td>
						<td>27</td>
						<td>28</td>
						<td>30</td>
						<td>31</td>
						<td>33</td>
					</tr>
					<tr>
						<td>Temp. Mínima Media</td>
						<td>22</td>
						<td>22</td>
						<td>20</td>
						<td>18</td>
						<td>15</td>
						<td>13</td>
						<td>12</td>
						<td>15</td>
						<td>16</td>
						<td>18</td>
						<td>20</td>
						<td>21</td>
					</tr>
					<tr>
						<td>Prom. Dias de Precip.</td>
						<td>6</td>
						<td>7</td>
						<td>6</td>
						<td>6</td>
						<td>5</td>
						<td>6</td>
						<td>4</td>
						<td>4</td>
						<td>5</td>
						<td>6</td>
						<td>6</td>
						<td>5</td>
					</tr>
					<tr>
						<td>Prom. de Dias Nieve</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
				</tbody>
			</table>

			<p><strong>Tasa de embarque en Aeropuerto:</strong> 41 USD (dólares americanos) <br>
			<strong>Agua para tomar:</strong> El agua corriente es potable <br>
			<strong>Electricidad:</strong> 220 Voltios y 50 Ciclos</p>

			<p><strong>Feriados Oficiales: </strong>1º de Enero - Año Nuevo, 1º de Marzo - Día de los Héroes, Jueves y Viernes Santos , 1º de Mayo - Día del Trabajador, 15 de Mayo - Independencia Nacional , 12 de Junio - Paz del Chaco, 15 de Agosto - Fundación de Asunción, 8 de Diciembre - Virgen de Caacupé, 25 de Diciembre - Navidad. </p> 
			
			<h4 class="title">Centro de Asunción, Casco histórico</h4>
			<p class="txtC"><img src="images/asuncion_centro.jpg" alt=""></p>


		</article>

		<!-- Sidebar -->
		<?php include 'inc/sidebar.php'; ?>
		<div class="clearfix"></div>		
	</div>
</section>

<?php include 'inc/footer.php'; ?>
