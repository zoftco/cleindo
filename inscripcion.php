<!-- Paso 1 Formulario de Inscripción Principal -->
<?php include 'inc/header.php'; ?>

<section id="main">
	<div class="container">
        <p>Si ya ha creado un perfil, puede ingresar <a href="log_in.php">aquí</a></p>
			<div id="crumbs">
				<ul>
					<li><a href="javascript:void();" class="active">Registro</a></li>
					<li><a href="javascript:void();">Validación de cuenta</a></li>
					<li><a href="javascript:void();">Verificación de pago</a></li>
					<li><a href="javascript:void();">Actividades</a></li>
                    <li><a href="javascript:void();">Concurso Ponencia</a></li>
				</ul>
			</div>

			<form action="zz">

				<div class="form">
					<h4 class="title">Formulario de Inscripción</h4>

					<div class="form-row">
						<label for="name">*Nombre Completo (como saldrá en el certificado)</label>
						<input type="text" name="nombreyapellidoInput" id="nombreyapellidoInput">
					</div>

                    <div class="form-row">
                        <label for="name">*Correo Electrónico</label>
                        <input type="email" name="correoElectronico" id="correoElectronico">
                        <span id = "mailInvalido" class="mayorEdad" style="color:red">Debes introducir un correo electronico válido.</span>
                        <span id = "mailRepetido" class="mayorEdad" style="color:red">Ya existe una cuenta asociada a este correo electrónico</span>
                    </div>

                    <div class="form-row">
                        <label for="name">*Contraseña (6 a 8 carácteres)</label>
                        <input type="password" name="contrasena" id="contrasena">
                    </div>

                    <div class="form-row">
                        <label for="name">*Repetir contraseña</label>
                        <input type="password" name="repetirContrasena" id="repetirContrasena">
                        <span id="contrasenasIguales" class="mayorEdad" style="color:red">Las contraseñas deben ser iguales.</span>
                    </div>

                    <hr />

                    <div class="form-row">
                        <label for="name">*Número de Teléfono / Whatsapp ej. +1 8294431870</label>
                        <input type="text" name="telefono" id="telefono">
                        <span id = "telefonoInvalido" class="mayorEdad" style="color:red">Debes introducir un número de teléfono válido.</span>
                    </div>

                    <div class="form-row">
                        <label for="nivelacademico">*Nivel Académico</label>
                        <select name="nivelacademico" name="nivelacademico" id="nivelacademico">
                        <option value="Estudiante">Estudiante</option>
                        <option value="Profesional">Profesional</option>
                        </select>
                    </div>

					<div class="form-row">
						<label for="pais">*País</label>
						<select name="pais" id="pais">
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
                        <input type="text" name="facebook" id="facebook">
                    </div>

					<div class="form-row">
						<label for="instagram">Nombre en Instagram Ej. https://www.instagram.com/<span style="font-weight: bold">cleinrd2018</span></label>
						<input type="text" name="instagram" id="instagram">
					</div>

					<div class="form-row">
						<label for="name">*Acepta los <a href="bases.php" target="_blank">términos y condiciones</a> del contrato de responsabilidad</label>
						<span id ="aceptaTexto">Si, acepto</span> <input type="checkbox" name="" id="aceptaTerminos">
					</div>

					<div class="form-row">
						<input type="button" value="Siguiente" class="button enviarform" id="botonEnviarForm">
					</div>

				</div>

			</form>
	</div>
</section>
<script type="text/javascript" src="js/login.js"></script>
<?php include 'inc/footer.php'; ?>
