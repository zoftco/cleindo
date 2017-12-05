<nav class="navbar navbar-default navbar-static-top topnavbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="collapsable-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand navbarmarca" href="#">InterViajes</a>
        </div>
        <div class="collapse navbar-collapse" id="collapsable-menu">
            <ul class="nav navbar-nav">
                <li><a href="#">Usuarios</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a id="currentuser" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" data-id="<?php echo $_SESSION['admin_id'];?>">
                        <span class="glyphicon glyphicon-user"></span> <span class="currentadminname"><?php echo utf8_encode($_SESSION['admin_name']);?></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="php/logincontrol.php?operation=logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
                        <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> Administradores</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>