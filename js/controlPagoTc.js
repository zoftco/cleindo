$(function() {
	$('#botonSiguientePago').click(function(){
		var selectedItem = $('#metodopago').val();
		if(selectedItem == "TC") {
			$('#botonSubmit').click();
		}
	})
	
})
//cuando vuelvas del almuerzo intenta ver el//
//tema de porque no anda el POST en tu archivo php Prueba.php//
