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
    if ($userState != 'cursos') {
        header("Location:inc/intermediador.php");
        exit;
    }

    $pago = mysqli_query($conexion,"select * from pagoefectivo where idUsers = '$session_id'");
    $pago = mysqli_fetch_assoc($pago);

    $visitas = mysqli_query($conexion, "SELECT * FROM visita");
    $result_visita = mysqli_query($conexion, "SELECT visita.id FROM visita JOIN visita_login ON visita.id = visita_login.visita_id WHERE login_id = ".$session_id);
    $visita_ids = array();
    while($row = mysqli_fetch_array($result_visita)) {
        $visita_ids[] = $row['id'];
    }

    $inscritos = mysqli_query($conexion, "SELECT id_actividad, COUNT(id) as inscritos FROM `actividades_login_bloque` GROUP BY id_actividad");

    $actividades = mysqli_query($conexion, "SELECT actividades.`id`,`titulo`,`conferencista`,actividades.`fechahora`,`nacionalidad`,`enfoque`,`salon`,`cupo`,`bloque_id`,`bloque` FROM actividades INNER JOIN bloque WHERE actividades.bloque_id = bloque.id ORDER BY actividades.fechahora");

    $mis_actividades = mysqli_query($conexion,"SELECT id_actividad FROM actividades_login_bloque WHERE id_login= ".$session_id);

    $guardado=false;
    while ($row= mysqli_fetch_array($mis_actividades))
    {
        if($row['id_actividad']==99999)
        {
//            $guardado=true;
        }
        $mis_actividades_ids[]=$row['id_actividad'];
    }

} else {
    header("Location:log_in.php");
    exit;
}

