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
    <img src="img/CIUDAD-DE-SANTO-DOMINGO.jpg" alt="Día 1: Integración" width="100%">
</div>

<section id="main">
	<div class="container">
        <p>República Dominicana cuenta con los elementos perfectos para cautivar tu imaginación y refrescar tu alma. Es el segundo país más grande y más diverso del Caribe. Se destaca por la calidez de su clima y la hospitalidad de su gente. República Dominicana es un destino sin igual que cuenta con una naturaleza extraordinaria, fascinante historia y gran riqueza cultural. </p>
        <p>Rodeada por el Océano Atlántico hacia el Norte y el Mar Caribe hacia el Sur, República Dominicana se enorgullece de contar con más de 1,600 Km. de costa y 400 Km. de las mejores playas del mundo, magníficos hoteles y resorts, e infinidad de opciones en deportes, entretenimiento y recreación. Aquí puedes bailar al ritmo contagioso del merengue, renovarte en nuestros lujosos y variados hoteles, explorar antiguas ruinas,  deleitarte con la mejor gastronomía dominicana, o vivir aventuras ecoturísticas en nuestros magníficos parques naturales, cordilleras, ríos y playas. </p>
        <img src="img/RD-LO-TIENE.jpg" width="100%" />
        <p>*Conoce mas en <a href="//godominicanrepublic.com">godominicanrepublic.com</a></p>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
