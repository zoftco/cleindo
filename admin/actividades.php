<?php
    require_once('php/sessioncontrol.php');
    $session = new sessioncontrol();
    if(!$session->isValid('admin_id')) {
        $session->redirect('login.php');
        exit;
    }
    $first='asd';
    $second='asd';
    $third='asd';
    $fourth='asd';
    $five = 'asd';
    $six='asd';
    $seven = 'asd';
    $eight = 'active';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Administrador Clein</title>

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
         <?php include('menu.php');?>  

  
 
        <div class="container pagemaincontent">
            <div class="row">      
            <div class="col-sm-12">
                <div class="actividadpanel panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><span class="glyphicon glyphicon-user"></span> Usuarios  </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Imprimir</th>
                                </tr>
                            </thead>
                            <tbody>
                                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="popalertholder"></div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/globalController.js"></script>
        <script src="js/actividadcontroller.js"></script>
    </body>
 </html>       