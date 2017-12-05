
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
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require ('../inc/conexion.php');
	$megaquery = mysqli_query($conexion, "SELECT * FROM ((SELECT uuid AS trans_id, id_pago, nombreyapellidoInput FROM (SELECT * FROM (SELECT 			id_pago, uuid FROM zadmin_clein.transacciones) AS temptable LEFT JOIN zadmin_clein.login ON (zadmin_clein.login.id = temptable.id_pago)) AS 	temptable2)) AS 		temptable3 LEFT JOIN zadmin_procard.transactions ON (temptable3.trans_id = zadmin_procard.transactions.uuid)");
	
	$megaarray = array();

	while ($row = mysqli_fetch_assoc($megaquery)) {
		$megaarray[] = $row;
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
								<th>ID</th>
								<th>Nombre</th>
								<th>Estado</th>			
								<th>Monto</th>
								<th>Fecha</th>
								<th>Success</th>
								<th>Autorización</th>
								<th>TimeOut</th>
								<th>Intentos</th>
								<th>Numero Tarjeta</th>
								<th>Codigo Referencia</th>
								<th>Codigo Autorizacion de Respuesta</th>
								
								<th>Cuotas</th>
								<th>Clase</th>
								<th>UUID</th>
								<th>Descripción</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($megaarray as $key=>$value) {
										$ID = $megaarray[$key]['id_pago'];
										$nombre = $megaarray[$key]['nombreyapellidoInput'];
										$status = $megaarray[$key]['status'];
										$success = $megaarray[$key]['success'];
										$autori = $megaarray[$key]['AuthorizationExecuted'];
										$tiempo = $megaarray[$key]['TimedOut'];
										$intentos = $megaarray[$key]['MaxAttempts'];
										$num = $megaarray[$key]['CardNumber'];
										$codRef = $megaarray[$key]['CodRefAut'];
										$codResp = $megaarray[$key]['CodRefAut'];
										$cuotas = $megaarray[$key]['CantCuotas'];
										$clase = $megaarray[$key]['TarClase'];
										$monto = $megaarray[$key]['amount'];
										$fecha = $megaarray[$key]['created'];
										$uuid = $megaarray[$key]['uuid'];
										$descripcion = $megaarray[$key]['DescRespAut'];
										
										if ($descripcion) {

													
										
									
							?> 	
							<tr>


								


								<td>
									<?php echo $ID;?>
								</td>
								<td>
									<?php echo $nombre;?>
								</td>
								<td><?php echo $status;?></td>
								<td>
									<?php echo $monto;?>
								</td>
								
								<td>
									<?php echo $fecha;?>
								</td>
								<td><?php echo $success;?></td>
								<td><?php echo $autori;?></td>
								<td><?php echo $tiempo;?></td>
								<td><?php echo $intentos;?></td>
								<td><?php echo $num;?></td>
<td><?php echo $codRef;?></td>
<td><?php echo $codResp;?></td>
<td><?php echo $cuotas;?></td>
<td><?php echo $clase;?></td>
								<td>
									<?php echo $uuid;?>
								</td>
								<td>
									<?php echo $descripcion;?>
								</td>
							
								
								
							</tr>
							<?php
	}	
								// end foreach
								}
							?>
						</tbody>	
					</table>
				</div>
			</div>
		</div>

		

			   
		
		
	</body>
</html>

