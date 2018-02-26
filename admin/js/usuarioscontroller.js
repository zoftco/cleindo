function Usuarioscontrol(table, newadmisubmitbtn){
	var me = this;
	me.table;
	me.adminrows;
	me.newadminform;
	me.admindata;

	me.initialize = function(table, newadmisubmitbtn){
		me.table = table;
		me.setMasked({
			position: 'absolute',
			maskMsg: 'Cargando...',
			maskCls: 'whitemask'
		},false,me.table.parents('.panel-body'));

		me.getData({
			src: 'php/admincontrol.php',
			params: {
				operation: 'getadmins'
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}

						var rows = me.renderData(me.table.find('tbody'),'components/adminrow.html',data);

						me.adminrows = rows;
						me.admindata = data;

						var currentadminrow = me.getDomelement(me.adminrows,'data-id',me.select('#currentuser').attr('data-id'));
						currentadminrow.find('.deleteadminbtn').attr('disabled','disabled');
					});
				},1500);
			},
			error: function(message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						me.popAlert({type: 'alert-danger', message: 'No se puede establecer conexión con el servidor.', icon: 'glyphicon glyphicon-remove-sign'});
					});
				},1500);
			}
		});

		newadmisubmitbtn.on('click', function(){
			me.submitNewadmin();
		});

		me.select(document).on('keypress',function(evento){
			if(evento.keyCode == 13) {
				if(me.select('.newadminform input:focus').length > 0) {
					me.submitNewadmin();
				} else if(me.select('#editusermodal input:focus').length > 0) {
					me.select('#saveedited').click();
				}
			}
		});

		// me.deleteAdmintpl = me.getTemplate('components/admindelete.html');

		me.table.on('click','.deleteadminbtn',function(){
			me.onAdmindelete(me.select(this).attr('data-id'));
		});

		me.table.on('click','.editadminbtn',function(){
			me.onEditadmin(me.select(this).attr('data-id'));
		})
	}

	me.submitNewadmin = function() {
		if(!me.formisValid(me.newadminform)) {
			var errormsgs = [];
			for(var i in me.newadminform) {
				if(!me.newadminform[i].valid) {
					me.newadminform[i].errordom.addClass('has-error');
					errormsgs.push(me.newadminform[i].errormessage);
				}
			}

			var errormsgs = errormsgs.join('<br/>');
			me.popAlert({type: 'alert-danger', message: errormsgs, icon: 'glyphicon glyphicon-remove-sign'});
			return;
		}

		//validacion especial para hacer coincidir los pass
		if(me.select('input[name="newadmin_pass"]').val() != me.select('input[name="newadmin_pass2"]').val()) {
			var errormsg = 'Las contraseñas deben coincidir.';

			me.select('input[name="newadmin_pass"]').parents('.form-group').addClass('has-error');
			me.select('input[name="newadmin_pass2"]').parents('.form-group').addClass('has-error');
			me.popAlert({type: 'alert-danger', message: errormsg, icon: 'glyphicon glyphicon-remove-sign'});
			return;
		}

		me.setMasked({
			position: 'absolute',
			maskMsg: 'Guardando...',
			maskCls: 'whitemask'
		},false,me.select('.newadminform'));

		var fields = {};

		for(var i in me.newadminform) {
			fields[me.newadminform[i].dom.attr('name')] = me.newadminform[i].dom.val();
		};

		me.ajax({
			url: 'php/admincontrol.php',
			type: 'post',
			data: {
				operation: 'newadmin',
				fields: JSON.stringify(fields)
			},
			success: function(response){
				setTimeout(function(){
					if(response.success == false) {
						me.setMasked(false);
						me.popAlert({type: 'alert-danger', message: response.message, icon: 'glyphicon glyphicon-remove-sign'});

						switch(response.errcode) {
							case 'userexits':
								me.select('input[name="newadmin_email"]').parents('.form-group').addClass('has-error');
								break;
						}
						return;
					}

					for(var i in me.newadminform) {
						me.newadminform[i].dom.val('');
					};

					me.popAlert({
						type: 'alert-success',
						message: 'La cuenta del administrador se ha creado con éxito.',
						icon: 'glyphicon glyphicon-ok-sign'
					});

					me.setMasked(false);

					var newdata = [response.data];
					var row = me.renderData(me.table.find('tbody'),'components/adminrow.html',newdata,true);
					me.adminrows.push(row[0]);
					me.admindata.push(newdata[0]);
				},1000);
			},
			error: function(response) {
				setTimeout(function(){
					me.setMasked(false,function(){
						me.popAlert({
							type: 'alert-danger',
							message: 'No se puede establecer conexión con el servidor',
							icon: 'glyphicon glyphicon-remove-sign'
						});
					})
				},1000);
			}
		})
	}

	me.onAdmindelete = function(idtodelete){
		var admintodeletedata = me.searchInArray(me.admindata,'admin_id',idtodelete);

		var deletemodal = me.renderData(me.viewport,'components/admindelete.html',admintodeletedata);

		deletemodal[0].modal('show');
		deletemodal[0].on('hidden.bs.modal', function(){
			deletemodal[0].remove();
		});

		deletemodal[0].on('click','#doadmindelete',function(){
			me.doAdmindelete(idtodelete);
		});
	}

	me.doAdmindelete = function(adminid){
		me.setMasked({
			maskMsg: 'Eliminando...'
		});

		me.ajax({
			url: 'php/admincontrol.php',
			type: 'post',
			data: {
				operation: 'deleteadmin',
				admin_id: adminid
			},
			success: function(response){
				setTimeout(function(){
					me.setMasked(false,function(){
						if(response.success == false) {
							me.popAlert({
								type: 'alert-danger',
								message: response.message,
								icon: 'glyphicon glyphicon-remove-sign'
							});
							return;
						}

						me.popAlert({
							type: 'alert-success',
							message: 'La cuenta se ha eliminado con éxito.',
							icon: 'glyphicon glyphicon-ok-sign'
						});

						me.iterateArray(me.adminrows,function(domitem) {
							if(domitem.attr('data-id') == adminid) {
								domitem.remove();
							}
						});

						//falta eliminar los datos de me.admindata;
					});
				},1000);
			},
			error: function(response) {
				setTimeout(function(){
					me.setMasked(false,function(){
						me.popAlert({
							type: 'alert-danger',
							message: 'No se puede establecer conexión con el servidor',
							icon: 'glyphicon glyphicon-remove-sign'
						});
					})
				},1000);
			}
		})
	}

	me.onEditadmin = function(idtoedit){

		var admintoeditdata = me.searchInArray(me.admindata,'admin_id',idtoedit);

		var editmodal = me.renderData(me.viewport,'components/adminedit2.html',admintoeditdata);

		editmodal[0].modal('show');

		editmodal[0].on('click','.canceledit',function(){
			editmodal[0].on('hidden.bs.modal',function(){
				editmodal[0].remove();
			});

			editmodal[0].modal('hide');
		})

		var editform = [
			{
				dom: 'input[name="editadmin_nombre"]',
				errordom: '#editadmin_nombre',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo nombre es requerido.'
			},
            {
                dom: 'select[name="editadmin_rol"]',
                errordom: '#editadmin_rol',
                validation: function(value){
                    var regex = /^.+$/gi;
                    return regex.test(value);
                },
                errormessage: 'El campo rol es requerido.'
            },
			{
				dom: 'input[name="editadmin_pass"]',
				errordom: '#editadmin_pass',
				validation: function(value) {
					var regex1 = /^$/gi;

					if(regex1.test(value)) {
						return true;
					}

					var regex = /[a-zA-Z0-9]{4,10}/gi;
					return regex.test(value);
				},
				errormessage: 'La contraseña solo puede contener letras y números, y debe ser de entre 4 y 10 caracteres.'
			},
			{
				dom: 'input[name="editadmin_pass2"]',
				errordom: '#editadmin_pass2',
				validation: function(value) {
					var regex1 = /^$/gi;

					if(regex1.test(value)) {
						return true;
					}

					var regex = /[a-zA-Z0-9]{4,6}/gi;
					return regex.test(value);
				},
				errormessage: 'La contraseña solo puede contener letras y números, y debe ser de entre 4 y 10 caracteres.'
			}
		];

		me.editform = me.newForm(editform);

		editmodal[0].on('click','#saveedited',function(){
			if(!me.formisValid(me.editform)) {
				var errormsgs = [];
				for(var i in me.editform) {
					if(!me.editform[i].valid) {
						me.editform[i].errordom.addClass('has-error');
						errormsgs.push(me.editform[i].errormessage);
					}
				}

				var errormsgs = errormsgs.join('<br/>');
				me.popAlert({type: 'alert-danger', message: errormsgs, icon: 'glyphicon glyphicon-remove-sign'});
				return;
			}

			//validacion especial para hacer coincidir los pass
			if(me.select('input[name="editadmin_pass"]').val() != me.select('input[name="editadmin_pass2"]').val()) {
				var errormsg = 'Las contraseñas deben coincidir.';

				me.select('input[name="editadmin_pass"]').parents('.form-group').addClass('has-error');
				me.select('input[name="editadmin_pass2"]').parents('.form-group').addClass('has-error');
				me.popAlert({type: 'alert-danger', message: errormsg, icon: 'glyphicon glyphicon-remove-sign'});
				return;
			}

			me.onSaveedited(me.select(this).attr('data-id'),editmodal[0]);
		});
	}

	me.onSaveedited = function(userid,editmodal) {
		editmodal.modal('hide');
		me.setMasked({maskMsg: 'Guardando'});

		var fields = {};

		for(var i in me.editform) {
			fields[me.editform[i].dom.attr('name')] = me.editform[i].dom.val();
		};

		me.ajax({
			url: 'php/admincontrol.php',
			type: 'post',
			data: {
				operation: 'editadmin',
				fields: JSON.stringify(fields),
				admin_id: userid
			},
			success: function(response) {
				setTimeout(function(){
					me.setMasked(false, function(){
						if(response.success == false) {
							editmodal.modal('show');
							me.popAlert({
								type: 'alert-danger',
								message: response.message,
								icon: 'glyphicon glyphicon-remove-sign'
							});
							return;
						}

						me.popAlert({
							type: 'alert-success',
							icon: 'glyphicon glyphicon-ok-sign',
							message: 'Los datos del administrador se editaron con éxito.'
						});

						var editedrow = me.getDomelement(me.adminrows,'data-id', userid);
						var editedadmindata = me.searchInArray(me.admindata,'admin_id',userid);

						editedadmindata[0].admin_nombre = fields.editadmin_nombre;
						editedrow.find('.admin_nombre').text(fields.editadmin_nombre);
						editmodal.remove();

						if(editedadmindata[0].admin_id == me.select('#currentuser').attr('data-id')) {
							console.log('enter if');
							me.select('.currentadminname').text(fields.editadmin_nombre);
						}
					});
				},1500);
			},
			error: function(response) {
				setTimeout(function(){
					me.setMasked(false,function(){
						me.popAlert({type: 'alert-danger', message: 'No se puede establecer conexión con el servidor.', icon: 'glyphicon glyphicon-remove-sign'});
					});
				},1500);
			}
		});
	}

	me.initialize(table, newadmisubmitbtn);
}

