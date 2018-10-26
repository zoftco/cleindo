$(document).ready(function() {

    //if close button is clicked
    $('.window .close').click(function (e) {
        //Cancel the link behavior
        e.preventDefault();

        $('#mask').hide();
        $('.window').hide();
    });

    //if mask is clicked
    $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
    });

    $(window).resize(function () {

        var box = $('#boxes .window');

        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();

        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});

        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);

    });

});

function showModal(e, error) {

    //Get the A tag
    var id = $(e).attr('data-modal');

    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();

    //Set heigth and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});

    //transition effect
    $('#mask').fadeIn(1000);
    $('#mask').fadeTo("slow",0.8);

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();

    //Set the popup window to center
    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);

    $(id).find('span').html(error);

    //transition effect
    $(id).fadeIn(2000);

};

function disabledChecks(e){
    $("#cursos-disponibles input[type=radio]").each(function(i) {
        if(e === 'enabled'){
            $(this).removeAttr("disabled");
        }
        if(e === 'disabled'){
            $(this).attr('disabled','true');
        }
    });
}

function checkCurso(e, user_id) {
    var name = $(e).attr('name');
    var bloque_id = $(e).attr('data-bloqueid');
    var user_id = $(e).attr('data-userid');
    var actividad_id =  $(e).attr('data-actividadid');

    // $(e).css('display', 'none');
    // $(img).css('display', 'block');
    disabledChecks('disabled');

    if ($(e).is(':checked')) {
        $.ajax({
            url: 'actividades_disponibles_controller.php',
            type: 'post',
            data: { operation: 'checkcurso', actividad_id: actividad_id, user_id: user_id, bloque_id: bloque_id},
            success: function(response){
                setTimeout(function(){
                    disabledChecks('enabled');
                },1000);
                //popAlert($('.popalertholder'), {type: 'alert-danger', message: 'No se puede establecer conexión con el servidor.', icon: 'glyphicon glyphicon-remove-sign'});
                var obj = jQuery.parseJSON(response);
                if(obj.success == false) {
                    setTimeout(function(){
                        $(e).removeAttr('style');
                        // $(img).css('display', 'none');
                        $(e).prop('checked', false);
                        showModal(e, obj.message);
                    },1000);
                } else {
                    setTimeout(function(){
                        $("input:radio[name='"+name+"']").each(function(i) {

                            if( id !== $(this).attr('actividad_id') ){
                                $(this).prop('checked', false);
                            }
                        });

                        $(e).removeAttr('style');
                        // $(img).css('display', 'none');
                        //$(td).html(parseInt($(td).html()) + 1);
                    },1000);
                }
            },
            error: function(response){
                setTimeout(function(){
                    disabledChecks('enabled');
                },1000);
                setTimeout(function(){
                    $(e).removeAttr('style');
                    // $(img).css('display', 'none');
                    $(e).prop('checked', false);
                    showModal(e, 'Ha ocurrido un error, por favor vuelva a intentarlo.');
                },1000);
            }
        });
    } else {
        $.ajax({
            url: 'actividades_disponibles_controller.php',
            type: 'post',
            data: { operation: 'uncheckcurso', actividad_id: actividad_id, user_id: user_id, bloque_id: bloque_id
            },
            success: function(response){
                setTimeout(function(){
                    disabledChecks('disabled');
                },1000);
                var obj = jQuery.parseJSON(response);
                if(obj.success == false) {
                    setTimeout(function(){
                        $(e).removeAttr('style');
                        // $(img).css('display', 'none');
                        $(e).prop('checked', true);
                        showModal(e, obj.message);
                    },1000);
                } else {
                    setTimeout(function(){
                        $(e).removeAttr('style');
                        // $(img).css('display', 'none');
                        //$(td).html(parseInt($(td).html()) - 1);
                    },1000);
                }
            },
            error: function(response){
                setTimeout(function(){
                    disabledChecks('enabled');
                },1000);
                var obj = jQuery.parseJSON(response);
                setTimeout(function(){
                    $(e).removeAttr('style');
                    // $(img).css('display', 'none');
                    $(e).prop('checked', true);
                    showModal(e, 'Ha ocurrido un error, por favor vuelva a intentarlo.');
                },1000);
            }
        });
    }
};

