
$(function() {
    $('#botonEnviarForm').click(function () {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var nombreyapellidoInput = $('#nombreyapellidoInput').val();
        var correoElectronico = $('#correoElectronico').val();
        var telefono = $('#telefono').val();
        var pais = $('#pais').val();
        var nivelacademico = $('#nivelacademico').val();
        var facebook = $('#facebook').val();
        var instagram = $('#instagram').val();
        var contrasena = $('#contrasena').val();
        var repetirContrasena = $('#repetirContrasena').val();
        var aceptaTerminos = $('input[type="checkbox"]');
        var bandera = true;
        var aprobadoPass = true;
        var selectedYear = '';
        var vacio = true;

        if (nombreyapellidoInput.length === 0) {
            $('#nombreyapellidoInput').addClass('errorBorder');
            bandera = false
        } else {
            $('#nombreyapellidoInput').removeClass('errorBorder');
        }
        if (pais == 0) {
            $('#pais').addClass('errorBorder');
            bandera = false;
        } else {
            $('#pais').removeClass('errorBorder');
        }
        if (telefono.length === 0) {
            $('#telefono').addClass('errorBorder');
            bandera = false;
        } else {
            $('#telefono').removeClass('errorBorder');
        }
        if (nivelacademico.length === 0) {
            $('#nivelacademico').addClass('errorBorder');
            bandera = false;
        } else {
            $('#nivelacademico').removeClass('errorBorder');
        }
        if (correoElectronico.length < 7) {
            $('#correoElectronico').addClass('errorBorder');
            bandera = false;
        } else if (!re.test(correoElectronico)) {
            $('#correoElectronico').addClass('errorBorder');
            $('#mailInvalido').removeClass('mayorEdad');
            bandera = false;
        } else {
            $('#correoElectronico').removeClass('errorBorder');
            $('#mailInvalido').addClass('mayorEdad');
        }
        if (contrasena.length < 6) {
            $('#contrasena').addClass('errorBorder');
            bandera = false;
        } else {
            $('#contrasena').removeClass('errorBorder');
            if (contrasena !== repetirContrasena) {
                $('#contrasena').addClass('errorBorder');
                $('#repetirContrasena').addClass('errorBorder');
                $('#contrasenasIguales').removeClass('mayorEdad');
                bandera = false;
            } else {
                $('#contrasena').removeClass('errorBorder');
                $('#repetirContrasena').removeClass('errorBorder');
                $('#contrasenasIguales').addClass('mayorEdad');
            }
        }

        if (aceptaTerminos[0].checked === false) {
            $('#aceptaTexto').addClass('errorTexto');
            bandera = false;
        } else {
            $('#aceptaTexto').removeClass('errorTexto');
        }

        if ((bandera === true)) {
            $.ajax({
                type: 'POST',
                url: 'inc/dbconnect.php',
                data: {
                    nombreyapellidoInput: nombreyapellidoInput,
                    correoElectronico: correoElectronico,
                    telefono: telefono,
                    nivelacademico: nivelacademico,
                    pais: pais,
                    facebook: facebook,
                    instagram: instagram,
                    contrasena: contrasena
                },
                cache: false,
                success: function (respuesta) {
                    console.log(respuesta);
                    var response = JSON.parse(respuesta);
                    if (response.respuesta === "Ya existe un usuario registrado con ese correo electrónico") {
                        $('#mailRepetido').removeClass('mayorEdad');
                        $('#correoElectronico').addClass('errorBorder');
                        $('#repetirContrasena').removeClass('errorBorder');
                    } else {
                        $('#mailRepetido').addClass('mayorEdad');
                        $('#correoElectronico').removeClass('errorBorder');
                        $('#nombreyapellidoInput').removeClass('errorBorder');
                        $('#pais').removeClass('errorBorder');
                        $('#estudiante').removeClass('errorBorder');
                        $('#fechaNacimiento').removeClass('errorBorder');
                        $('#contrasena').removeClass('errorBorder');
                        $('#repetirContrasena').removeClass('errorBorder');
                        window.location.href = host + "/inscripciones_paso2.php?user_id" + response.user_id;
                    }
                }
            });
        }
    });
});