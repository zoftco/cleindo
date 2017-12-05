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
    $six = 'asd';
    $seven = 'active';
    $eight = 'asd';

    $visita = '';
    $visita_id = '';

    if(!empty($_GET['id'])){
        $visita_id = $_GET['id'];
    }

    if(!empty($_GET['lugar'])){
        $visita .= $_GET['lugar'].' ';
    }
    if(!empty($_GET['fecha'])){
        $datetime = strtotime($_GET['fecha']);
        $date = date("d/m/Y H:i", $datetime);
        $visita .= $date;
    }

    //print_r($visita);die;
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
        <link href="css/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
                <div class="visitapanel panel panel-default">
            	    <div class="panel-heading">
                        <h4 class="panel-title"><span class="glyphicon glyphicon-user"></span> Visita: <?php echo $visita; ?></h4>
                    </div>

                    <div class="exportvisitabtn" data-id="<?php echo $visita_id ?>" style="margin: 20px 20px 0 0; display: inline-block; float:right;">
                        <p><span class="glyphicon glyphicon-plus"></span> Exportar a Excel</p>  
                    </div>
                    <div class="panel-body">
                    	<table class="table table-striped">
                            <thead>
                                <tr>
                                    <input id="visita_id" value="<?php echo $_GET['id'] ?>" type="hidden" />
                                    <th>Nombre</th>
                                    <th>CI</th>
                                    <th>País</th>
                                    <th>Correo</th>
                                    <th></th>
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
        <script src="js/bootstrap.min.js"></script>
        <script src="js/globalController.js"></script>
        <script src="js/visitausuarioscontroller.js"></script>
    </body>
 </html>	       
