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

<section id="main">
	<div class="container">
			<h4 class="title">Contacta al delegado de tu país</h4>
            <table class="table table-bordered">
                <thead>
                    <tr >
                        <th scope="col" width="33%">
                            <p><b><span>Pais</span></b></p>
                        </th>
                        <th scope="col" width="33%">
                            <p><b><span>Nombre del delegado</span></b></p>
                        </th>
                        <th scope="col" width="33%">
                            <p><b><span>Contacto</span></b></p>
                        </th>
                    </tr>
                </thead>
                <tr >
                    <td>
                        <p><span>Nicaragua</span></p>
                    </td>
                    <td >
                        <p><span>Ivan Acevedo</span></p>
                    </td>
                    <td>
                        <p><span>(+505)82129207</span></p>
                    </td>
                </tr>
                <tr >
                    <td>
                        <p><span>Argentina</span></p>
                    </td>
                    <td >
                        <p><span>Olivia Brugna</span></p>
                    </td>
                    <td>
                        <p><span>(+5492)215379063</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Peru</span></p>
                    </td>
                    <td >
                        <p><span>Yosselyn V.</span></p>
                    </td>
                    <td>
                        <p><span>(+51)989302500</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>El Salvador</span></p>
                    </td>
                    <td >
                        <p><span>Daniel Salgado</span></p>
                    </td>
                    <td>
                        <p><span>(+503)79861300</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Uruguay</span></p>
                    </td>
                    <td >
                        <p><span>Richard Uruguay</span></p>
                    </td>
                    <td>
                        <p><span>(+598)99380556</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Chile</span></p>
                    </td>
                    <td >
                        <p><span>Bianca Salinas</span></p>
                    </td>
                    <td>
                        <p><span>(+569)33044814</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Bolivia</span></p>
                    </td>
                    <td >
                        <p><span>Cinthia Lopez</span></p>
                    </td>
                    <td>
                        <p><span>(+591)72221837</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Colombia</span></p>
                    </td>
                    <td >
                        <p><span>Victor Mantilla</span></p>
                    </td>
                    <td>
                        <p><span>(+57)3132066535</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Cuba</span></p>
                    </td>
                    <td >
                        <p><span>Danhiz Diaz Pereira</span></p>
                    </td>
                    <td>
                        <p><span>(+53)53474126</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Brazil</span></p>
                    </td>
                    <td >
                        <p><span>Livia Maia Braga</span></p>
                    </td>
                    <td>
                        <p><span>(+55)4198184039</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Venezuela</span></p>
                    </td>
                    <td >
                        <p><span>Luis Gonzalez</span></p>
                    </td>
                    <td>
                        <p><span>(+58)4241661142</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Costa Rica</span></p>
                    </td>
                    <td >
                        <p><span>Keyler Jimenez</span></p>
                    </td>
                    <td>
                        <p><span>(+506)83145401</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Honduras</span></p>
                    </td>
                    <td >
                        <p><span>Randolfo Ayala</span></p>
                    </td>
                    <td>
                        <p><span>(+504)32380409</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Guatemala</span></p>
                    </td>
                    <td >
                        <p><span>Adner Zuñiga</span></p>
                    </td>
                    <td>
                        <p><span>(+502)55789684</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Mexico</span></p>
                    </td>
                    <td >
                        <p><span>Sergio Medina</span></p>
                    </td>
                    <td>
                        <p><span>(+52)155514917983</span></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span>Ecuador</span></p>
                    </td>
                    <td >
                        <p><span>Evelyn Fonseca</span></p>
                    </td>
                    <td>
                        <p><span>(+593)995281199</span></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p><span>*Para Paraguay, Puerto Rico y Panamá
  contactar al (+1)8294431870 </span></p>
                    </td>
                </tr>
            </table>
	</div>
</section>

<?php include 'inc/footer.php'; ?>
