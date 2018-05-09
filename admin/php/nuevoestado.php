<?php
/**
 * Created by PhpStorm.
 * User: ferna
 * Date: 2018-05-09
 * Time: 00:57
 */

function nuevoestado($estado)
{
    switch($estado)
    {
        case "pago":
            return("pago pendiente");
            break;
        case "cursos":
            return("pago completado");
            break;
        default:
            return($estado);
            break;
    }
}