?>
<?php include 'inc/header.php'; ?>
<section id="main">
	<div class="container">
        <div id="crumbs">
            <ul>
                <li><a href="javascript:void();" class="success">Registro</a></li>
                <li><a href="javascript:void();" class="success">Validación de cuenta</a></li>
                <li><a href="javascript:void();" class="success">Verificación de pago</a></li>
                <li><a href="javascript:void();" class="active">Actividades</a></li>
                <li><a href="inscripciones_concurso.php">Concurso de Ponencias E&P</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-4"><?php echo $userData['nombreyapellidoInput']; ?></div>
            <div class="col-md-2"><?php echo $estudiante; ?></div>
            <div class="col-md-2"><?php echo $userData['pais']; ?></div>
            <div class="col-md-4"><a href="inc/cerrarsesion.php" class="button azul mini">Cerrar Sesión</a></div>
        </div>
        <div class="row">
            <h1>¡BIENVENIDO/A A BORDO!</h1>
        </div>

        <div class="panel-body">
            <div>
                <h2 style="font-weight: bold;">Actividades Disponibles</h2>
                <p>Debe seleccionar una actividad en cada bloque</p>
                <?php
                $table='<table id="cursos-disponibles" class="table">
                            <thead>
                            <tr>
                                <th>Título</th>
                                <th>Conferencista</th>
                                <th>Nacionalidad</th>
                                <th>Salón</th>
                                <th>Enfoque</th>
                                <th style="width: 40px;"></th>
                            </tr>
                            </thead>
                            <tbody>';
                ?>
                <?php
                $fecha="";
                $color="";
                $opentable = false;
                foreach ($actividades as $v):
                    $datetime = strtotime($v['fechahora']);
                    $date = date("Y/m/d H:i", $datetime);
                    $checked="";
                    $disabled="";
                    if( $fecha!= $v['fechahora']){
                        $fecha = $v['fechahora'];
                        $color = ($color =='#F0FBF8') ? '#FFFFFF' : '#F0FBF8';
                        if($opentable)
                        {
                            echo "</tbody></table>";
                        }
                        echo '<hr /><h3>'.$v['bloque'].' '.$date.'</h3>';
                        if($v['id']==2)
                        {
                            echo '<p>Seleccione el bloque de su preferencia</p>';
                        }
                        echo $table;
                        $opentable = true;
                    }
                    if(isset($mis_actividades_ids)){
                        $checked = in_array($v['id'], $mis_actividades_ids) ? 'checked' : '';
                    }
                    $v['inscritos']=0;
                    foreach ($inscritos as $i)
                    {
                        if($v['id']==$i['id_actividad'])
                        {
                            $v['inscritos']=$i['inscritos'];
                        }
                    }
                    if($v['cupo'] <= $v['inscritos'] && $checked == ''){
                        $disabled = 'disabled';
                    }
                    if($guardado){
                        $disabled = 'disabled';
                    }
                    ?>
                    <tr style="background-color:<?php echo $color;?>">

                        <td><?php echo $v['titulo']; ?></td>
                        <td><?php echo $v['conferencista']; ?></td>
                        <td><?php echo $v['nacionalidad']; ?></td>
                        <td><?php echo $v['salon']; ?></td>
                        <td><?php echo $v['enfoque']; ?></td>
                        <td>
                            <input data-actividadid="<?php echo $v['id'] ?>"
                                   name="<?php echo $v['bloque']; ?>"
                                   data-bloqueid="<?php echo $v['bloque_id'] ?>"
                                   data-userid="<?php echo $session_id; ?>"
                                   class="checkCurso"
                                <?php echo $checked; ?>
                                <?php echo $disabled; ?>
                                   data-modal="#dialog"
                                   type="radio"
                                   onclick="checkCurso(this, <?php echo $session_id?>);"
                            />
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
                </table>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary btn-lg btn-block" data-actividadid="99999" name="Guardar" data-bloqueid="0" data-userid="<?php echo $session_id?>" class="checkCurso" data-modal="#dialog" type="radio" onclick="Guardar(this,<?php echo $session_id?>);">Guardar</button>
            </div>
            <div>
                <h2 style="font-weight: bold;">VISITAS</h2>
                <table id="visitas" class="table">
                    <thead>
                    <tr>
                        <th>Industria</th>
                        <th>Hora de visita</th>
                        <th>Cant de personas</th>
                        <th>Dirección</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th style="width: 40px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($visitas as $k => $v): ?>
                        <?php
                        $check_id = '';
                        if(isset($visita_ids)){
                            if(in_array($v['id'], $visita_ids))
                            {
                                echo "<tr>";
                            }else
                            {
                                echo "<tr style='visibility: collapse'>";
                            }
                        }
                        ?>

                            <td><?php echo $v['lugar']; ?></td>
                            <?php
                            $datetime = strtotime($v['fecha']);
                            $date = date("d/m/Y H:i", $datetime);
                            ?>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $v['cupo']; ?></td>
                            <td><?php echo $v['direccion']; ?></td>
                            <td><?php echo $v['contacto']; ?></td>
                            <td><?php echo $v['telefono']; ?></td>
                            <td rowspan="<?php echo $cant_c; ?>" style="text-align: center; vertical-align: middle;">
                                <img id="v_img_<?php echo $v['id'] ?>" style="display:none;" src="images/loading.gif"/>
                                <?php
                                $check_id = '';
                                if(isset($visita_ids)){
                                    $check_id = in_array($v['id'], $visita_ids) ? 'checked' : '';
                                }
                                ?>
                                <input data-visitaid="<?php echo $v['id'] ?>" data-modal="#dialog" type="checkbox" disabled onclick="checkVisitas(this, <?php echo $session_id?>);" <?php echo $check_id; ?> />
                                <?php //endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary btn-lg btn-block" data-actividadid="99999" name="Guardar" data-bloqueid="0" data-userid="<?php echo $session_id?>" class="checkCurso" data-modal="#dialog" type="radio" onclick="Guardar(this,<?php echo $session_id?>);">Guardar</button>
            </div>
        </div>
