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
<div class="container-fluid" style="background-image:url('img/HOTEL-SEDE.jpg');background-size: contain;background-repeat: no-repeat;background-position: center;">
    <div class="mx-auto" style="height:500px;text-align:center">
    </div>
</div>

<section id="main">
	<div class="container">
        <p>Catalonia Santo Domingo es un sensacional hotel de 21 pisos que se encuentra ubicado frente al mar, con ventanales que permiten disfrutar la hermosa vista desde todos los pisos. Situado en  la avenida George Washington, a treinta minutos del Aeropuerto Internacional Las Américas (AILA) y a pocos minutos del distrito comercial y de la zona histórica de la ciudad de Santo Domingo.</p>
        <p>Las 228 habitaciones están decoradas de acuerdo a las exigencias del cliente corporativo y de negocio y ofrecen conexión a internet WiFi gratis en todas las áreas del hotel. En los restaurantes del Catalonia Santo Domingo puedes encontrar la mejor combinación entre calidad y sabor. Disfruta de suculentos platos y el más autentico ambiente en nuestros restaurantes, bares y snacks.</p>
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
                    <p>TRIPLE (Tres Personas)</p>
                </td>
                <td >
                    <p>115 USD</p>
                </td>
            </tr>
            <tr >
                <td>
                    <p>DOBLE (Dos Personas)</p>
                </td>
                <td >
                    <p>85 USD</p>
                </td>
            </tr>
            <tr >
                <td>
                    <p>SENCILLA (Una Persona)</p>
                </td>
                <td >
                    <p>90 USD</p>
                </td>
            </tr>
        </table>

        </p>
        <p>*Precios por habitación por noche, sujeto a un 28% de impuestos y cargos por otros servicios</p>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
