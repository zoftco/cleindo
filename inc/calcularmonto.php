<?php
$recargo = 3.9;
define('RECARGO', $recargo);
$pagartarjeta = calculopaypal($estudiante);
$pagarpaypal = calculopaypalneto($estudiante);
$precioaleiiaf = "230";
$precioaleiiaftotal = round((double)$precioaleiiaf / (1-((double)RECARGO / 100)), 0, PHP_ROUND_HALF_UP);
$pagarefectivo = calculo($estudiante, false);

function calculo($estudiante, $card) {
    $fecha = time();
    $periodouno = strtotime('2018-01-22 00:00:00');
    $periododos = strtotime('2018-04-16 00:00:00');
    $periododosdescuento = strtotime('2018-04-30 00:00:00');
    $periodotresdescuento = strtotime('2018-08-20 04:00:00');
    $periodotresdescuentofinal = strtotime('2018-08-22 04:00:00');
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
        if (($fecha >= $periododos) && ($fecha < $periododosdescuento)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "9900";
            } else{
                $precio = "11200";
            }
        }
        if (($fecha >= $periododosdescuento) && ($fecha < $periodotres)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "9900";
            } else{
                $precio = "11200";
            }
        }
        if ($fecha >= $periodotres) {
            $etapa="Tercer Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "9900";
                $preciopaypal = "195";
            } else{
                $precio = "11200";
                $preciopaypal = "230";
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
        if (($fecha >= $periododos) && ($fecha < $periododosdescuento)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "205";
            } else{
                $precio = "230";
            }
        }
        if (($fecha >= $periododosdescuento) && ($fecha < $periodotres)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "225";
            } else{
                $precio = "240";
            }
        }
        if (($fecha >= $periodotresdescuento) && ($fecha < $periodotresdescuentofinal)) {
            $etapa="Tercer Etapa Descuento 20/08";
            if ($estudiante=="Estudiante") {
                $precio = "195";
            } else{
                $precio = "230";
            }
        }
        if ($fecha >= $periodotresdescuentofinal) {
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

function calculopaypal($estudiante) {
    $fecha = time();
    $periodouno = strtotime('2018-01-22 00:00:00');
    $periododos = strtotime('2018-04-16 00:00:00');
    $periododosdescuento = strtotime('2018-04-30 00:00:00');
    $periodotresdescuento = strtotime('2018-08-20 04:00:00');
    $periodotresdescuentofinal = strtotime('2018-08-22 04:00:00');
    $periodotres = strtotime('2018-07-16 00:00:00');
    $precio="";

    if($_SESSION['pais'] =="DO"){
            $etapa="Tercer Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "195";
            } else{
                $precio = "230";
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
        if (($fecha >= $periododos) && ($fecha < $periododosdescuento)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "205";
            } else{
                $precio = "230";
            }
        }
        if (($fecha >= $periododosdescuento) && ($fecha < $periodotres)) {
            $etapa="Segunda Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "225";
            } else{
                $precio = "240";
            }
        }
        if (($fecha >= $periodotresdescuento) && ($fecha < $periodotresdescuentofinal)) {
            $etapa="Tercer Etapa Descuento 20/08";
            if ($estudiante=="Estudiante") {
                $precio = "195";
            } else{
                $precio = "230";
            }
        }
        if ($fecha >= $periodotresdescuentofinal) {
            $etapa="Tercer Etapa";
            if ($estudiante=="Estudiante") {
                $precio = "235";
            } else{
                $precio = "250";
            }
        }
    }
    $_SESSION['etapa'] = $etapa;
    $precio = (double)$precio / (1-((double)RECARGO / 100));
    return round($precio, 0, PHP_ROUND_HALF_UP);
}

function calculopaypalneto($estudiante) {
    $fecha = time();
    $periodouno = strtotime('2018-01-22 00:00:00');
    $periododos = strtotime('2018-04-16 00:00:00');
    $periododosdescuento = strtotime('2018-04-30 00:00:00');
    $periodotresdescuento = strtotime('2018-08-20 04:00:00');
    $periodotresdescuentofinal = strtotime('2018-08-22 04:00:00');
    $periodotres = strtotime('2018-07-16 00:00:00');
    $etapa="";
    $preciopaypal=0;

    if($_SESSION['pais'] =="DO"){
        $etapa="Tercer Etapa";
        if ($estudiante=="Estudiante") {
            $preciopaypal = "195";
        } else{
            $preciopaypal = "230";
        }
    }
    $_SESSION['etapa'] = $etapa;
    return $preciopaypal;
}

?>
