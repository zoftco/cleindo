<?php
if(!isset($_SESSION))
{
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('inc/config.php');
require('inc/conexion.php');
if (isset($_SESSION['user_id'])) {
    $session_id = $_SESSION['user_id'];
    $userData = mysqli_query($conexion, "SELECT * FROM login WHERE id = '$session_id'");
    $userData = mysqli_fetch_assoc($userData);
    $userState = $userData['estado'];
    $nacionalidad = $userData['pais'];
    $estudiante = $userData['estudiante'];
    if ($userState != 'pago') {
        header("Location:inc/intermediador.php");
        exit;
    }
} else {
    header("Location:log_in.php");
    exit;
}

$checkifUploaded = mysqli_query($conexion, "SELECT * FROM pagoefectivo WHERE idUsers='$session_id'");
$imageExists = mysqli_num_rows($checkifUploaded);
if ($imageExists == 0) {
    $contenido = "";
} else {
    $imgData = mysqli_fetch_assoc($checkifUploaded);
    $imgState = $imgData['estado'];
    $mensaje = $imgData['mensaje'];
    if ($imgState == 'pendiente') {
        $contenido = 'pendiente';
    } elseif ($imgState == 'rechazado') {
        $contenido = 'rechazado';
    }
}
require('inc/calcularmonto.php');

?>
<?php include 'inc/header.php'; ?>


<section id="main">
    <div class="container">
        <div id="crumbs">
            <ul>
                <li><a href="javascript:void();" class="success">Registro</a></li>
                <li><a href="javascript:void();" class="success">Validación de cuenta</a></li>
                <li><a href="javascript:void();" class="active">Verificación de pago</a></li>
                <li><a href="javascript:void();">Actividades</a></li>
            </ul>
        </div>
        <?php
        if ($contenido == "pendiente") {
            ?>
            <div class="form">
                <h4 class="title">Tu comprobante se ha recibido correctamente y se encuentra en estado de verificación.</h4>
                Recibiras un mail confirmando la validación de tu pago.
            </div>
            <?php
        }
        if ($contenido == "rechazado") {
            ?>

            <h4 class="title"><?php echo $mensaje;?></h4>
            <?php
        }
        if($contenido == "" || $contenido == "rechazado") {
            ?>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Pago por Western Union
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <p>Para realizar el pago por Western Union, debe realizar el envio a:</p>

                            <p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
                            <p>El monto de la inscripción es de: <?php echo $pagarefectivo;?> USD</p>
                            <p><strong>Obs:</strong> El monto indicado no incluye el recargo por envío, que se paga en Western Union y varía de acuerdo al país</p>
                            <h5>Datos del pago</h5>

                            <form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <label for="imgPago">Imagen Comprobante</label>
                                    <input type="file" name="imgPago" id="imgPago" required>
                                </div>

                                <div class="form-row">
                                    <label for="numFactura">Nro. de Factura</label>
                                    <input type="text" name="numFactura" id="numFactura" required>
                                </div>

                                <div class="form-row">
                                    <label for="nomParticipante">Participante a acreditar pago</label>
                                    <input type="text" name="nomParticipante" id="nomParticipante" required>
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $session_id;?>">
                                </div>
                                <div class="form-row">
                                    <input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pago en Efectivo
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <p>Para realizar el pago en efectivo, debe realizar el depósito en:</p>
                            <p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
                            <p>El monto total a pagar es de: <strong><?php echo $pagarefectivo;?> USD</strong></p>

                            <h5>Datos del pago</h5>

                            <form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <label for="imgPago">Imagen Comprobante</label>
                                    <input type="file" name="imgPago" id="imgPago" required>
                                </div>

                                <div class="form-row">
                                    <label for="name">Número de Factura</label>
                                    <input type="text" name="numFactura" id="" required>
                                </div>

                                <div class="form-row">
                                    <label for="name">Participante a acreditar pago</label>
                                    <input type="text" name="nomParticipante" id="" required>
                                    <input type="hidden" name="user_id" value="<?php echo $session_id;?>">
                                </div>
                                <div class="form-row">
                                    <input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Pago por Paypal o Tarjeta de crédito
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                                <p>El monto de la inscripción es de: <?php echo $pagarefectivo;?> USD</p>
                                <p>El cargo de Paypal o Tarjeta de Crédito es de <?php echo $pagartarjeta-$pagarefectivo;?> USD</p>
                                <p>El monto total a pagar es <?php echo $pagartarjeta;?> USD</p>
                                <input name="user_id" type="hidden" value="<?php echo $session_id?>"></input>
                            <div class="form-row">
                                <input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
