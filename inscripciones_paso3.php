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
    $_SESSION['pais'] = $userData['pais'];
    $pais = $_SESSION['pais'];
    $_SESSION['etapa'] = "";
    $estudiante = $userData['estudiante'];
    if ($userState != 'pago') {
        header("Location:inc/intermediador.php");
        exit;
    }
} else {
    header("Location:log_in.php");
    exit;
}
$contenido = "";
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
                <li><a href="inscripciones_concurso.php">Concurso Ponencia</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-4"><?php echo $userData['nombreyapellidoInput']; ?></div>
            <div class="col-md-2"><?php echo $estudiante; ?></div>
            <div class="col-md-2"><?php echo $userData['pais']; ?></div>
            <div class="col-md-2"><?php echo $_SESSION['etapa']; ?></div>
            <div class="col-md-2"><a href="inc/cerrarsesion.php" class="button azul mini">Cerrar Sesión</a></div>
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
                <?php
                if($pais=="DO")
                {
                ?>
                    <div id="pagoEfectivo" class="card">
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
                                <p>Banco Popular Dominicano</p>
                                <p>Cuenta de Ahorro 805871720</p>
                                <p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
                                <p>El monto total a pagar es de: <strong><?php echo $pagarefectivo;?> RD$</strong></p>

                                <h5>Datos del pago</h5>

                                <form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <label for="imgPago">Imagen Comprobante</label>
                                        <input type="file" name="imgPago" id="imgPago" required>
                                    </div>

                                    <div class="form-row">
                                        <label for="name">Número de Comprobante (número de referencia del Banco)</label>
                                        <input type="text" name="numFactura" id="numFactura" required>
                                    </div>

                                    <div class="form-row">
                                        <label for="name">Participante a acreditar pago</label>
                                        <input type="text" name="nomParticipante" id="nomParticipante" required>
                                        <input type="hidden" name="user_id" value="<?php echo $session_id;?>">
                                    </div>
                                    <div class="form-row">
                                        <input id="botonSiguientePago" type="submit" value="Siguiente" class="button enviarform">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div id="pagoPaypal" class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Pago por Paypal o Tarjeta de crédito
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p>El monto de la inscripción es de: <?php echo $pagarefectivo;?> USD</p>
                                <p>El cargo de Paypal o Tarjeta de Crédito es de <?php echo $pagartarjeta-$pagarefectivo;?> USD</p>
                                <p>El monto total a pagar es <?php echo $pagartarjeta;?> USD</p>
                                <form action="inc/pagoPaypal.php" method="post" enctype="multipart/form-data">
                                    <div id="paypal-button-message" class="form-row"></div>
                                    <div id="paypal-button" class="form-row"></div>
                                    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                                    <script>
                                        paypal.Button.render({
                                            env: 'production', // 'production' Or 'sandbox',
                                            client: {
                                                sandbox:    'AeycuD71QxUAn_mqJ6eM4241t0WK5TjQAVqd4eW0srvPiR0rvXlNAtJsyJNgvrJv-wKDeWsffG5BVhAK',
                                                production: 'Ac8cscWdNd44lm4FJXTi9SZJ1db-vPxPCtvi1yxIvzQo6LtLFc8MdOkJvoA8UI4-UKPe6fqrizuuR0d6'
                                            },
                                            locale: 'es_ES',
                                            commit: true, // Show a 'Pay Now' button

                                            style: {
                                                color: 'gold',
                                                size: 'large'
                                            },

                                            payment: function(data, actions) {
                                                return actions.payment.create({
                                                    payment: {
                                                        transactions: [
                                                            {
                                                                amount: { total: "<?php echo $pagartarjeta; ?>", currency: 'USD' },
                                                                item_list: {
                                                                    items: [


                                                                        {
                                                                            name: "Inscripcion CLEIN RD",
                                                                            description: "Profesional <?php echo $_SESSION['etapa']; ?>",
                                                                            quantity: "1",
                                                                            price: "<?php echo $pagarefectivo; ?>",
                                                                            currency: "USD"
                                                                        },
                                                                        {
                                                                            name: "Cargo Paypal",
                                                                            description: "Profesional <?php echo $_SESSION['etapa']; ?>",
                                                                            quantity: "1",
                                                                            price: "<?php echo $pagartarjeta-$pagarefectivo; ?>",
                                                                            currency: "USD"
                                                                        }
                                                                    ]
                                                                }
                                                            }
                                                        ]
                                                    },
                                                    experience: {
                                                        input_fields: {
                                                            no_shipping: 1
                                                        }
                                                    }
                                                });
                                            },

                                            onAuthorize: function(data, actions) {
                                                return actions.payment.execute().then(function(payment) {
                                                    document.querySelector('#paypal-button')
                                                        .innerText = 'Pago efectuado exitosamente';
                                                    document.querySelector('#paymentid').value=payment.id;
                                                    document.querySelector('#paymentstate').value=payment.state;
                                                    document.querySelector('#botonSiguientePagoPaypal').style="visibility:visible";
                                                });
                                            },

                                            onCancel: function(data, actions) {
                                                document.querySelector('#paypal-button-message')
                                                    .innerText = 'Pago ha sido cancelado, intente nuevamente';
                                            },

                                            onError: function(err) {
                                                document.querySelector('#paypal-button-message')
                                                    .innerText = 'Ocurrió un error, intente nuevamente '+ err;
                                            }
                                        }, '#paypal-button');
                                    </script>
                                    <div class="form-row">
                                    <input id="nombreyapellidoInput" name="nombreyapellidoInput" type="hidden" value="<?php echo $userData['nombreyapellidoInput'];?>">
                                    <input id="paymentid" name="paymentid" type="hidden" value="">
                                    <input id="paymentstate" name="paymentstate" type="hidden" value="">
                                    </div>
                                <div class="form-row">
                                    <input id="botonSiguientePagoPaypal" type="submit" value="Siguiente" class="button enviarform" style="visibility:hidden;">
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div id="pagoWesternUnion" class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Pago por Western Union
                            </button>
                        </h5>
                    </div>

                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <p>Para realizar el pago por Western Union, debe realizar el envio a:</p>
                            <p><span style="font-weight: bold">José Enrique Ramírez (cédula: 001-1328380-8)</span></p>
                            <p>Luego deberá ingresar en su cuenta los datos del recibo para la posterior verificación del pago.</p>
                            <p>El monto de la inscripción es de: <?php echo $pagarefectivo;?> USD</p>
                            <p><strong>Obs:</strong> El monto a pagar depende de la etapa de inscripción + el monto de gestión por cada transacción en República Dominicana (USD 3.00) + la tasa de envío del país de origen, que se paga en Western Union y varía de acuerdo al país</p>
                            <h5>Datos del pago</h5>

                            <form action="inc/pagoEfectivo.php" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <label for="imgPago">Imagen Comprobante</label>
                                    <input type="file" name="imgPago" id="imgPago" required>
                                </div>

                                <div class="form-row">
                                    <label for="numFactura">Nro. de Comprobante (código de referencia de Western Union)</label>
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
                <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
