$(function() {
	$('#botonSiguientePago').click(function(){
		var selectedItem = $('#metodopago').val();
		if(selectedItem == "TC") {
			$('#botonSubmit').click();
		}
	})
	
})

$(document).ready(function(){
    $(".westernUnion").hide();
    $(".pagoefectivo").hide();
    $(".pagoTarjeta").hide();
    $("#metodopago").change(function(){
        if ($(this).val() == "WU" ) {
            $(".westernUnion").slideDown();
        } else {
            $(".westernUnion").slideUp();
        }

        if ($(this).val() == "EF" ) {
            $(".pagoefectivo").slideDown();
        } else {
            $(".pagoefectivo").slideUp();
        }

        if ($(this).val() == "TC" ) {
            $(".pagoTarjeta").slideDown();
        } else {
            $(".pagoTarjeta").slideUp();
        }
    });
});