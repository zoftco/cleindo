<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
    require_once('php/sessioncontrol.php');
    $session = new sessioncontrol();
    if(!$session->isValid('admin_id')) {
        $session->redirect('login.php');
        exit;
    }
?>

<?php
    require ('../inc/config.php');
    require ('../inc/conexion.php');
?>

<!DOCTYPE html>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $borrar_id = $_GET['idconcurso'];
    mysqli_query($conexion, "DELETE FROM concurso WHERE idconcurso = '$borrar_id'");
    header('Location:adminconcurso.php');
}

if(isset($_GET['borrar'])&&($_SESSION['admin_rol']=='admin'||$_SESSION['admin_rol']=='finanzas')) {
$id = $_GET['idconcurso'];
?>
    <div class="alert alert-danger">
        <div class="row">
            <div class="col-md-11">
                <h3>¿Está seguro que desea eliminar?</h3>
                <p>Tenga en cuenta que este procedimiento no puede ser revertido.</p>
            </div>
        </div>
        <table class="actionbtntable table">
            <tbody>
            <tr>
                <td class="actionfield nopadding">
                    <a href="adminconcurso.php?action=delete&idconcurso=<?php echo $id;?>"class="btn btn-danger">Eliminar</button></a>
                    <a href="adminconcurso.php" class="btn btn-default">Cancelar</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php
}
?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Administrador Clein</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body style="background-color:#e2e2e2">
		

  		<?php require ('menu.php');?>

		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Resumen de Ponencia</h1>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">
                    <h3>Ponencias Estudiantiles</h3>
					<table class="table table-striped">
						<thead>
							<tr>
                                <th>Perfil</th>
								<th>Autores</th>
								<th>Tipo</th>
                                <th>Documento</th>
                                <th>Fecha de Envío</th>
                                <th>Estado</th>
                                <th>Administración</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            $queryadmin = mysqli_query($conexion, "SELECT * FROM administradores");
                            $administradores = array();
                            while($row = mysqli_fetch_assoc($queryadmin)) {
                                $administradores[$row['admin_id']] = $row['admin_nombre'];
                            }

                            $query = mysqli_query($conexion, "SELECT * FROM concurso LEFT JOIN (SELECT * FROM login) AS usuario ON (concurso.idlogin = usuario.id) WHERE usuario.estudiante LIKE 'estudiante' AND concurso.tipoDocumento LIKE 'resumen'");
                            $perfil = array();
                            while($row = mysqli_fetch_assoc($query)) {
                                $perfil[] = $row;
                            }
                            foreach ($perfil as $key=>$value) {
							?> 	
							<tr>
                                <td>
                                    <a href="perfil.php?id=<?php echo $perfil[$key]['idlogin'];?>">
                                        <?php echo $perfil[$key]['nombreyapellidoInput'];?>
                                    </a>
                                </td>
								<td>
									<?php echo $perfil[$key]['autor1'].', '.$perfil[$key]['autor2'];?>
								</td>
                                <td>
                                    <?php echo $perfil[$key]['tipoDocumento'];?>
                                </td>
                                <td>
                                    <a href="<?php echo WEB_URL.$perfil[$key]['rutaDocumento'];?>"><?php echo $perfil[$key]['rutaDocumento'];?></a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
								<td>

									<?php

										if($perfil[$key]['estadoDocumento'] == 'pendiente') {
                                            if ($_SESSION['admin_rol'] == "admin" || $_SESSION['admin_rol'] == 'academica') {
                                                ?>
                                                <form action="accionesconcurso.php" method="post"
                                                      style="display:inline-block">
                                                    <input type="hidden" name="idconcurso"
                                                           value="<?php echo $perfil[$key]['idconcurso']; ?>">
                                                    <input type="hidden" name="accion"
                                                           value="aprobado">
                                                    <input type="hidden" name="mensaje"
                                                           value="">
                                                    <button type="submit" class="btn btn-primary"> Aceptar</button>
                                                </form>
                                                <form action="accionesconcurso.php" method="post"
                                                      style="display:inline-block">
                                                    <button type="button" data-toggle="modal" id="buttonRechazar"
                                                            data-target="#modalRechazar"
                                                            class="btn btn-danger rechazar-btn"
                                                            value="<?php echo $perfil[$key]['idconcurso']; ?>">Rechazar
                                                    </button>
                                                </form>
                                                <a href="adminconcurso.php?borrar=true&idconcurso=<?php echo $perfil[$key]['idconcurso']; ?>"
                                                   class="btn btn-default">Eliminar</a>
                                                <?php
                                            }
                                        }else{
									?>
                                            <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                            <p>Fecha Revisión: <?php echo $perfil[$key]['fechaestadoDocumento'];?></p>
                                            <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
									<?php
										}
                                    ?>
								</td>
							</tr>
                            <?php
								}
							?>
						</tbody>	
					</table>
				</div>
			</div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Ponencias Profesionales</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Autores</th>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Fecha de Envío</th>
                            <th>Estado</th>
                            <th>Administración</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM concurso LEFT JOIN (SELECT * FROM login) AS usuario ON (concurso.idlogin = usuario.id) WHERE usuario.estudiante LIKE 'profesional' AND concurso.tipoDocumento LIKE 'resumen'");
                        $perfil = array();
                        while($row = mysqli_fetch_assoc($query)) {
                            $perfil[] = $row;
                        }
                        foreach ($perfil as $key=>$value) {
                            ?>
                            <tr>
                                <td>
                                    <a href="perfil.php?id=<?php echo $perfil[$key]['idlogin'];?>">
                                        <?php echo $perfil[$key]['nombreyapellidoInput'];?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['autor1'].', '.$perfil[$key]['autor2'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['tipoDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['rutaDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
                                <td>

                                    <?php

                                    if($perfil[$key]['estadoDocumento'] == 'pendiente') {
                                        if ($_SESSION['admin_rol'] == "admin" || $_SESSION['admin_rol'] == 'academica') {
                                            ?>
                                            <form action="accionesconcurso.php" method="post"
                                                  style="display:inline-block">
                                                <input type="hidden" name="idconcurso"
                                                       value="<?php echo $perfil[$key]['idconcurso']; ?>">
                                                <input type="hidden" name="accion"
                                                       value="aprobado">
                                                <input type="hidden" name="mensaje"
                                                       value="">
                                                <button type="submit" class="btn btn-primary"> Aceptar</button>
                                            </form>
                                            <form action="accionesconcurso.php" method="post"
                                                  style="display:inline-block">
                                                <button type="button" data-toggle="modal" id="buttonRechazar"
                                                        data-target="#modalRechazar"
                                                        class="btn btn-danger rechazar-btn"
                                                        value="<?php echo $perfil[$key]['idconcurso']; ?>">Rechazar
                                                </button>
                                            </form>
                                            <a href="adminconcurso.php?borrar=true&idconcurso=<?php echo $perfil[$key]['idconcurso']; ?>"
                                               class="btn btn-default">Eliminar</a>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                        <p>Fecha Revisión: <?php echo $perfil[$key]['estadoDocumento'];?></p>
                                        <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <h1>Ponencias Completas</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Ponencias Estudiantiles</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Autores</th>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Fecha de Envío</th>
                            <th>Estado</th>
                            <th>Administración</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $queryadmin = mysqli_query($conexion, "SELECT * FROM administradores");
                        $administradores = array();
                        while($row = mysqli_fetch_assoc($queryadmin)) {
                            $administradores[$row['admin_id']] = $row['admin_nombre'];
                        }

                        $query = mysqli_query($conexion, "SELECT * FROM concurso LEFT JOIN (SELECT * FROM login) AS usuario ON (concurso.idlogin = usuario.id) WHERE usuario.estudiante LIKE 'estudiante' AND concurso.tipoDocumento LIKE 'completa'");
                        $perfil = array();
                        while($row = mysqli_fetch_assoc($query)) {
                            $perfil[] = $row;
                        }
                        foreach ($perfil as $key=>$value) {
                            ?>
                            <tr>
                                <td>
                                    <a href="perfil.php?id=<?php echo $perfil[$key]['idlogin'];?>">
                                        <?php echo $perfil[$key]['nombreyapellidoInput'];?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['autor1'].', '.$perfil[$key]['autor2'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['tipoDocumento'];?>
                                </td>
                                <td>
                                    <a href="<?php echo WEB_URL.$perfil[$key]['rutaDocumento'];?>"><?php echo $perfil[$key]['rutaDocumento'];?></a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
                                <td>

                                    <?php

                                    if($perfil[$key]['estadoDocumento'] == 'pendiente') {
                                        if ($_SESSION['admin_rol'] == "admin" || $_SESSION['admin_rol'] == 'academica') {
                                            ?>
                                            <form action="accionesconcurso.php" method="post"
                                                  style="display:inline-block">
                                                <input type="hidden" name="idconcurso"
                                                       value="<?php echo $perfil[$key]['idconcurso']; ?>">
                                                <input type="hidden" name="accion"
                                                       value="aprobado">
                                                <input type="hidden" name="mensaje"
                                                       value="">
                                                <button type="submit" class="btn btn-primary"> Aceptar</button>
                                            </form>
                                            <form action="accionesconcurso.php" method="post"
                                                  style="display:inline-block">
                                                <button type="button" data-toggle="modal" id="buttonRechazar"
                                                        data-target="#modalRechazar"
                                                        class="btn btn-danger rechazar-btn"
                                                        value="<?php echo $perfil[$key]['idconcurso']; ?>">Rechazar
                                                </button>
                                            </form>
                                            <a href="adminconcurso.php?borrar=true&idconcurso=<?php echo $perfil[$key]['idconcurso']; ?>"
                                               class="btn btn-default">Eliminar</a>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                        <p>Fecha Revisión: <?php echo $perfil[$key]['fechaestadoDocumento'];?></p>
                                        <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Ponencias Profesionales</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Autores</th>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Fecha de Envío</th>
                            <th>Estado</th>
                            <th>Administración</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM concurso LEFT JOIN (SELECT * FROM login) AS usuario ON (concurso.idlogin = usuario.id) WHERE usuario.estudiante LIKE 'profesional' AND concurso.tipoDocumento LIKE 'completo'");
                        $perfil = array();
                        while($row = mysqli_fetch_assoc($query)) {
                            $perfil[] = $row;
                        }
                        foreach ($perfil as $key=>$value) {
                            ?>
                            <tr>
                                <td>
                                    <a href="perfil.php?id=<?php echo $perfil[$key]['idlogin'];?>">
                                        <?php echo $perfil[$key]['nombreyapellidoInput'];?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['autor1'].', '.$perfil[$key]['autor2'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['tipoDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['rutaDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
                                <td>

                                    <?php

                                    if($perfil[$key]['estadoDocumento'] == 'pendiente') {
                                        if ($_SESSION['admin_rol'] == "admin" || $_SESSION['admin_rol'] == 'academica') {
                                            ?>
                                            <form action="accionesconcurso.php" method="post"
                                                  style="display:inline-block">
                                                <input type="hidden" name="idconcurso"
                                                       value="<?php echo $perfil[$key]['idconcurso']; ?>">
                                                <input type="hidden" name="accion"
                                                       value="aprobado">
                                                <input type="hidden" name="mensaje"
                                                       value="">
                                                <button type="submit" class="btn btn-primary"> Aceptar</button>
                                            </form>
                                            <form action="accionesconcurso.php" method="post"
                                                  style="display:inline-block">
                                                <button type="button" data-toggle="modal" id="buttonRechazar"
                                                        data-target="#modalRechazar"
                                                        class="btn btn-danger rechazar-btn"
                                                        value="<?php echo $perfil[$key]['idconcurso']; ?>">Rechazar
                                                </button>
                                            </form>
                                            <a href="adminconcurso.php?borrar=true&idconcurso=<?php echo $perfil[$key]['idconcurso']; ?>"
                                               class="btn btn-default">Eliminar</a>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                        <p>Fecha Revisión: <?php echo $perfil[$key]['estadoDocumento'];?></p>
                                        <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	

		<div class="modal fade" id="modalRechazar">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Razon de rechazo:</h4>
		      </div>
		      <form action="accionesconcurso.php" method="post">
		      <div class="modal-body">
		       <div class="form-group">
		       	<textarea class="form-control" name="mensaje" required></textarea>
		       </div>
		      </div>
		      <div class="modal-footer">
                <input type="hidden" name="accion"
                     value="rechazado">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" name="idconcurso" class="btn btn-primary sendRechazar">Enviar</button>
		      </div>
		  	</form>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
			   
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script>
			var botonesRechazar = $('#buttonRechazar');
			botonesRechazar.click(function(){
				var idconcurso = $(this).attr('value');
				$('#modalRechazar .sendRechazar').attr('value', idconcurso);
			})
		</script>
	</body>
</html>
