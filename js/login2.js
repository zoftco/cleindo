
$(function() {
    $('#botonEnviarForm2').click(function () {
        var form = $('#form2');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        var idNumber = $('#idNumber').val();
        var fechaNacimiento = $('#fechaNacimiento').val();
        var fotoDocumento = $('#fotoDocumento').val();
        var universidad = $('#universidad').val();
        var carrera = $('#carrera').val();
        var fotoComprobante = $('#fotoComprobante').val();
        var user_id = $('#user_id').val();
        var bandera = true;
        var aprobadoPass = false;
        var selectedYear = '';
        var vacio = true;

        if (idNumber.length === 0) {
            $('#idNumber').addClass('errorBorder');
            bandera = false
        } else {
            $('#idNumber').removeClass('errorBorder');
            bandera = true;
        }
        if (fechaNacimiento.length === 0) {
            $('#fechaNacimiento').addClass('errorBorder');
            bandera = false;
        } else {
            $('#fechaNacimiento').removeClass('errorBorder');
            bandera = true;
        }
        if (fotoDocumento.length === 0) {
            $('#fotoDocumento').addClass('errorBorder');
            bandera = false
        } else {
            $('#fotoDocumento').removeClass('errorBorder');
            bandera = true;
        }
        if (universidad.length === 0) {
            $('#universidad').addClass('errorBorder');
            bandera = false;
        } else {
            $('#universidad').removeClass('errorBorder');
            bandera = true;
        }
        if (carrera.length === 0) {
            $('#carrera').addClass('errorBorder');
            bandera = false;
        } else {
            $('#carrera').removeClass('errorBorder');
            bandera = true;
        }
        if ($('#fotoComprobante').length) {
            if (fotoComprobante.length === 0) {
                $('#fotoComprobante').addClass('errorBorder');
                bandera = false
            } else {
                $('#fotoComprobante').removeClass('errorBorder');
                bandera = true;
            }
        }



        if ((bandera === true)) {
            $.ajax({
                type: 'POST',
                url: 'inc/inscripcion2.php',
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType : false,
                processData : false,
                success: function (respuesta) {
                    console.log(respuesta);
                    try{
                        var response = JSON.parse(respuesta);
                        window.location.href = "inscripciones_paso2.php";
                    }catch(error)
                    {
                        $('#mensaje').html("Error, intenta nuevamente");
                    }
                }
            })
        }
    });
});