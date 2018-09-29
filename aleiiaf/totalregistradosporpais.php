<?php
    require ('../inc/config.php');
	require ('../inc/conexion.php');
    require ('../admin/php/nuevoestado.php');
	$url = WEB_URL;
    $query = mysqli_query($conexion, "SET @row_number=0");
	$query = mysqli_query($conexion, "SELECT *,(@row_number:=@row_number + 1) AS num FROM login ORDER BY pais, estado");
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
		

  		<?php require('menu.php');?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
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
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($estado as $key=>$value) {
									$universidad = $estado[$key]['universidad'];
									$nombre = $estado[$key]['nombreyapellidoInput'];
									$email = $estado[$key]['correoElectronico'];
									$pais = $estado[$key]['pais'];
									$estudiante = $estado[$key]['estudiante'];
                                    $universidad = $estado[$key]['universidad'];
                                    $fechaNacimiento = $estado[$key]['fechaNacimiento'];
                                    $carrera = $estado[$key]['carrera'];
                                    $instagram = $estado[$key]['instagram'];
                                    $facebook = $estado[$key]['facebook'];
									$state = $estado[$key]['estado'];
									$id = $estado[$key]['id'];
                                    $num = $estado[$key]['num'];
									$telefono = $estado[$key]['telefono'];
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
			   
		<script src="js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