//heredar todos los metodos del global controller
Usuarioscontrol.prototype = David.prototype;
Usuarioscontrol.prototype.constructor = Usuarioscontrol;

var table = global.select('.adminpanel table');
var adminview = new Usuarioscontrol(table, global.select('#newadminbtn'));
var newadminfields = [
	{
		dom: 'input[name="newadmin_name"]',
		errordom: '#newadmin_name',
		validation: function(value){
			var regex = /^.+$/gi;
			return regex.test(value);
		},
		errormessage: 'El campo nombre es requerido.'
	},
	{
		dom: 'input[name="newadmin_email"]',
		errordom: '#newadmin_email',
		validation: function(value){
			var regex = /^.+@.+\..+$/gi;
			return regex.test(value);
		},
		errormessage: 'Debe introducir una dirección de e-mail válida.'
	},
	{
		dom: 'input[name="newadmin_pass"]',
		errordom: '#newadmin_pass',
		validation: function(value) {
			var regex = /[a-zA-Z0-9]{4,10}/gi;
			return regex.test(value);
		},
		errormessage: 'La contraseña solo puede contener letras y números, y debe ser de entre 4 y 10 caracteres.'
	},
	{
		dom: 'input[name="newadmin_pass2"]',
		errordom: '#newadmin_pass2',
		validation: function(value) {
			var regex = /[a-zA-Z0-9]{4,6}/gi;
			return regex.test(value);
		},
		errormessage: 'La contraseña solo puede contener letras y números, y debe ser de entre 4 y 10 caracteres.'
	}
]

adminview.setMinheight(adminview.select('.adminpanel .panel-body'));
adminview.newadminform = adminview.newForm(newadminfields);