function disabledChecksVisitas(e){
    $("#visitas input[type=checkbox]").each(function(i) {
        if(e === 'enabled'){
            $(this).removeAttr("disabled");
        }
        if(e === 'disabled'){
            $(this).attr('disabled','true');
        }
    });
}

function Guardar(e, user_id){
    var name = $(e).attr('name');
    var bloque_id = $(e).attr('data-bloqueid');
    var user_id = $(e).attr('data-userid');
    var actividad_id =  $(e).attr('data-actividadid');
    disabledChecks('disabled');
    $.ajax({
        url: 'actividades_disponibles_controller.php',
        type: 'post',
        data: { operation: 'checkcurso', actividad_id: actividad_id, user_id: user_id, bloque_id: bloque_id},
        success: function(response){
            var obj = jQuery.parseJSON(response);
            if(obj.success == false) {
                setTimeout(function(){
                    $(e).removeAttr('style');
                    // $(img).css('display', 'none');
                    $(e).prop('checked', false);
                    showModal(e, obj.message);
                },1000);
            } else {
                showModal(e, "Guardado Exitoso");
            }
        },
        error: function(response){
            setTimeout(function(){
                disabledChecks('enabled');
            },1000);
            setTimeout(function(){
                $(e).removeAttr('style');
                // $(img).css('display', 'none');
                $(e).prop('checked', false);
                showModal(e, 'Ha ocurrido un error, por favor vuelva a intentarlo.');
            },1000);
        }
    });

}



function checkVisitas(e, user_id) {
    //var name = $(e).attr('name');
    var visita_id = $(e).attr('data-visitaid');
    var img = '#v_img_' + visita_id;

    $(e).css('display', 'none');
    $(img).css('display', 'block');
    disabledChecksVisitas('disabled');

    if ($(e).is(':checked')) {
        $.ajax({
            url: 'visitas_controller.php',
            type: 'post',
            data: { operation: 'checkvisita', visita_id: visita_id, user_id: user_id},
            success: function(response){
                setTimeout(function(){
                    disabledChecksVisitas('enabled');
                },1000);
                var obj = jQuery.parseJSON(response);
                if(obj.success === false) {
                    setTimeout(function(){
                        $(e).removeAttr('style');
                        $(img).css('display', 'none');
                        $(e).prop('checked', false);
                        showModal(e, obj.message);
                    },1000);
                } else {
                    setTimeout(function(){
                        $(e).removeAttr('style');
                        $(img).css('display', 'none');
                        //$(td).html(parseInt($(td).html()) - 1);
                    },1000);
                }
            },
            error: function(response){
                setTimeout(function(){
                    disabledChecksVisitas('enabled');
                },1000);
                var obj = jQuery.parseJSON(response);
                setTimeout(function(){
                    $(e).removeAttr('style');
                    $(img).css('display', 'none');
                    $(e).prop('checked', false);
                    showModal(e, 'Ha ocurrido un error, por favor vuelva a intentarlo.');
                },1000);
            }
        })
    }else {
        $.ajax({
            url: 'visitas_controller.php',
            type: 'post',
            data: { operation: 'uncheckvisita', visita_id: visita_id, user_id: user_id
            },
            success: function(response){
                setTimeout(function(){
                    disabledChecksVisitas('enabled');
                },1000);
                var obj = jQuery.parseJSON(response);
                if(obj.success === false) {
                    setTimeout(function(){
                        $(e).removeAttr('style');
                        $(img).css('display', 'none');
                        $(e).prop('checked', true);
                        showModal(e, obj.message);
                    },1000);
                } else {
                    setTimeout(function(){
                        $(e).removeAttr('style');
                        $(img).css('display', 'none');
                        //$(td).html(parseInt($(td).html()) - 1);
                    },1000);
                }
            },
            error: function(response){
                setTimeout(function(){
                    disabledChecksVisitas('enabled');
                },1000);
                var obj = jQuery.parseJSON(response);
                setTimeout(function(){
                    $(e).removeAttr('style');
                    $(img).css('display', 'none');
                    $(e).prop('checked', true);
                    showModal(e, 'Ha ocurrido un error, por favor vuelva a intentarlo.');
                },1000);
            }
        });
    }
}