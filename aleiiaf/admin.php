<?php
    require ('../inc/config.php');
    require ('../inc/conexion.php');
	$url = WEB_URL;
	$query = mysqli_query($conexion, "SELECT * FROM imagenes LEFT JOIN (SELECT login.pais, login.estudiante, login.nombreyapellidoInput, login.correoElectronico, login.id FROM login) AS usuarios ON (imagenes.user_id = usuarios.id) ORDER BY field (estado, 'pendiente', 'aceptado', 'rechazado')");
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
								<th>Nacionalidad</th>
								<th>Estudiante</th>
								<th>Correo Electronico</th>
								<th style="width: 350px;">Documentos</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($estado as $key=>$value) {
                                    $imagenes_id = $estado[$key]['id'];
									$fotoFactura = $estado[$key]['fotoFactura'];
                                    $fotoDocumento2 = $estado[$key]['fotoDocumento2'];
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
                                            <a href="<?php echo $fotoFactura;?>"><img src="<?php echo $fotoFactura;?>" width="100px"/></a>
									<?php
										}
									?>

									<?php
										if ($fotoCedula != "") {
											$fotoCedula = $url.$fotoCedula;
									?>
                                            <a href="<?php echo $fotoCedula;?>"><img src="<?php echo $fotoCedula;?>" width="100px"/></a>
									<?php
										}
									?>

                                    <?php
                                    if ($fotoDocumento2 != "") {
                                        $fotoDocumento2 = $url.$fotoDocumento2;
                                        ?>
                                        <a href="<?php echo $fotoDocumento2;?>"><img src="<?php echo $fotoDocumento2;?>" width="100px"/></a>
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
			   
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>