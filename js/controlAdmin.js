$(function(){
	$('.textAreaAdmin').hide();
	$('.botonAceptar').click(function() {
		$('.botonAceptarSubmit').click();
	})
	$('.botonRechazar').click(function() {
		$('.textAreaAdmin').show();
	})
})
