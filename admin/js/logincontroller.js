
function LoginControl(form,submitbtn) {
	var me = this;

	me.initialize = function(form,submitbtn) {
		me.form = me.newForm(form);

		submitbtn.on('click',function(){
			me.submitForm();
		});

		me.select(document).on('keypress',function(evento){
			if(evento.keyCode == 13) {
				me.submitForm();	
			}
		})
	};

	me.submitForm = function(){
		if(!me.formisValid(me.form)) {
			for(var i in form) {
				if(!form[i].valid) {
					form[i].errordom.addClass('has-error');
				}
			}

			me.popAlert({type: 'alert-danger', message: 'Debes completar todos los campos para iniciar sesión.', icon: 'glyphicon glyphicon-remove-sign'});
			return;
		}

		me.setMasked({maskMsg: 'Ingresando...'});

		var fields = {};

		for(var i in me.form) {
			fields[me.form[i].dom.attr('name')] = me.form[i].dom.val();
		};

		me.ajax({
			url: 'php/logincontrol.php',
			type: 'post',
			data: {
				operation: 'adminlogin',
				fields: JSON.stringify(fields)
			},
			success: function(response) {
				setTimeout(function(){
					if(response.success == false) {
						me.setMasked(false,function(){
							me.popAlert({type: 'alert-danger', message: response.message, icon: 'glyphicon glyphicon-remove-sign'});
						});
						return;
					}

					window.location.href = response.redirectUrl;
					
				},1000);
			},
			error: function(response) {
				console.log(response);
			}
		})
	}

	me.initialize(form,submitbtn);
};

//heredar todos los metodos del global controller
LoginControl.prototype = David.prototype;
LoginControl.prototype.constructor = LoginControl;

//crear la instancia del formulario login
var form = [
	{
		dom: 'input[name="username"]',
		validation: function(value){
			var regex = /^.+$/gi;
			return regex.test(value);
		},
		errordom: '#usernamegroup'
	},
	{
		dom: 'input[name="userpass"]',
		validation: function(value){
			var regex = /^.+$/gi;
			return regex.test(value);
		},
		errordom: '#userpassgroup'
	}
];

var submitbtn = global.select('#loginbtn');
var login = new LoginControl(form,submitbtn);

