<?php
    require_once('php/sessioncontrol.php');
    $session = new sessioncontrol();
    if(!$session->isValid('admin_id')) {
        $session->redirect('login.php');
        exit;
    }
?>

<?php
	require ('../inc/conexion.php');
    require ('../inc/config.php');
	$url = WEB_URL;
	$query = mysqli_query($conexion, "SELECT * FROM login");
	// ORDER BY field (estado, 'pendiente', 'aceptado', 'rechazado') acordate que este es el query para ordenar, aunque no importa mucho en esta pag, preguntale a david //
	$estado = array();
	while($row = mysqli_fetch_assoc($query)) {
		$estado[] = array_map('utf8_encode', $row);
	}
	$first = 'asfive';
	$second = 'asdsfe';
	$third = 'aasdfe';
	$fourth = 'active';
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

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Correo Electronico</th>
								<th>Nacionalidad</th>
								<th>Estudiante</th>
								<th>Teléfono</th>
								<th>Estado</th>
								<th>Codigo Usuario</th>
								<th>Contacto</th>
								<th>Administrar</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($estado as $key=>$value) {
									$universidad = $estado[$key]['universidad'];
									$nombre = $estado[$key]['nombreyapellidoInput'];
									$email = $estado[$key]['correoElectronico'];
									$nacionalidad = $estado[$key]['pais'];
									$estudiante = $estado[$key]['estudiante'];
									if ($estudiante == 'no') {
										$estudiante = 'No';
									} else {
										if (!$universidad) {
											$estudiante = 'Si';
										} else {
											$estudiante = $universidad;
										}
										
									}
									$state = $estado[$key]['estado'];
									$id = $estado[$key]['id'];
									$telefono = $estado[$key]['telefono'];
									if (!$telefono) {
										$telefono = "Sin telefono";
									}
							?> 	
							<tr>

								<td>
									<?php echo $nombre;?>
								</td>
								<td>
									<?php echo $email;?>
								</td>
								<td>
									<?php echo $nacionalidad;?>
								</td>

								<td>
									<?php echo $estudiante;?>
								</td>

								<td><?php echo $telefono;?></td>

								<td><?php echo $state;?></td>

								<td style="padding-left:50px">
									<?php echo $id;?>
								</td>
									
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
		<!-- dropdownmenu -->
		<div class="container">
			<form action="TemplateMail/comunicado.php" method="post">
			    <div class="modal-body">
			    	<div class="form-group">
			    		<div class="container" style="padding-left:0px">
			    			<label>Enviar comunicado a:</label><br>
			    			<input type="radio" name="quienMandar" checked value="todos"> Todos</input><br>
			    			<input type="radio" name="quienMandar" value="sinDocumentos"> Usuarios sin documentos</input><br>
			    			<input type="radio" name="quienMandar" value="sinComprobantes"> Usuarios sin comprobante de pago</input><br>
			    			<input type="radio" name="quienMandar" value="cursos"> Usuarios listos para inscribirse en cursos</input><br>
			    		</div><br>
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
			      	<button type="submit" name="user_id" class="btn btn-primary sendEnviar">Enviar</button>
			    </div>
			</form>
		</div>	
	 	<!-- dropdownmenu -->

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
