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
	$url = 'http://localhost/CleinFinal';
	$query = mysqli_query($conexion, "SELECT * FROM imagenes LEFT JOIN (SELECT login.pais, login.estudiante, login.nombreyapellidoInput, login.correoElectronico, login.id FROM login) AS usuarios ON (imagenes.user_id = usuarios.id) ORDER BY field (estado, 'pendiente', 'aceptado', 'rechazado')");
	$estado = array();
	while($row = mysqli_fetch_assoc($query)) {
		$estado[] = array_map('utf8_encode', $row);
	}
	$first = 'aasdf';
	$second = 'fasdfa';
	$third = 'active';
	$fourth = 'asdasd';
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

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Correo Electronico</th>
								<th>Monto</th>
								<th>Nombre</th>
								<th>Correo Electronico</th>
								<th>Documentos</th>
								<th>Administrar</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($estado as $key=>$value) {
									$fotoFactura = $estado[$key]['fotoFactura'];
									$fotoCedula = $estado[$key]['fotoCedula'];
									$id = $estado[$key]['user_id'];
									$nombre = $estado[$key]['nombreyapellidoInput'];
									$email = $estado[$key]['correoElectronico'];
									$state = $estado[$key]['estado'];
									$pais = $estado[$key]['pais'];
									$est = $estado[$key]['estudiante'];
							?> 	
							<tr>


								<td>
									<?php
										$colores = array('pendiente'=>'yellow','aceptado'=>'green','rechazado'=>'red');
									?>
									<div class="redondito" style="background-color:<?php echo $colores[$state];?>">
									</div>
									<?php echo $state;?>
								</td>


								<td>
									<?php echo $nombre;?>
								</td>
								<td>
									<?php echo $pais;?>
								</td>
								<td>
									<?php echo $est;?>
								</td>
								<td>
									<?php echo $email;?>
								</td>
								<td>
									<?php
										if ($fotoFactura != "") {
											$fotoFactura = $url.$fotoFactura;
									?>
										<a href="<?php echo $fotoFactura;?>">Factura</a>
									<?php
										}
									?>
									<?php
										if ($fotoCedula != "") {
											$fotoCedula = $url.$fotoCedula;
									?>
										<a href="<?php echo $fotoCedula;?>">Cedula</a>
									<?php
										}
									?>
								</td>
								<td>
									<?php
										if($state == 'pendiente') {
									?>
										<form action="aceptar.php" method="post" style="display:inline-block">
											<input type="hidden" name="user_id" value="<?php echo $id;?>">
											<button type="submit" class="btn btn-primary"> Aceptar </button>
										</form>
										<form action="rechazar.php" method="post" style="display:inline-block">
											<input type="hidden" name="user_id" value="<?php echo $id;?>">
											<button type="button" data-toggle="modal" data-target="#modalRechazar" class="btn btn-danger rechazar-btn" value="<?php echo $id;?>">Rechazar</button>
										</form>
									<?php
										} else {
									?>
										<button type="submit" class="btn btn-primary" disabled> Aceptar </button>
										<button class="btn btn-danger" data-toggle="modalRechazar" disabled>Rechazar</button>
									<?php
										}
									?>
								</td>
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

		
		 

		<div class="modal fade" id="modalRechazar">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Razon de rechazo:</h4>
		      </div>
		      <form action="rechazar.php" method="post">
		      <div class="modal-body">
		       <div class="form-group">
		       	<textarea class="form-control" name="mensaje" required></textarea>
		       </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		        <button type="submit" name="user_id" class="btn btn-primary sendRechazar">Enviar</button>
		      </div>
		  	</form>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
			   
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script>
			var botonesRechazar = $('.rechazar-btn');
			botonesRechazar.click(function(){
				var user_id = $(this).attr('value');
				$('#modalRechazar .sendRechazar').attr('value', user_id);
			})
		</script>
	</body>
</html>