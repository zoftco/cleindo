	<?php
	$query= mysqli_query($conexion, "SELECT conversion FROM tasa");
	$tasa = mysqli_fetch_assoc($query);
	$tasa = $tasa['conversion'];
	define('TASA', $tasa);

	class Guaranies {
		function convertir($dolares) {
			return (int)$dolares*TASA;
		}
	}

	$montoGuaranies = new Guaranies;
	$montoFinal = $montoGuaranies->convertir((int)$pagar);

		
?>
