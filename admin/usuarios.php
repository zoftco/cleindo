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
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Crear administrador</h4>
                        </div>
                        <div class="panel-body newadminform" style="position: relative">
                            <div class="well" style="margin-bottom: 0">
                                <div class="form-group" id="newadmin_name">
                                    <label class="control-label">Nombre y apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input name="newadmin_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" id="newadmin_email">
                                    <label class="control-label">E-mail</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                        <input name="newadmin_email" type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" id="newadmin_rol">
                                    <label class="control-label">Rol</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <select name="newadmin_rol" class="form-control">
                                            <option value="admin">admin</option>
                                            <option value="finanzas">finanzas</option>
                                            <option value="operaciones">operaciones</option>
                                            <option value="academica">academica</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="newadmin_pass">
                                    <label class="control-label">Contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input name="newadmin_pass" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" id="newadmin_pass2">
                                    <label class="control-label">Repetir contraseña</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input name="newadmin_pass2" type="password" class="form-control">
                                    </div>
                                </div>
                                <button id="newadminbtn" type="button" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Crear</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="adminpanel panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><span class="glyphicon glyphicon-user"></span> Lista de administradores</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre y apellido</th>
                                        <th>E-mail</th>
                                        <th>Rol</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popalertholder">
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/globalController.js"></script>
        <script src="js/usuarioscontroller.js"></script>
    </body>
</html>
