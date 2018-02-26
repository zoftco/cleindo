<?php include 'inc/header.php'; ?>

<?php
	require('inc/conexion.php');
	if (isset($_SESSION['user_id'])) {
		if (($_SESSION['time'] + 3600) > time()) {
			$_SESSION['time'] = time() + 3600;
			$session_id = $_SESSION['user_id'];
			$userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
			$userData = mysqli_fetch_assoc($userData);
			$userState = $userData['estado'];
			$nacionalidad = $userData['pais'];
			$estudiante = $userData['estudiante'];
			if ($userState != 'cursos') {
				header("Location:inc/intermediador.php");
				exit;
			}
		} else {
			unset($_SESSION['time']);
			unset($_SESSION['user_id']);
			header("Location:log_in.php");
			exit;
		}
	} else {
		header("Location:log_in.php");
		exit;
	}

	$result = mysqli_query($conexion, "select 
		pilar.id as p_id, 
	    pilar.pilar as p_pilar,
	    pilar.fecha as p_fecha,
	    pilar.cupo as p_cupo,
	    pilar.salon as p_salon,	
	    pilar.tipo as p_tipo,
	    curso.id as c_id,
	    curso.fecha as c_fecha,
	    curso.titulo as c_titulo,
	    curso.conferencista as c_conferencista,
	    curso.nacionalidad as c_nacionalidad,
	    curso.enfoque as c_enfoque
	from pilar join curso on pilar.id = curso.pilar_id 
	order by pilar.fecha, curso.fecha, pilar.pilar");
	
	$cursos = array();

	while($row = mysqli_fetch_array($result)) { 
	  $cursos[] = array_map('utf8_encode', $row); 
	}

	$pilares = array();
	$charla = array();
	$id = 0;
	$idx = 0;

	foreach ($cursos as $k => $v) {
		if($id != $v['p_id']){
			$id = $v['p_id'];
			$pilares[$id]['p_id'] = $v['p_id'];
			$pilares[$id]['p_pilar'] = $v['p_pilar'];
			$pilares[$id]['p_fecha'] = $v['p_fecha'];
			$pilares[$id]['p_salon'] = $v['p_salon'];
			$pilares[$id]['p_cupo'] = $v['p_cupo'];
			$pilares[$id]['p_tipo'] = $v['p_tipo'];
		}
	}

	foreach ($cursos as $k => $v) {
		$id = $v['p_id'];
		$charla['c_id'] = $v['c_id'];
		$charla['c_fecha'] = $v['c_fecha'];
		$charla['c_titulo'] = $v['c_titulo'];
		$charla['c_conferencista'] = $v['c_conferencista'];
		$charla['c_nacionalidad'] = $v['c_nacionalidad'];
		$charla['c_enfoque'] = $v['c_enfoque'];
		$charla['p_id'] = $id;
		$pilares[$id]['charlas'][] = $charla;
	}

	$result = mysqli_query($conexion, "SELECT * FROM visita");
	
	$visitas = array();

	while($row = mysqli_fetch_array($result)) { 
	  $visitas[] = array_map('utf8_encode', $row); 
	}

	//print_r($visitas);die;

	//print_r($pilares);die;

	$result = mysqli_query($conexion, "SELECT pilar.id, pilar.fecha FROM pilar JOIN pilar_login ON pilar.id = pilar_login.pilar_id WHERE login_id = ".$_SESSION['user_id']);
	
	$mis_cursos = array();

	//print_r($result);die;

	while($row = mysqli_fetch_array($result)) { 
	  $mis_cursos_ids[] = $row['id']; 
	  $mis_cursos_fechas[] = $row['fecha']; 
	}



	$result = mysqli_query($conexion, "SELECT visita.id FROM visita JOIN visita_login ON visita.id = visita_login.visita_id WHERE login_id = ".$_SESSION['user_id']);
	
	$visita_ids = array();

	//print_r($result);die;

	while($row = mysqli_fetch_array($result)) { 
	  $visita_ids[] = $row['id'];
	}
?>

<link rel="stylesheet" href="css/cursosDisponibles.css">


<section id="main">
	<div class="container">
        <div id="crumbs">
            <ul>
                <li><a href="javascript:void();" class="success">Registro</a></li>
                <li><a href="javascript:void();" class="success">Validación de cuenta</a></li>
                <li><a href="javascript:void();" class="success">Verificación de pago</a></li>
                <li><a href="javascript:void();" class="active">Actividades</a></li>
            </ul>
        </div>
			<h4>Recibirás un mail de confirmación para que puedas volver a nuestra página y empezar a inscribirte a las actividades del congreso.</h4>
    </div>


<?php include 'inc/footer.php'; ?>