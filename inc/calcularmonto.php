<?php
$recargo = 3.9;
define('RECARGO', $recargo);
$pagartarjeta = calculo($estudiante, true);
$pagarefectivo = calculo($estudiante, false);

function calculo($estudiante, $card) {
    $fecha = time();
    $periodouno = strtotime('2018-01-22 00:00:00');
    $periododos = strtotime('2018-04-16 00:00:00');
    $periodotres = strtotime('2018-07-16 00:00:00');
    $precio="";

    if($_SESSION['pais'] =="DO"){
        if (($fecha >= $periodouno) && ($fecha < $periododos)) {
            $etapa="Primer Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "9500";
            } else{
                $precio = "11200";
            }
        }
        if (($fecha >= $periododos) && ($fecha < $periodotres)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "10900";
            } else{
                $precio = "11700";
            }
        }
        if ($fecha >= $periodotres) {
            $etapa="Tercer Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "11400";
            } else{
                $precio = "12000";
            }
        }
    }else{
        if (($fecha >= $periodouno) && ($fecha < $periododos)) {
            $etapa="Primer Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "195";
            } else{
                $precio = "230";
            }
        }
        if (($fecha >= $periododos) && ($fecha < $periodotres)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "225";
            } else{
                $precio = "240";
            }
        }
        if ($fecha >= $periodotres) {
            $etapa="Tercer Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "235";
            } else{
                $precio = "250";
            }
        }
    }
    $_SESSION['etapa'] = $etapa;
    if ($card == true) {
        $precio = (double)$precio / (1-((double)RECARGO / 100));
        return round($precio, 0, PHP_ROUND_HALF_UP);
    } else {
        return $precio;
    }
}

?>
