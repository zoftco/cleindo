<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
    require ('../inc/config.php');
    require ('../inc/conexion.php');
    require_once('php/sessioncontrol.php');
    $session = new sessioncontrol();
    if(!$session->isValid('admin_id')) {
        $session->redirect('login.php');
        exit;
    }

    if (isset($_GET['id'])) {
        $user_id=mysqli_real_escape_string($conexion,$_GET['id']);
        $userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$user_id'");
        $userData = mysqli_fetch_assoc($userData);
    } else {
        echo "No se proporcionó un id de Usuario";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Perfil para Administrador Clein</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body style="background-color:#e2e2e2">
		

  		<?php require ('menu.php');?>



		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Perfil</h1>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">
                    <form action="inc/perfil.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <label for="name">*Nombre Completo (como saldrá en el certificado)</label>
                            <input type="text" name="nombreyapellidoInput" id="nombreyapellidoInput" value="<?php echo $userData['nombreyapellidoInput']; ?>">
                        </div>

                        <div class="form-row">
                            <label for="name">*Correo Electrónico</label>
                            <input type="email" name="correoElectronico" id="correoElectronico" value="<?php echo $userData['correoElectronico']; ?>">
                        </div>

                        <hr />

                        <div class="form-row">
                            <label for="name">*Número de Teléfono / Whatsapp ej. +1 8294431870</label>
                            <input type="text" name="telefono" id="telefono" value="<?php echo $userData['telefono']; ?>">
                        </div>

                        <div class="form-row">
                            <label for="nivelacademico">*Nivel Académico</label>
                            <select name="nivelacademico" name="nivelacademico" id="nivelacademico" value="<?php echo $userData['estudiante']; ?>">
                                <option value="Estudiante">Estudiante</option>
                                <option value="Profesional">Profesional</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="pais">*País</label>
                            <input type="text" name="pais" id="pais" value="<?php echo $userData['pais']; ?>">
                            </input>
                        </div>

                        <div class="form-row">
                            <label for="facebook">Nombre en Facebook Ej. https://facebook.com/<span style="font-weight: bold">cleinaleiiaf</span></label>
                            <input type="text" name="facebook" id="facebook" value="<?php echo $userData['facebook']; ?>">
                        </div>

                        <div class="form-row">
                            <label for="instagram">Nombre en Instagram Ej. https://www.instagram.com/<span style="font-weight: bold">cleinrd2018</span></label>
                            <input type="text" name="instagram" id="instagram" value="<?php echo $userData['instagram']; ?>">
                        </div>

                        <div class="form-row">
                            <label for="idNumber">Nro. de Cédula o Pasaporte*</label>
                            <input type="text" name="idNumber" id="idNumber" value="<?php echo $userData['idNumber']; ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="fechaNacimiento">Fecha de Nacimiento*</label>
                            <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $userData['fechaNacimiento']; ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="universidad">Universidad de Procedencia*</label>
                            <input type="text" name="universidad" id="universidad" value="<?php echo $userData['universidad']; ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="carrera">Carrera Universitaria*</label>
                            <input type="text" name="carrera" id="carrera" list="carreraList" value="<?php echo $userData['carrera']; ?>" required>
                            <datalist id="carreraList">
                                <option value="Ingeniería Industrial">
                                <option value="Ingeniería Civil y/o de Construcción">
                                <option value="Ingeniería de Sistemas o Informática">
                                <option value="Ingeniería de Eléctrica o Electrónica">
                                <option value="Ingeniería Mecánica">
                                <option value="Otras Ingenierías">
                                <option value="Administración de Empresas y Afines">
                                <option value="Contabilidad y Afines">
                                <option value="Mercadeo y Afines">
                                <option value="Arquitectura y Afines">
                                <option value="Artes Plásticas, Visuales y Afines">
                                <option value="Ciencias y Afines">
                                <option value="Comunicación Social">
                                <option value="Derecho y Afines">
                                <option value="Economía">
                                <option value="Educacion y Afines">
                                <option value="Medicina y Afines">
                                <option value="Diseño y Afines">
                                <option value="Otra">
                            </datalist>
                        </div>
                </div>
            </div>
		</div>
			   
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
