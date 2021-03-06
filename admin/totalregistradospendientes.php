<?php
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
    require ('php/nuevoestado.php');
	$url = WEB_URL;
    $query = mysqli_query($conexion, "SET @row_number=0");
	$query = mysqli_query($conexion, "SELECT *,(@row_number:=@row_number + 1) AS num FROM login WHERE estado LIKE 'verificacion' ORDER BY pais");
    $verificacion = array();
	while($row = mysqli_fetch_assoc($query)) {
        $verificacion[] = $row;
	}
    $query = mysqli_query($conexion, "SET @row_number=0");
    $query = mysqli_query($conexion, "SELECT *,(@row_number:=@row_number + 1) AS num FROM login WHERE estado LIKE 'pago' ORDER BY pais");
    $pago = array();
    while($row = mysqli_fetch_assoc($query)) {
        $pago[] = $row;
}
?>

<?php
	if (isset($_GET['action']) && $_GET['action'] == 'delete') {
		$borrar_id = $_GET['user_id'];
		mysqli_query($conexion, "DELETE FROM login WHERE id = '$borrar_id'");
		header('Location:'.WEB_URL.'/admin/totalregistrados.php');
	}
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
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body style="background-color:#e2e2e2">
		

  		<?php require ('menu.php');?>

		<?php
			if(isset($_GET['borrar'])) {
			$username = $_GET['name'];
			$id = $_GET['user_id'];
		?>
			<div class="alert alert-danger">
				<div class="row">
					<div class="col-md-11">
						<h3>¿Está seguro que desea eliminar al usuario <strong><?php echo $username;?></strong>?</h3>
						<p>Tenga en cuenta que este procedimiento no puede ser revertido.</p>
					</div>
				</div>
				<!--<form id="confirmleteform" method="post" action="includestrmgmt.php">-->
					<table class="actionbtntable table">
						<tbody>
							<tr>
								<td class="actionfield nopadding">
                                    <a href="<?php echo WEB_URL;?>/admin/totalregistrados.php?action=delete&user_id=<?php echo $id;?>"class="btn btn-danger">Eliminar</button></a>
									<a href="<?php echo WEB_URL;?>/admin/totalregistrados.php" class="btn btn-default">Cancelar</a>
								</td>
							</tr>
						</tbody>
					</table>
				<!--</form>-->
			</div>
		<?php
			}
		?>
        <?php
			if(isset($_GET['emailenviado'])) {
			    echo '<div class="alert alert-success">Email enviado con éxito</div>';
			}
        ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
                    <h2>En Proceso de Verificación</h2>
					<table class="table table-striped">
						<thead>
							<tr>
                                <th>Codigo Usuario</th>
								<th>Nombre</th>
								<th>Nacionalidad</th>
								<th>Nivel</th>
                                <th>Universidad</th>
                                <th>Carrera</th>
                                <th>Correo Electronico</th>
								<th>Teléfono</th>
                                <th>Facebook</th>
                                <th>Instagram</th>
								<th>Fecha Nacimiento</th>
                                <th>Estado</th>
								<th>Contactar</th>
								<th>Administrar</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($verificacion as $key=>$value) {
									$universidad = $verificacion[$key]['universidad'];
									$nombre = $verificacion[$key]['nombreyapellidoInput'];
									$email = $verificacion[$key]['correoElectronico'];
									$pais = $verificacion[$key]['pais'];
									$estudiante = $verificacion[$key]['estudiante'];
                                    $universidad = $verificacion[$key]['universidad'];
                                    $fechaNacimiento = $verificacion[$key]['fechaNacimiento'];
                                    $carrera = $verificacion[$key]['carrera'];
                                    $instagram = $verificacion[$key]['instagram'];
                                    $facebook = $verificacion[$key]['facebook'];
									$state = $verificacion[$key]['estado'];
									$id = $verificacion[$key]['id'];
                                    $num = $verificacion[$key]['num'];
									$telefono = $verificacion[$key]['telefono'];
							?> 	
							<tr>
                                <td>
                                    <?php echo $num;?>
                                </td>
								<td>
									<?php echo $nombre;?>
								</td>
								<td>
									<?php echo $pais;?>
								</td>
                                <td>
                                    <?php echo $estudiante;?>
                                </td>
                                <td>
                                    <?php echo $universidad;?>
                                </td>
                                <td>
                                    <?php echo $carrera;?>
                                </td>
                                <td>
                                    <?php echo $email;?>
                                </td>
								<td><?php echo $telefono;?></td>
                                <td><?php echo $facebook;?></td>
                                <td><?php echo $instagram;?></td>
                                <td><?php echo $fechaNacimiento;?></td>
								<td><?php echo nuevoestado($state);?></td>
									
								<td>
											<!-- <button type="button" data-toggle="modal" data-target="#modalRechazar" class="btn btn-danger rechazar-btn" value="<?php echo $id;?>">Rechazar</button> -->
										<button type="submit" class="btn btn-primary botonEnviar"  data-toggle="modal" data-target="#modalEnviar" value="<?php echo $id;?>">Enviar mensaje</button>
								</td>
								<td class="actionfield nopadding"> <a href="<?php echo WEB_URL;?>/admin/totalregistrados.php?borrar=true&name=<?php echo $nombre;?>&user_id=<?php echo $id;?>" class="btn btn-default">Eliminar Usuario</a> </td>
							</tr>
							<?php
								// end foreach
								}
							?>
								
						</tbody>	
					</table>
				</div>
			</div>
            <div class="row">
                <div class="col-md-12">
                    <h2>En Proceso de Pago</h2>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Codigo Usuario</th>
                            <th>Nombre</th>
                            <th>Nacionalidad</th>
                            <th>Nivel</th>
                            <th>Universidad</th>
                            <th>Carrera</th>
                            <th>Correo Electronico</th>
                            <th>Teléfono</th>
                            <th>Facebook</th>
                            <th>Instagram</th>
                            <th>Fecha Nacimiento</th>
                            <th>Estado</th>
                            <th>Contactar</th>
                            <th>Administrar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($pago as $key=>$value) {
                            $universidad = $pago[$key]['universidad'];
                            $nombre = $pago[$key]['nombreyapellidoInput'];
                            $email = $pago[$key]['correoElectronico'];
                            $pais = $pago[$key]['pais'];
                            $estudiante = $pago[$key]['estudiante'];
                            $universidad = $pago[$key]['universidad'];
                            $fechaNacimiento = $pago[$key]['fechaNacimiento'];
                            $carrera = $pago[$key]['carrera'];
                            $instagram = $pago[$key]['instagram'];
                            $facebook = $pago[$key]['facebook'];
                            $state = $pago[$key]['estado'];
                            $id = $pago[$key]['id'];
                            $num = $pago[$key]['num'];
                            $telefono = $pago[$key]['telefono'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $num;?>
                                </td>
                                <td>
                                    <?php echo $nombre;?>
                                </td>
                                <td>
                                    <?php echo $pais;?>
                                </td>
                                <td>
                                    <?php echo $estudiante;?>
                                </td>
                                <td>
                                    <?php echo $universidad;?>
                                </td>
                                <td>
                                    <?php echo $carrera;?>
                                </td>
                                <td>
                                    <?php echo $email;?>
                                </td>
                                <td><?php echo $telefono;?></td>
                                <td><?php echo $facebook;?></td>
                                <td><?php echo $instagram;?></td>
                                <td><?php echo $fechaNacimiento;?></td>
                                <td><?php echo nuevoestado($state);?></td>

                                <td>
                                    <!-- <button type="button" data-toggle="modal" data-target="#modalRechazar" class="btn btn-danger rechazar-btn" value="<?php echo $id;?>">Rechazar</button> -->
                                    <button type="submit" class="btn btn-primary botonEnviar"  data-toggle="modal" data-target="#modalEnviar" value="<?php echo $id;?>">Enviar mensaje</button>
                                </td>
                                <td class="actionfield nopadding"> <a href="<?php echo WEB_URL;?>/admin/totalregistrados.php?borrar=true&name=<?php echo $nombre;?>&user_id=<?php echo $id;?>" class="btn btn-default">Eliminar Usuario</a> </td>
                            </tr>
                            <?php
                            // end foreach
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
		</div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div><a href="totalregistrados_excel.php" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-export" aria-hidden="true"></span> Descargar a Excel</a></div>
                </div>
            </div>
        </div>

		<div class="modal fade" id="modalEnviar">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Escriba su mensaje:</h4>
		      </div>
		      <form action="enviarunmensaje.php" method="post">
		      <div class="modal-body">
		       <div class="form-group">
		       	<label>Asunto:</label>
		       	<input class="form-control" type="text" name="sujeto" required>
		       	<label>Titulo:</label>
		       	<input class="form-control" type="text" name="titulo" required>
		       	<input type="hidden" name="tipoMail" value="totalregistrados">
		       	<label>Mensaje:</label>
		       	<textarea class="form-control" name="mensaje" required></textarea>
		       </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" name="user_id" class="btn btn-primary sendEnviar">Enviar</button>
		      </div>
		  	</form>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
			   
		<script src="js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script>
			var botonesEnviar = $('.botonEnviar');
			botonesEnviar.click(function(){
				var user_id = $(this).attr('value');
				$('#modalEnviar .sendEnviar').attr('value', user_id);
			})
		</script>
	</body>
</html>
