<?php
	$imgFactura=$_FILES['imgFactura'];
	$numFactura=$_POST['numFactura'];
	$nomParticipante=$_POST['nomParticipante'];
	$idUsers=$_POST['user_id'];
	$locationimgFacturas='../images/userfiles/pagoefectivo/factura='.$idUsers.'.png';
	$locationimgFacturas4Db='/images/userfiles/pagoefectivo/factura='.$idUsers.'.png';
	require ('conexion.php');
	$existeImagen = mysqli_query($conexion, "DELETE FROM pagoefectivo WHERE idUsers='$idUsers'");
	move_uploaded_file($imgFactura['tmp_name'], $locationimgFacturas);
	$query= mysqli_query($conexion, "INSERT INTO pagoefectivo (imgFactura, numFactura, nomParticipante, idUsers, estado) VALUES ('$locationimgFacturas4Db', '$numFactura', '$nomParticipante', '$idUsers', 'pendiente')");
	header("Location:../inscripciones_paso2.php");
?>