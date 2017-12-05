
$(function() {
	$('.estudianteRadio').change(function () {
	    $('.estudianteRadio').not(this).prop('checked', false);
	});
	$('#botonEnviarForm').click(function(){
	    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var telefono = $('#telefono').val();
		var nombreyapellidoInput = $('#nombreyapellidoInput').val();
		var idNumber = $('#idNumber').val();
		var pais = $('#pais').val();
		var estudiante = $('input[type="radio"]:checked').attr('estudiante');
		var fechaNacimiento = $('#fechaNacimiento').val();
		var correoElectronico = $('#correoElectronico').val();
		var contrasena = $('#contrasena').val();
		var repetirContrasena =$('#repetirContrasena').val();
		var aceptaTerminos = $('input[type="checkbox"]');
		var arrayForm = [nombreyapellidoInput.length, idNumber.length, pais, fechaNacimiento.length, correoElectronico.length, contrasena.length, aceptaTerminos[0].checked];
		var bandera = true;
		var aprobadoPass = false;
		var selectedYear = '';
		var vacio = true;


		for (var i = 0; i < 4; i++) {
			$('#fechaNacimiento').val()[i];
		    selectedYear += $('#fechaNacimiento').val()[i];
		}
		if (nombreyapellidoInput.length == 0) {
			$('#nombreyapellidoInput').addClass('errorBorder');
			bandera = false
		} else {
			$('#nombreyapellidoInput').removeClass('errorBorder');
			bandera = true;
		}
		if (idNumber.length == 0) {
			$('#idNumber').addClass('errorBorder');
			bandera = false;
		} else {
			$('#idNumber').removeClass('errorBorder');
			bandera = true;
		}
		if (pais == 0) {
			$('#pais').addClass('errorBorder');
			bandera = false;
		} else {
			$('#pais').removeClass('errorBorder');
			bandera = true;
		}
		if (fechaNacimiento.length < 8) {
			$('#fechaNacimiento').addClass('errorBorder');
			bandera = false;
		} else if (selectedYear > 1997) {
			$('#fechaNacimiento').addClass('errorBorder');
			$('#debesSerMayor').removeClass('mayorEdad');
			bandera = false;
		} else {
			$('#fechaNacimiento').removeClass('errorBorder');
			$('#debesSerMayor').addClass('mayorEdad');
			bandera = true;
		}
		if (correoElectronico.length == 0) {
			$('#correoElectronico').addClass('errorBorder');
			bandera = false;
		} else if (!re.test(correoElectronico)) {
			$('#correoElectronico').addClass('errorBorder');
			$('#mailInvalido').removeClass('mayorEdad');
			bandera = false;
		} else {
			$('#correoElectronico').removeClass('errorBorder');
			$('#mailInvalido').addClass('mayorEdad');
			bandera = true;
		}
		if (contrasena.length == 0) {
			$('#contrasena').addClass('errorBorder');
			bandera = false;
			aprobadoPass = false;
			vacio = true;
		} else {
			$('#contrasena').removeClass('errorBorder');
			bandera = true;
			aprobadoPass = true;
			vacio = false;
		}
		if ((contrasena.lenth < 6) || (contrasena.length > 8) || (vacio == true)) {
			$('#contrasena').addClass('errorBorder');
			bandera = false;
			aprobadoPass = false;
		} else {
			$('#contrasena').removeClass('errorBorder');
			bandera = true;
			aprobadoPass = true;
		}
		if (repetirContrasena.length == 0) {
			$('#repetirContrasena').addClass('errorBorder');
			bandera = false;
			aprobadoPass = false;
		} else {
			$('#repetirContrasena').addClass('errorBorder');
			bandera = true;
			aprobadoPass = true;
		}
		if ((contrasena != repetirContrasena) && (vacio == false)) {
			$('#contrasena').addClass('errorBorder');
			$('#repetirContrasena').addClass('errorBorder');
			$('#contrasenasIguales').removeClass('mayorEdad');
			bandera = false;
		} else {
			$('#contrasena').removeClass('errorBorder');
			$('#repetirContrasena').removeClass('errorBorder');
			$('#contrasenasIguales').addClass('mayorEdad');
			bandera = true;
		}
		if (aceptaTerminos[0].checked == false) {
			$('#aceptaTexto').addClass('errorTexto');
			bandera = false;
		} else {
			$('#aceptaTexto').removeClass('errorTexto');
		 	bandera = true;
		}		

		if ((bandera == true) && (aprobadoPass == true)) {
			$.ajax({
				type: 'POST',
				url: 'inc/dbconnect.php',
				data: {
					nombreyapellidoInput: nombreyapellidoInput,
					idNumber: idNumber,
					pais: pais,
					estudiante: estudiante,
					fechaNacimiento: fechaNacimiento,
					correoElectronico: correoElectronico,
					contrasena: contrasena,
					telefono: telefono
				},
				cache: false,
				success: function(respuesta) {
					console.log(respuesta);
					var response = JSON.parse(respuesta);	
					if (response.respuesta == "Ya existe un usuario registrado con ese correo electrónico") {
						$('#mailRepetido').removeClass('mayorEdad');
						$('#correoElectronico').addClass('errorBorder');
						$('#repetirContrasena').removeClass('errorBorder');
					} else {
						$('#mailRepetido').addClass('mayorEdad');
						$('#correoElectronico').removeClass('errorBorder');
						$('#nombreyapellidoInput').removeClass('errorBorder');
						$('#idNumber').removeClass('errorBorder');
						$('#pais').removeClass('errorBorder');
						$('#estudiante').removeClass('errorBorder');
						$('#fechaNacimiento').removeClass('errorBorder');
						$('#correoElectronico').removeClass('errorBorder');
						$('#contrasena').removeClass('errorBorder');
						$('#repetirContrasena').removeClass('errorBorder');
						// var d = new Date();
						// d.setTime(d.getTime() + (1000*24*60*60*1000));
						// var expires = "expires="+d.toUTCString();
						// document.cookie="token="+response.token + "; "+ expires + "; path=/";
						if ((pais == "PY") && (estudiante == "si")) {
							window.location.href = host+"/inscripciones_paso2.php?user_id="+response.user_id;
							
						} else if ((pais == "PY") && (estudiante == "no")) {
							window.location.href = host+"/inscripciones_paso2_ci.php?user_id="+response.user_id;
						} else if ((pais != "PY") && (estudiante == "si")) {
							window.location.href = host+"/inscripciones_paso2_exg.php?user_id="+response.user_id;
						} else {
							window.location.href = host+"/inscripciones_paso3.php?user_id"+response.user_id;
						}
					}
					
				}
			})
		}
	})
})
