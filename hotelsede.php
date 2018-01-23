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
<div class="container-fluid">
    <img src="img/HOTEL-SEDE.jpg" alt="Día 1: Integración" width="100%">
</div>

<section id="main">
	<div class="container">
    <p>Barceló Santo Domingo</p>
    <p>Lujo urbano para viajes de placer o negocios, en el corazón de Santo Domingo</p>
    <p>El Barceló Santo Domingo es un elegante hotel de vanguardia concebido con todo lujo de detalles para garantizar que los huéspedes disfruten de una experiencia inolvidable. Las 216 habitaciones han sido equipadas bajo los criterios de los más altos estándares para asegurar a los huéspedes un agradable descanso. La oferta gastronómica, de reconocimiento internacional, tiene como protagonista el afamado restaurante Kyoto, especializado en gastronomía japonesa a la carta.</p>
    <p>Entre sus excelentes servicios cabe destacar la conexión gratuita a Internet en todas las instalaciones del hotel y aparcamiento también gratuito. Este hotel es el alojamiento ideal para aquellos huéspedes que deseen experimentar una estancia relajada; gracias a sus completas instalaciones que incluyen magníficas piscinas, una bañera hidromasaje, un excelente spa y un centro de fitness. Su ubicación, cerca de los principales puntos de interés de la ciudad, también lo convierte en un hotel ideal para viajes de negocios o para realizar turismo urbano. </p>
    <p>El establecimiento se encuentra a 500 metros del Teatro Nacional de Santo Domingo, y de varios centros comerciales´, así como de una estación del metro de Santo Domingo.</p>
        <table class="table table-bordered">
            <thead>
            <tr >
                <th scope="col" width="50%">
                    <p><b><span>Habitación</span></b></p>
                </th>
                <th scope="col" width="50%">
                    <p><b><span>Valor por Habitación</span></b></p>
                </th>
            </tr>
            </thead>

            <tr >
                <td>
                    <p>Superior Room Individual (SGL)</p>
                </td>
                <td >
                    <p>77 USD</p>
                </td>
            </tr>
            <tr >
                <td>
                    <p>Superior Room Doble (DBL)</p>
                </td>
                <td >
                    <p>90 USD</p>
                </td>
            </tr>
            <tr >
                <td>
                    <p>Extra Pax (3ra y 4ta Persona)</p>
                </td>
                <td >
                    <p>+20 USD</p>
                </td>
            </tr>
            <tr >
                <td>
                    <p>Niños (2-12 años)</p>
                </td>
                <td >
                    <p>+14 USD</p>
                </td>
            </tr>
        </table>
        <p>Tarifas por habitación por noche, precios no incluyen el 28% impuestos</p>
        <p>Alojamiento, desayuno e internet incluidos en la tarifa</p>
        <p>Sujeto a cargos por otros servicios</p>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
