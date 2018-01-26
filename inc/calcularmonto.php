<?php
	$recargo = 4.70;
	define('RECARGO', $recargo);
	$pagartarjeta = calculo($estudiante, true);
	$pagarefectivo = calculo($estudiante, false);



	function calculo($estudiante, $card) {
			$fecha = time();
			$periodouno = strtotime('2015-01-22 00:00:00');
			$periododos = strtotime('2015-04-16 00:00:00');
			$periodotres = strtotime('2018-07-16 00:00:00');

			// echo $fecha.':ahora<br/>';
			// echo $periodouno2.':despues<br/>';
			$precio="";
			
			if (($fecha >= $periodouno) && ($fecha < $periododos)) {
				if ($estudiante=="Estudiante") {
					$precio = "195";
				} else{
					$precio = "230";
				}
			}
            if (($fecha >= $periododos) && ($fecha < $periodotres)) {
                if ($estudiante=="Estudiante") {
                    $precio = "225";
                } else{
                    $precio = "240";
                }
            }
            if ($fecha >= $periodotres) {
                if ($estudiante=="Estudiante") {
                    $precio = "235";
                } else{
                    $precio = "250";
                }
            }
			
			if ($card == true) {
				$precio = (double)$precio / (1-((double)RECARGO / 100));
				return round($precio, 0, PHP_ROUND_HALF_UP);
			} else {
				return $precio;
			}
	}

?>
