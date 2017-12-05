$(function(){
	$('#botonIngresarLogin').click(function() {
		var email = $('#emailLogin').val();
		var pass = $('#passLogin').val();

		if((email.length == 0) || (pass.length == 0)) {
			$('#missingFields').removeAttr('hidden');
		} else {
			// $('#missingFields').addAttr('hidden');
			$.ajax({
				type: 'POST',
				url: 'inc/loginCheck.php',
				data: {
					email: email,
					pass: pass,
				},
				success: function(r) {
					if (r == "Credenciales incorrectas.") {
						$('#missingFields').text(r);
						$('#missingFields').removeAttr('hidden');
					} else {
						window.location.href="inc/intermediador.php"
					}
				}
			})
		}
	})
})