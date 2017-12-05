<?php
	$recargo = 5.75;
	define('RECARGO', $recargo);
	class calcularMonto {
		function calculo($nacionalidad, $estudiante, $card, $session_id) {
			$fecha = time();

			$periodouno1 = strtotime('2015-03-25 00:00:00');
			$periodouno2 = strtotime('2015-06-07 00:00:00');

			$periododos1 = strtotime('2015-06-07 00:00:00');
			$periododos2 = strtotime('2015-08-01 00:00:00');

			$periodotres1 = strtotime('2015-08-01 00:00:01');
			$periodotres2 = strtotime('2015-10-25 11:59:59');

			// echo $fecha.':ahora<br/>';
			// echo $periodouno2.':despues<br/>';
			$precio="";	
			
			if (!$nacionalidad && !$estudiante) {
				header('Location:'.WEB_URL.'/error.php');
				exit;
			}
			
			if (($fecha >= $periodouno1) && ($fecha < $periodouno2)) {
				if (($nacionalidad != "PY") && ($estudiante=="si")) {
					$precio = "190";
				} elseif (($nacionalidad != "PY") && ($estudiante=="no")) {
					$precio = "210";
				} elseif (($nacionalidad == "PY") && ($estudiante=="si")) {
					$precio = "150";
				} elseif (($nacionalidad == "PY") && ($estudiante=="no")) {
					$precio = "190";
				}
			} elseif (($fecha >= $periododos1) && ($fecha < $periododos2)) {
				if (($nacionalidad != "PY") && ($estudiante=="si")) {
					$precio = "210";
				} elseif (($nacionalidad != "PY") && ($estudiante=="no")) {
					$precio = "230";
				} elseif (($nacionalidad == "PY") && ($estudiante=="si")) {
					$precio = "170";
				} elseif (($nacionalidad == "PY") && ($estudiante=="no")) {
					$precio = "210";
				}
			} elseif (($fecha >= $periodotres1) && ($fecha < $periodotres2)) {
				
				if ($session_id == 139 || $session_id == 219 || $session_id == 86) {
					$precio = "190";
				} else {
					if (($nacionalidad != "PY") && ($estudiante="si")) {
					$precio = "230";
				} elseif (($nacionalidad != "PY") && ($estudiante=="no")) {
					$precio = "250";
				} elseif (($nacionalidad == "PY") && ($estudiante=="si")) {
					$precio = "190";
				} elseif (($nacionalidad == "PY") && ($estudiante=="no")) {
					$precio = "230";
				}
				}
			}
			
			if ($card == true) {
				$precio = (double)$precio / (1-((double)RECARGO / 100));
				return round($precio, 0, PHP_ROUND_HALF_UP);
			} else {
				return $precio;
			}
		}
	}
	$monto = new calcularMonto;
	$pagar = $monto->calculo($nacionalidad, $estudiante, true, $session_id);
	$pagarefectivo = $monto->calculo($nacionalidad, $estudiante, false, $session_id);
?>
