function Visitacontrol(table, visitapanel){
	var me = this;
	me.table;
	me.visitapanel;
	me.visitarows;
	me.newadminform;
	me.visitadata;

	me.initialize = function(table, visitapanel){
		me.table = table;
		me.visitapanel = visitapanel;
		me.setMasked({
			position: 'absolute',
			maskMsg: 'Cargando...',
			maskCls: 'whitemask'
		},false,me.table.parents('.panel-body'));

		me.getData({
			src: 'php/visitacontrol.php',
			params: {
				operation: 'getvisitas'
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}

						var rows = me.renderData(me.table.find('tbody'),'components/visitarow.html',data);

						me.visitarows = rows;
						me.visitadata = data;
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

		me.table.on('click','.deletevisitabtn',function(){
			me.onVisitadelete(me.select(this).attr('data-id'));
		});

		me.visitapanel.on('click', '.addvisitabtn', function(e){
		   me.onEditvisita(false);
		});

		me.table.on('click','.editvisitabtn',function(){
			me.onEditvisita(me.select(this).attr('data-id'));
		})
	}

	me.onEditvisita = function(idtoedit){
		var visitatoeditdata = {};
		if(idtoedit){
			visitatoeditdata = me.searchInArray(me.visitadata,'id', idtoedit);
		}else{
			var visita =[{
				id: '',
				lugar: '',
				direccion: '',
				contacto: '',
				telefono: '',
				cupo: ''
			}];
			visitatoeditdata = visita;
		}

		var editmodal = me.renderData(me.viewport,'components/visitaedit.html',visitatoeditdata);

		editmodal[0].modal('show');

		editmodal[0].on('click','.canceledit',function(){
			editmodal[0].on('hidden.bs.modal',function(){
				editmodal[0].remove();
			});

			editmodal[0].modal('hide');
		})

		var editform = [
			{
				dom: 'input[name="lugar"]',
				errordom: '#visitaEditLugar',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo lugar es requerido.'
			},
			{
				dom: 'input[name="direccion"]',
				errordom: '#visitaEditDireccion',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="telefono"]',
				errordom: '#visitaEditTelefono',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="contacto"]',
				errordom: '#visitaEditContacto',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="cupo"]',
				errordom: '#visitaEditCupo',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo fecha es requerido.'
			},
			{
				dom: 'input[name="fecha"]',
				errordom: '#visitaEditFecha',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo fecha es requerido.'
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

			me.onSaveedited(me.select(this).attr('data-id'),editmodal[0]);

		});
	}

	me.onVisitadelete = function(idtodelete){
		var visitatodeletedata = me.searchInArray(me.visitadata,'id',idtodelete);

		var deletemodal = me.renderData(me.viewport,'components/visitadelete.html', visitatodeletedata);

		deletemodal[0].modal('show');
		deletemodal[0].on('hidden.bs.modal', function(){
			deletemodal[0].remove();
		});

		deletemodal[0].on('click','#dovisitadelete',function(){
			me.doVisitadelete(idtodelete);
		});
	}

	me.onSaveedited = function(visitaid,editmodal) {
		editmodal.modal('hide');
		me.setMasked({maskMsg: 'Guardando'});

		var fields = {};

		for(var i in me.editform) {
			fields[me.editform[i].dom.attr('name')] = me.editform[i].dom.val();
		};

		var operation = 'newvisita';

		if(visitaid){
			operation = 'editvisita';
		}

		me.ajax({
			url: 'php/visitacontrol.php',
			type: 'post',
			data: {
				operation: operation,
				fields: JSON.stringify(fields),
				id: visitaid
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
							message: 'Los datos de la visita se editaron con éxito.'
						});
						setTimeout(function(){
							window.location.href = 'visitas.php';
						},1000);
					});
				},1500);
			},
			error: function(response) {
				setTimeout(function(){
					me.setMasked(false,function(){
						me.popAlert({type: 'alert-danger', message: 'No se puede establecer conexión con el servidor.', icon: 'glyphicon glyphicon-remove-sign'});
					});
				},1000);
			}
		});
	}

	me.doVisitadelete = function(cursoid){
		me.setMasked({
			maskMsg: 'Eliminando...'
		});

		me.ajax({
			url: 'php/visitacontrol.php',
			type: 'post',
			data: {
				operation: 'deletevisita',
				id: cursoid
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
							message: 'La visita se ha eliminado con éxito.',
							icon: 'glyphicon glyphicon-ok-sign'
						});

						me.iterateArray(me.adminrows,function(domitem) {
							if(domitem.attr('data-id') == adminid) {
								domitem.remove();
							}
						});
						setTimeout(function(){
							window.location.href = 'visitas.php';
						},1000);
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

	me.initialize(table, visitapanel);
}	

//heredar todos los metodos del global controller
Visitacontrol.prototype = David.prototype;
Visitacontrol.prototype.constructor = Visitacontrol;

var table = global.select('.visitapanel table');
var visitapanel = global.select('.visitapanel');
var visitaview = new Visitacontrol(table, visitapanel);

visitaview.setMinheight(visitaview.select('.visitapanel .panel-body'));
