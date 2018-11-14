function Cursoscontrol(table, cursopanel){
	var me = this;
	me.table;
	me.cursopanel;
	me.cursorows;
	me.newadminform;
	me.cursodata;

	me.initialize = function(table, cursopanel){
		me.table = table;
		me.cursopanel = cursopanel;
		me.setMasked({
			position: 'absolute',
			maskMsg: 'Cargando...',
			maskCls: 'whitemask'
		},false,me.table.parents('.panel-body'));

		me.getData({
			src: 'php/ponenciascontrol.php',
			params: {
				operation: 'getactividades'
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}

						var rows = me.renderData(me.table.find('tbody'),'components/actividadrow.html',data);

						me.actividadrows = rows;
						me.actividaddata = data;
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

		me.table.on('click','.deleteactividadnbtn',function(){
			me.onactividaddelete(me.select(this).attr('data-id'));
		});

		me.actividadpanel.on('click', '.addactividadbtn', function(e){
		   me.onEditactividad(false);
		});

		me.table.on('click','.editactividadbtn',function(){
			me.onEditactividad(me.select(this).attr('data-id'));
		})
	}

	me.onEditactividad = function(idtoedit){
		var actividadtoeditdata = {};
		if(idtoedit){
			actividadtoeditdata = me.searchInArray(me.actividaddata,'id', idtoedit);
		}else{
			var actividad =[{
				id: '',
				codigo: '',
				conferencista: '',
				enfoque: '',
				fecha: '',
				nacionalidad: '',
				titulo: ''
			}];
			actividadtoeditdata = actividad;
		}

		var editmodal = me.renderData(me.viewport,'components/actividadedit.html',actividadtoeditdata);

		editmodal[0].modal('show');

		editmodal[0].on('click','.canceledit',function(){
			editmodal[0].on('hidden.bs.modal',function(){
				editmodal[0].remove();
			});

			editmodal[0].modal('hide');
		})

		var editform = [
			{
				dom: 'select[name="pilar"]',
				errordom: '#actividadEditPilar',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo pilar es requerido.'
			},
			{
				dom: 'input[name="codigo"]',
				errordom: '#actividadEditCodigo',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="fecha"]',
				errordom: '#actividadEditFecha',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo fecha es requerido.'
			},
			{
				dom: 'input[name="titulo"]',
				errordom: '#actividadEditTitulo',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="conferencista"]',
				errordom: '#actividadEditConferencista',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo conferencista es requerido.'
			},
			{
				dom: 'input[name="nacionalidad"]',
				errordom: '#actividadEditNacionalidad',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="enfoque"]',
				errordom: '#actividadEditEnfoque',
				validation: function(value){
					return true;
				},
				errormessage: ''
			}
		];

		me.editform = me.newForm(editform);

		$.each(pilares, function (i, pilar) {
		    $("select[name='pilar']").append($('<option>', { 
		        value: pilar.id,
		        text : pilar.fecha + ' ' + pilar.pilar 
		    }));
		});

		if(actividadtoeditdata[0].pilar_id){
			$("select[name='pilar']").val(actividadtoeditdata[0].pilar_id);
		}

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

	me.onactividaddelete = function(idtodelete){
		var actividadtodeletedata = me.searchInArray(me.actividaddata,'id',idtodelete);

		var deletemodal = me.renderData(me.viewport,'components/actividaddelete.html', actividadtodeletedata);

		deletemodal[0].modal('show');
		deletemodal[0].on('hidden.bs.modal', function(){
			deletemodal[0].remove();
		});

		deletemodal[0].on('click','#doactividaddelete',function(){
			me.doactividaddelete(idtodelete);
		});
	}

	me.onSaveedited = function(cupoid,editmodal) {
		editmodal.modal('hide');
		me.setMasked({maskMsg: 'Guardando'});

		var fields = {};

		for(var i in me.editform) {
			fields[me.editform[i].dom.attr('name')] = me.editform[i].dom.val();
		};

		var operation = 'newactividad';

		if(cupoid){
			operation = 'editactividad';
		}

		me.ajax({
			url: 'php/actividadcontrol.php',
			type: 'post',
			data: {
				operation: operation,
				fields: JSON.stringify(fields),
				id: cupoid
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
							message: 'Los datos del actividad se editaron con éxito.'
						});
						setTimeout(function(){
							window.location.href = 'actividads.php';
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

	me.doactividaddelete = function(actividadid){
		me.setMasked({
			maskMsg: 'Eliminando...'
		});

		me.ajax({
			url: 'php/actividadcontrol.php',
			type: 'post',
			data: {
				operation: 'deleteactividad',
				id: actividadid
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
							message: 'La charla se ha eliminado con éxito.',
							icon: 'glyphicon glyphicon-ok-sign'
						});

						me.iterateArray(me.adminrows,function(domitem) {
							if(domitem.attr('data-id') == adminid) {
								domitem.remove();
							}
						});
						setTimeout(function(){
							window.location.href = 'cursos.php';
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

	me.initialize(table, cursopanel);
}	

//heredar todos los metodos del global controller
Cursoscontrol.prototype = David.prototype;
Cursoscontrol.prototype.constructor = Cursoscontrol;

var table = global.select('.cursopanel table');
var cursopanel = global.select('.cursopanel');
var cursoview = new Cursoscontrol(table, cursopanel);

cursoview.setMinheight(cursoview.select('.cursopanel .panel-body'));
