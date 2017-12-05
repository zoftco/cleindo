<?php
    require_once('../inc/config.php');
    require_once('php/sessioncontrol.php');
    $session = new sessioncontrol();
    if($session->isValid('admin_id')) {
        $session->redirect(HOME_PAGE);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Clein </title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top topnavbar">
            <div class="container">
                <div class="navbar-header">
                    <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="collapsable-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> -->
                    <a class="navbar-brand navbarmarca" href="#">Clein</a>
                </div>
                <!-- <div class="collapse navbar-collapse" id="collapsable-menu">
                    <ul class="nav navbar-nav">
                        <li>Usuarios</li>
                    </ul>
                    <ul>
                </div> -->
            </div>
        </nav>
        <div class="container-fluid">
            <div class="well well-lg login-well">
                <div id="usernamegroup" class="form-group">
                    <label class="control-label">Nombre de usuario</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input name="username" type="email" class="form-control" placeholder="Introducir dirección de e-mail">
                    </div>
                </div>
                <div id="userpassgroup" class="form-group">
                    <label class="control-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input name="userpass" type="password" class="form-control" placeholder="Introducir contraseña">
                    </div>
                </div>
                <button id="loginbtn" type="button" class="btn btn-primary loginbtn pull-right"><span class="glyphicon glyphicon-log-in"></span> Ingresar</button>
            </div>
        </div>

        <div class="popalertholder">
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/globalController.js"></script>
        <script src="js/logincontroller.js"></script>
    </body>
</html>
