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
	$url = WEB_URL;
	
	$query = mysqli_query($conexion,
        "SELECT * FROM pagoefectivo 
                LEFT JOIN (SELECT login.nombreyapellidoInput, login.correoElectronico, login.id FROM login) AS usuarios 
                ON (pagoefectivo.idUsers = usuarios.id) 
                WHERE pagoefectivo.numFactura LIKE '%PAY%' 
                ORDER BY fechacreacion DESC");
	$estado = array();
	while($row = mysqli_fetch_assoc($query)) {
		$estado[] = $row;
	}
?>

<!DOCTYPE html>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $borrar_id = $_GET['pago_id'];
    mysqli_query($conexion, "DELETE FROM pagoefectivo WHERE idUsers = '$borrar_id'");
    header('Location:'.WEB_URL.'/admin/adminpagos.php');
}
?>

<?php
if(isset($_GET['borrar'])&&($_SESSION['admin_rol']=='admin'||$_SESSION['admin_rol']=='finanzas')) {
$id = $_GET['pago_id'];
?>
    <div class="alert alert-danger">
        <div class="row">
            <div class="col-md-11">
                <h3>¿Está seguro que desea eliminar el pago?</h3>
                <p>Tenga en cuenta que este procedimiento no puede ser revertido.</p>
            </div>
        </div>
        <!--<form id="confirmleteform" method="post" action="includestrmgmt.php">-->
        <table class="actionbtntable table">
            <tbody>
            <tr>
                <td class="actionfield nopadding">
                    <a href="<?php echo WEB_URL;?>/admin/adminpagos.php?action=delete&pago_id=<?php echo $id;?>"class="btn btn-danger">Eliminar</button></a>
                    <a href="<?php echo WEB_URL;?>/admin/adminpagos.php" class="btn btn-default">Cancelar</a>
                </td>
            </tr>
            </tbody>
        </table>
        <!--</form>-->
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
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Estado</th>
								<th>Participante</th>
								<th>Correo Electronico</th>
								<th>idTransacción</th>
								<th>Nro. de Factura</th>
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
                                    $idtransaccion = $estado[$key]['idtransaccion'];
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
                                    if ($idtransaccion != "") {
                                        echo ' <a href="https://www.paypal.com/activity/payment/' . $idtransaccion . '" target="_blank">Ver en Paypal: '.$idtransaccion.'</a>';
                                    }
                                    ?>
								</td>

								<td>
									<?php
                                    echo $numFactura;
                                    ?>
								</td>
								

								<td>

									<?php
                                    if($_SESSION['admin_rol']=="admin"||$_SESSION['admin_rol']=='finanzas')
                                    {
										if(true) {
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
