<?php include 'inc/header.php'; ?>
<!--Barra de Usuario Logueado-->
<?php
if(isset($_SESSION['user_name'])) {
?>
<div class="userbar">
<div class="container">
Bienvenido/a <strong><?php echo $_SESSION['user_name'];?></strong> <!-- <a href="mis_cursos.php" class="button azul mini">Mis Cursos</a> --> <a href="cursos_disponibles.php" class="button azul mini">Cursos Disponibles</a> <a href="inc/cerrarsesion.php" class="button azul mini">Salir</a>
</div>
</div>
<?php
}
?>

<!--Barra de Usuario Logueado-->
<div class="container-fluid">
        <img src="img/INSCRIPCION.jpg" alt="Día 1: Integración" width="100%">
</div>

<section id="main">
	<div class="container">
        <h4 class="title">¿CÓMO INSCRIBIRME?</h4>
        <p>1. Crea tu usuario</p>
        <p>*Si eres estudiante debes anexar un soporte (Carnet estudiantil vigente, certificado de estudio, certificado de matricula vigente).</p>
        <p>2. Espera el correo de confirmación con los medios de pago.</p>
        <p>3. Realiza tu pago y luego carga la evidencia de la realización del pago en tu usuario.</p>
        <p>4. Te llegara un correo confirmando tu inscripción al evento.</p>

        <table class="table-bordered" style="text-align: center;">
            <tr >
                <td width=679 colspan=3  style='width:100%'>
                    <p ><span >INSCRIPCIÓN CLEIN RD 2018</span></p>
                </td>
            </tr>
            <tr style='height:23.2pt'>
                <td style='width:25%;'>
                    <p ><span >Tipo de Inscripción</span></p>
                </td>
                <td style='width:50%;'>
                    <p ><span >Fechas de Pago</span></p>
                </td>
                <td style='width:25%;'>
                    <p ><span >Precio (USD)</span></p>
                </td>
            </tr>
            <tr >
                <td width=221>
                    <p ><span >Estudiantes</span></p>
                </td>
                <td width=316 rowspan=2>
                    <p><span >22 de enero al 15 de abril</span></p>
                </td>
                <td   >
                    <p ><span >195</span></p>
                </td>
            </tr>
            <tr >
                <td width=221 >
                    <p ><span >Profesionales</span></p>
                </td>
                <td   >
                    <p ><span >230</span></p>
                </td>
            </tr>
            <tr >
                <td width=221 >
                    <p ><span >Estudiantes</span></p>
                </td>
                <td width=316 rowspan=2 >
                    <p ><span >16 de abril al 15 de julio</span></p>
                </td>
                <td   >
                    <p ><span >225</span></p>
                </td>
            </tr>
            <tr >
                <td width=221 >
                    <p ><span >Profesionales</span></p>
                </td>
                <td   >
                    <p ><span >240</span></p>
                </td>
            </tr>
            <tr >
                <td width=221 >
                    <p ><span >Estudiantes</span></p>
                </td>
                <td width=316 rowspan=2 >
                    <p ><span >16 de julio al 28 de septiembre</span></p>
                </td>
                <td   >
                    <p ><span >235</span></p>
                </td>
            </tr>
            <tr >
                <td width=221 >
                    <p ><span >Profesionales</span></p>
                </td>
                <td   >
                    <p ><span >250</span></p>
                </td>
            </tr>
        </table>


        <h4 class="title">PAGOS INTERNACIONALES</h4>
        <p>WESTERN UNION</p>
        <p>Enrique Ramirez</p>
        <p>CC. xxxxxxxx</p>
        <p>País: Republica Dominicana</p>
        <p>Ciudad: Santo Domingo
        </p>
        <h4 class="title">PAGOS PAYPAL</h4>
    </div>
</section>

<?php include 'inc/footer.php'; ?>
