<?php
    require ('../inc/config.php');
    require ('../inc/conexion.php');
	$url = WEB_URL;
	
	$query = mysqli_query($conexion, "SELECT * FROM pagoefectivo LEFT JOIN (SELECT login.nombreyapellidoInput, login.correoElectronico, login.id FROM login) AS usuarios ON (pagoefectivo.idUsers = usuarios.id) ORDER BY field (estado, 'pendiente', 'aceptado', 'rechazado')");
	$estado = array();
	while($row = mysqli_fetch_assoc($query)) {
		$estado[] = $row;
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body style="background-color:#e2e2e2">
		

  		<?php require ('menu.php');?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Estado</th>
								<th>Nombre</th>
								<th>Correo Electronico</th>
								<th>Factura</th>
								<th>Nro. de Factura</th>
								<th>Nombre del Propietario</th>
								
								<th>Administrar</th>
							</tr>
						</thead>
						<tbody>
							<?php
								
								foreach ($estado as $key=>$value) {
									$fotoFactura = $estado[$key]['imgFactura'];
									$id = $estado[$key]['idUsers'];
									$nombrePro = $estado[$key]['nomParticipante'];
									$numFactura = $estado[$key]['numFactura'];
									$nombre = $estado[$key]['nombreyapellidoInput'];
									$email = $estado[$key]['correoElectronico'];
									$state = $estado[$key]['estado'];
									
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
									<?php echo $email;?>
								</td>
								<td>
									<?php
										if ($fotoFactura != "") {
											$fotoFactura = $url.$fotoFactura;
									?>
										<a href="<?php echo $fotoFactura;?>">Foto de comprobante</a>
									<?php
										}
									?>
								</td>

								<td>
									<?php echo $numFactura;?>
								</td>

								<td>
									<?php echo $nombrePro;?>
								</td>
								
								

								<td>

									<?php
                                    if($_SESSION['admin_rol']=="admin"||$_SESSION['admin_rol']=='finanzas')
                                    {
										if($state == 'pendiente') {
									?>
										<form action="aceptarpago.php" method="post" style="display:inline-block">
											<input type="hidden" name="user_id" value="<?php echo $id;?>">
											<button type="submit" class="btn btn-primary"> Aceptar </button>
										</form>
										<form action="rechazarpago.php" method="post" style="display:inline-block">
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
                                        echo '<a href="'.WEB_URL.'/admin/adminpagos.php?borrar=true&pago_id='.$id.'" class="btn btn-default">Eliminar Pago</a>';
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
		      <form action="rechazarpago.php" method="post">
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
