<?php
    require ('../inc/config.php');
    require ('../inc/conexion.php');
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
                                if ($perfil[$key]['usuarioaprobadorDocumento'] == "" )
                                {
                                    $administradores[$perfil[$key]['usuarioaprobadorDocumento']]="";
                                };
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
                                    <a href="<?php echo WEB_URL.$perfil[$key]['rutaDocumento'];?>" target="_blank"><?php echo $perfil[$key]['rutaDocumento'];?></a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
								<td>
                                            <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                            <p>Fecha Revisión: <?php echo $perfil[$key]['fechaestadoDocumento'];?></p>
                                            <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
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
                            if ($perfil[$key]['usuarioaprobadorDocumento'] == "" )
                            {
                                $administradores[$perfil[$key]['usuarioaprobadorDocumento']]="";
                            };
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
                                    <a href="<?php echo WEB_URL.$perfil[$key]['rutaDocumento'];?>" target="_blank"><?php echo $perfil[$key]['rutaDocumento'];?></a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
                                <td>
                                        <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                        <p>Fecha Revisión: <?php echo $perfil[$key]['estadoDocumento'];?></p>
                                        <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
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
                    <h3>Validación de Título</h3>
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
                        $query = mysqli_query($conexion, "SELECT * FROM concurso LEFT JOIN (SELECT * FROM login) AS usuario ON (concurso.idlogin = usuario.id) WHERE concurso.tipoDocumento LIKE 'titulo'");
                        $perfil = array();
                        while($row = mysqli_fetch_assoc($query)) {
                            $perfil[] = $row;
                        }
                        foreach ($perfil as $key=>$value) {
                            if ($perfil[$key]['usuarioaprobadorDocumento'] == "" )
                            {
                                $administradores[$perfil[$key]['usuarioaprobadorDocumento']]="";
                            };
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
                                    <a href="<?php echo WEB_URL.$perfil[$key]['rutaDocumento'];?>" target="_blank"><?php echo $perfil[$key]['rutaDocumento'];?></a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
                                <td>
                                        <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                        <p>Fecha Revisión: <?php echo $perfil[$key]['estadoDocumento'];?></p>
                                        <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
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
                            if ($perfil[$key]['usuarioaprobadorDocumento'] == "" )
                            {
                                $administradores[$perfil[$key]['usuarioaprobadorDocumento']]="";
                            };
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
                                    <a href="<?php echo WEB_URL.$perfil[$key]['rutaDocumento'];?>" target="_blank"><?php echo $perfil[$key]['rutaDocumento'];?></a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
                                <td>
                                        <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                        <p>Fecha Revisión: <?php echo $perfil[$key]['fechaestadoDocumento'];?></p>
                                        <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
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
                            if ($perfil[$key]['usuarioaprobadorDocumento'] == "" )
                            {
                                $administradores[$perfil[$key]['usuarioaprobadorDocumento']]="";
                            };
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
                                    <a href="<?php echo WEB_URL.$perfil[$key]['rutaDocumento'];?>" target="_blank"><?php echo $perfil[$key]['rutaDocumento'];?></a>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['fechaenvioDocumento'];?>
                                </td>
                                <td>
                                    <?php echo $perfil[$key]['estadoDocumento'];?>
                                </td>
                                <td>
                                        <p>Revisado por: <?php echo $administradores[$perfil[$key]['usuarioaprobadorDocumento']];?></p>
                                        <p>Fecha Revisión: <?php echo $perfil[$key]['estadoDocumento'];?></p>
                                        <p>Comentarios: <?php echo $perfil[$key]['mensajeDocumento'];?></p>
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
			   
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>