<hr>
        <div id="Perfil" class="card">
            <div class="card-header" id="headingPerfil">
                <h1 class="mb-0"  class="btn btn-link collapse" data-toggle="collapse" data-target="#collapsePerfil" aria-expanded="false" aria-controls="collapsePerfil">
                    Perfil
                </h1>
            </div>
            <div id="collapsePerfil" class="collapse" aria-labelledby="headingPerfil" data-parent="#accordion">
                <div class="card-body form">
                    <form action="inc/perfil.php" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <label for="name">*Nombre Completo (como saldrá en el certificado)</label>
                            <input type="text" name="nombreyapellidoInput" id="nombreyapellidoInput" value="<?php echo $userData['nombreyapellidoInput']; ?>">
                        </div>

                        <div class="form-row">
                            <label for="name">*Correo Electrónico</label>
                            <input type="email" name="correoElectronico" id="correoElectronico" value="<?php echo $userData['correoElectronico']; ?>">
                            <span id = "mailInvalido" class="mayorEdad" style="color:red">Debes introducir un correo electronico válido.</span>
                            <span id = "mailRepetido" class="mayorEdad" style="color:red">Ya existe una cuenta asociada a este correo electrónico</span>
                        </div>

                        <hr />

                        <div class="form-row">
                            <label for="name">*Número de Teléfono / Whatsapp ej. +1 8294431870</label>
                            <input type="text" name="telefono" id="telefono" value="<?php echo $userData['telefono']; ?>">
                            <span id = "telefonoInvalido" class="mayorEdad" style="color:red">Debes introducir un número de teléfono válido.</span>
                        </div>

                        <div class="form-row">
                            <label for="nivelacademico">*Nivel Académico</label>
                            <select name="nivelacademico" name="nivelacademico" id="nivelacademico" value="<?php echo $userData['estudiante']; ?>">
                                <option value="Estudiante">Estudiante</option>
                                <option value="Profesional">Profesional</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="pais">*País</label>
                            <select name="pais" id="pais" value="<?php echo $userData['pais']; ?>">
                                <option value="0">Seleccionar</option>
                                <option value="AR">Argentina</option>
                                <option value="BO">Bolivia</option>
                                <option value="BR">Brasil</option>
                                <option value="CL">Chile</option>
                                <option value="CO">Colombia</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CU">Cuba</option>
                                <option value="EC">Ecuador</option>
                                <option value="SV">El Salvador</option>
                                <option value="GT">Guatemala</option>
                                <option value="HN">Honduras</option>
                                <option value="MX">México</option>
                                <option value="NI">Nicaragua</option>
                                <option value="PA">Panamá</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Perú</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="DO">República Dominicana</option>
                                <option value="UY">Uruguay</option>
                                <option value="VE">Venezuela</option>
                                <option value="AF">Afganistán</option>
                                <option value="AL">Albania</option>
                                <option value="DE">Alemania</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antártida</option>
                                <option value="AG">Antigua y Barbuda</option>
                                <option value="AN">Antillas Holandesas</option>
                                <option value="SA">Arabia Saudí</option>
                                <option value="DZ">Argelia</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaiyán</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrein</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BE">Bélgica</option>
                                <option value="BZ">Belice</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermudas</option>
                                <option value="BY">Bielorrusia</option>
                                <option value="MM">Birmania</option>
                                <option value="BA">Bosnia y Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BN">Brunei</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="BT">Bután</option>
                                <option value="CV">Cabo Verde</option>
                                <option value="KH">Camboya</option>
                                <option value="CM">Camerún</option>
                                <option value="CA">Canadá</option>
                                <option value="TD">Chad</option>
                                <option value="CN">China</option>
                                <option value="CY">Chipre</option>
                                <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
                                <option value="KM">Comores</option>
                                <option value="CG">Congo</option>
                                <option value="CD">Congo, República Democrática del</option>
                                <option value="KR">Corea</option>
                                <option value="KP">Corea del Norte</option>
                                <option value="CI">Costa de Marfíl</option>
                                <option value="HR">Croacia (Hrvatska)</option>
                                <option value="DK">Dinamarca</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="EG">Egipto</option>
                                <option value="AE">Emiratos Árabes Unidos</option>
                                <option value="ER">Eritrea</option>
                                <option value="SI">Eslovenia</option>
                                <option value="ES">España</option>
                                <option value="US">Estados Unidos</option>
                                <option value="EE">Estonia</option>
                                <option value="ET">Etiopía</option>
                                <option value="FJ">Fiji</option>
                                <option value="PH">Filipinas</option>
                                <option value="FI">Finlandia</option>
                                <option value="FR">Francia</option>
                                <option value="GA">Gabón</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GD">Granada</option>
                                <option value="GR">Grecia</option>
                                <option value="GL">Groenlandia</option>
                                <option value="GP">Guadalupe</option>
                                <option value="GU">Guam</option>
                                <option value="GY">Guayana</option>
                                <option value="GF">Guayana Francesa</option>
                                <option value="GN">Guinea</option>
                                <option value="GQ">Guinea Ecuatorial</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="HT">Haití</option>
                                <option value="HU">Hungría</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IQ">Irak</option>
                                <option value="IR">Irán</option>
                                <option value="IE">Irlanda</option>
                                <option value="BV">Isla Bouvet</option>
                                <option value="CX">Isla de Christmas</option>
                                <option value="IS">Islandia</option>
                                <option value="KY">Islas Caimán</option>
                                <option value="CK">Islas Cook</option>
                                <option value="CC">Islas de Cocos o Keeling</option>
                                <option value="FO">Islas Faroe</option>
                                <option value="HM">Islas Heard y McDonald</option>
                                <option value="FK">Islas Malvinas</option>
                                <option value="MP">Islas Marianas del Norte</option>
                                <option value="MH">Islas Marshall</option>
                                <option value="UM">Islas menores de Estados Unidos</option>
                                <option value="PW">Islas Palau</option>
                                <option value="SB">Islas Salomón</option>
                                <option value="SJ">Islas Svalbard y Jan Mayen</option>
                                <option value="TK">Islas Tokelau</option>
                                <option value="TC">Islas Turks y Caicos</option>
                                <option value="VI">Islas Vírgenes (EE.UU.)</option>
                                <option value="VG">Islas Vírgenes (Reino Unido)</option>
                                <option value="WF">Islas Wallis y Futuna</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italia</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japón</option>
                                <option value="JO">Jordania</option>
                                <option value="KZ">Kazajistán</option>
                                <option value="KE">Kenia</option>
                                <option value="KG">Kirguizistán</option>
                                <option value="KI">Kiribati</option>
                                <option value="KW">Kuwait</option>
                                <option value="LA">Laos</option>
                                <option value="LS">Lesotho</option>
                                <option value="LV">Letonia</option>
                                <option value="LB">Líbano</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libia</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lituania</option>
                                <option value="LU">Luxemburgo</option>
                                <option value="MK">Macedonia, Ex-República Yugoslava de</option>
                                <option value="MG">Madagascar</option>
                                <option value="MY">Malasia</option>
                                <option value="MW">Malawi</option>
                                <option value="MV">Maldivas</option>
                                <option value="ML">Malí</option>
                                <option value="MT">Malta</option>
                                <option value="MA">Marruecos</option>
                                <option value="MQ">Martinica</option>
                                <option value="MU">Mauricio</option>
                                <option value="MR">Mauritania</option>
                                <option value="YT">Mayotte</option>
                                <option value="FM">Micronesia</option>
                                <option value="MD">Moldavia</option>
                                <option value="MC">Mónaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="MS">Montserrat</option>
                                <option value="MZ">Mozambique</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NE">Níger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NU">Niue</option>
                                <option value="NF">Norfolk</option>
                                <option value="NO">Noruega</option>
                                <option value="NC">Nueva Caledonia</option>
                                <option value="NZ">Nueva Zelanda</option>
                                <option value="OM">Omán</option>
                                <option value="NL">Países Bajos</option>
                                <option value="PG">Papúa Nueva Guinea</option>
                                <option value="PK">Paquistán</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PF">Polinesia Francesa</option>
                                <option value="PL">Polonia</option>
                                <option value="PT">Portugal</option>
                                <option value="QA">Qatar</option>
                                <option value="UK">Reino Unido</option>
                                <option value="CF">República Centroafricana</option>
                                <option value="CZ">República Checa</option>
                                <option value="ZA">República de Sudáfrica</option>
                                <option value="SK">República Eslovaca</option>
                                <option value="RE">Reunión</option>
                                <option value="RW">Ruanda</option>
                                <option value="RO">Rumania</option>
                                <option value="RU">Rusia</option>
                                <option value="EH">Sahara Occidental</option>
                                <option value="KN">Saint Kitts y Nevis</option>
                                <option value="WS">Samoa</option>
                                <option value="AS">Samoa Americana</option>
                                <option value="SM">San Marino</option>
                                <option value="VC">San Vicente y Granadinas</option>
                                <option value="SH">Santa Helena</option>
                                <option value="LC">Santa Lucía</option>
                                <option value="ST">Santo Tomé y Príncipe</option>
                                <option value="SN">Senegal</option>
                                <option value="SC">Seychelles</option>
                                <option value="SL">Sierra Leona</option>
                                <option value="SG">Singapur</option>
                                <option value="SY">Siria</option>
                                <option value="SO">Somalia</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="PM">St. Pierre y Miquelon</option>
                                <option value="SZ">Suazilandia</option>
                                <option value="SD">Sudán</option>
                                <option value="SE">Suecia</option>
                                <option value="CH">Suiza</option>
                                <option value="SR">Surinam</option>
                                <option value="TH">Tailandia</option>
                                <option value="TW">Taiwán</option>
                                <option value="TZ">Tanzania</option>
                                <option value="TJ">Tayikistán</option>
                                <option value="TF">Territorios franceses del Sur</option>
                                <option value="TP">Timor Oriental</option>
                                <option value="TG">Togo</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad y Tobago</option>
                                <option value="TN">Túnez</option>
                                <option value="TM">Turkmenistán</option>
                                <option value="TR">Turquía</option>
                                <option value="TV">Tuvalu</option>
                                <option value="UA">Ucrania</option>
                                <option value="UG">Uganda</option>
                                <option value="UZ">Uzbekistán</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VN">Vietnam</option>
                                <option value="YE">Yemen</option>
                                <option value="YU">Yugoslavia</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabue</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="facebook">Nombre en Facebook Ej. https://facebook.com/<span style="font-weight: bold">cleinaleiiaf</span></label>
                            <input type="text" name="facebook" id="facebook" value="<?php echo $userData['facebook']; ?>">
                        </div>

                        <div class="form-row">
                            <label for="instagram">Nombre en Instagram Ej. https://www.instagram.com/<span style="font-weight: bold">cleinrd2018</span></label>
                            <input type="text" name="instagram" id="instagram" value="<?php echo $userData['instagram']; ?>">
                        </div>

                        <div class="form-row">
                            <label for="idNumber">Nro. de Cédula o Pasaporte*</label>
                            <input type="text" name="idNumber" id="idNumber" value="<?php echo $userData['idNumber']; ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="fechaNacimiento">Fecha de Nacimiento*</label>
                            <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $userData['fechaNacimiento']; ?>" required>
                            <span id="debesSerMayor" class="mayorEdad" style="color:red">Debes ser mayor de edad para poder inscribirte.</span>
                        </div>

                        <div class="form-row">
                            <label for="universidad">Universidad de Procedencia*</label>
                            <input type="text" name="universidad" id="universidad" value="<?php echo $userData['universidad']; ?>" required>
                        </div>

                        <div class="form-row">
                            <label for="carrera">Carrera Universitaria*</label>
                            <input type="text" name="carrera" id="carrera" list="carreraList" value="<?php echo $userData['carrera']; ?>" required>
                            <datalist id="carreraList">
                                <option value="Ingeniería Industrial">
                                <option value="Ingeniería Civil y/o de Construcción">
                                <option value="Ingeniería de Sistemas o Informática">
                                <option value="Ingeniería de Eléctrica o Electrónica">
                                <option value="Ingeniería Mecánica">
                                <option value="Otras Ingenierías">
                                <option value="Administración de Empresas y Afines">
                                <option value="Contabilidad y Afines">
                                <option value="Mercadeo y Afines">
                                <option value="Arquitectura y Afines">
                                <option value="Artes Plásticas, Visuales y Afines">
                                <option value="Ciencias y Afines">
                                <option value="Comunicación Social">
                                <option value="Derecho y Afines">
                                <option value="Economía">
                                <option value="Educacion y Afines">
                                <option value="Medicina y Afines">
                                <option value="Diseño y Afines">
                                <option value="Otra">
                            </datalist>
                        </div>

                        <div class="form-row">
                            <input type="hidden" name="tipoDocumento" id="tipoDocumento"  value="perfil">
                            <!--                                    <input id="botonEnviarPerfil" type="submit" value="Enviar" class="button enviarform">-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <nav class="nav nav-pills nav-justified">
            <a class="nav-item nav-link" href="https://issuu.com/cleinrd/docs/guia_informativa_para_el_asistente_" target="_blank">GUÍA DE ASISTENTE DEL CONGRESO</a>
            <a class="nav-item nav-link" href="files/CLEINRD2018_CodigoVestimenta.pdf" target="_blank">CÓDIGO DE VESTIMENTA</a>
        </nav>
    </div>

    <div id="boxes">
        <div id="dialog" class="window">
            <a href="#"><button type="button" class="close" aria-label="Close">×</button></a>
            <span class="boxspan">Ha ocurrido un error. Por favor vuelta a intentarlo.</span>
        </div>

        <!-- Mask to cover the whole screen -->
        <div id="mask"></div>
    </div>

    <script src="js/actividadesDisponibles.js"></script>
<?php include 'inc/footer.php'; ?>