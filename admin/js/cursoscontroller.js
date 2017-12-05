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
			src: 'php/cursocontrol.php',
			params: {
				operation: 'getcursos'
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}

						var rows = me.renderData(me.table.find('tbody'),'components/cursorow.html',data);

						me.cursorows = rows;
						me.cursodata = data;
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

		me.table.on('click','.deletecursonbtn',function(){
			me.onCursodelete(me.select(this).attr('data-id'));
		});

		me.cursopanel.on('click', '.addcursobtn', function(e){
		   me.onEditcurso(false);
		});

		me.table.on('click','.editcursobtn',function(){
			me.onEditcurso(me.select(this).attr('data-id'));
		})
	}

	me.onEditcurso = function(idtoedit){
		var cursotoeditdata = {};
		if(idtoedit){
			cursotoeditdata = me.searchInArray(me.cursodata,'id', idtoedit);
		}else{
			var curso =[{
				id: '',
				codigo: '',
				conferencista: '',
				enfoque: '',
				fecha: '',
				nacionalidad: '',
				titulo: ''
			}];
			cursotoeditdata = curso;
		}

		var editmodal = me.renderData(me.viewport,'components/cursoedit.html',cursotoeditdata);

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
				errordom: '#cursoEditPilar',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo pilar es requerido.'
			},
			{
				dom: 'input[name="codigo"]',
				errordom: '#cursoEditCodigo',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="fecha"]',
				errordom: '#cursoEditFecha',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo fecha es requerido.'
			},
			{
				dom: 'input[name="titulo"]',
				errordom: '#cursoEditTitulo',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="conferencista"]',
				errordom: '#cursoEditConferencista',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo conferencista es requerido.'
			},
			{
				dom: 'input[name="nacionalidad"]',
				errordom: '#cursoEditNacionalidad',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="enfoque"]',
				errordom: '#cursoEditEnfoque',
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

		if(cursotoeditdata[0].pilar_id){
			$("select[name='pilar']").val(cursotoeditdata[0].pilar_id);
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

	me.onCursodelete = function(idtodelete){
		var cursotodeletedata = me.searchInArray(me.cursodata,'id',idtodelete);

		var deletemodal = me.renderData(me.viewport,'components/cursodelete.html', cursotodeletedata);

		deletemodal[0].modal('show');
		deletemodal[0].on('hidden.bs.modal', function(){
			deletemodal[0].remove();
		});

		deletemodal[0].on('click','#docursodelete',function(){
			me.doCursodelete(idtodelete);
		});
	}

	me.onSaveedited = function(cupoid,editmodal) {
		editmodal.modal('hide');
		me.setMasked({maskMsg: 'Guardando'});

		var fields = {};

		for(var i in me.editform) {
			fields[me.editform[i].dom.attr('name')] = me.editform[i].dom.val();
		};

		var operation = 'newcurso';

		if(cupoid){
			operation = 'editcurso';
		}

		me.ajax({
			url: 'php/cursocontrol.php',
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
							message: 'Los datos del curso se editaron con éxito.'
						});
						setTimeout(function(){
							window.location.href = 'cursos.php';
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

	me.doCursodelete = function(cursoid){
		me.setMasked({
			maskMsg: 'Eliminando...'
		});

		me.ajax({
			url: 'php/cursocontrol.php',
			type: 'post',
			data: {
				operation: 'deletecurso',
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
