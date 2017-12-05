<html>
<head>
  <title></title>
  <meta charset="utf-8">
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">CLEIN</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class = "<?php echo $first;?>"><a href="admin.php">Administrar Usuarios</a></li>
          <li class = "<?php echo $second;?>"><a href="adminpagos.php">Administrar Pagos </a></li>
          <!-- <li class = "<?php echo $third;?>"><a href="transaccionesprocard.php">Ver Transacciones </a></li> -->
          <li class = "<?php echo $fourth;?>"><a href="totalregistrados.php">Usuarios Registrados </a></li>
        
		  <!-- nuevo -->
          <li class = "<?php echo $six;?>"><a href="pilares.php">Pilares</a></li>
          <li class = "<?php echo $five;?>"><a href="cursos.php">Charlas</a></li>
          <li class = "<?php echo $seven;?>"><a href="visitas.php">Visitas</a></li>
		  <li class = "<?php echo $eight;?>"><a href="actividades.php">Actividades</a></li>
          <!-- nuevo -->
		  
        </ul>
        <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span> <?php echo utf8_encode($_SESSION['admin_name']);?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="php/logincontrol.php?operation=logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
                        <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> Administradores</a></li>
                    </ul>
                </li>
            </ul>
      </div>
    </div>
  </nav>
</body>
</html>