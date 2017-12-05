function Cursoscontrol(table, cursopanel){
	var me = this;
	me.table;
	me.cursousuariorows;
	me.cursousuariodata;
	me.cursopanel;

	me.initialize = function(table, cursopanel){
		me.cursopanel = cursopanel;
		me.table = table;
		me.setMasked({
			position: 'absolute',
			maskMsg: 'Cargando...',
			maskCls: 'whitemask'
		},false,me.table.parents('.panel-body'));

		var id = me.table.find('#curso_id').val();

		me.getData({
			src: 'php/cursousuarioscontrol.php',
			params: {
				operation: 'getcursousuarios',
				curso_id: id 
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}
						var rows = me.renderData(me.table.find('tbody'),'components/cursousuariorow.html',data);

						me.cursousuariorows = rows;
						me.cursousuariodata = data;
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

		me.table.on('click','.deletecursousuariobtn',function(){
			me.onUsuariodelete(me.select(this).attr('data-id'));
		});

		me.cursopanel.on('click','.exportcursobtn',function(){
			me.onExportcurso(me.select(this).attr('data-id'));
		});
	}

	me.onExportcurso = function(idtoexport){
		me.setMasked({
			maskMsg: 'Exportando a Excel...'
		});

		setTimeout(function(){
			me.setMasked(false,function(){
				me.popAlert({
					type: 'alert-success',
					message: 'La exportación se ha completado',
					icon: 'glyphicon glyphicon-ok-sign'
				});
				window.open( "php/exportcurso.php?id="+idtoexport, '_blank');
			});
		},1000);
	}

	me.onUsuariodelete = function(idtodelete){
		var usuariotodeletedata = me.searchInArray(me.cursousuariodata,'id',idtodelete);

		var deletemodal = me.renderData(me.viewport,'components/cursousuariodelete.html', usuariotodeletedata);

		deletemodal[0].modal('show');
		deletemodal[0].on('hidden.bs.modal', function(){
			deletemodal[0].remove();
		});

		deletemodal[0].on('click','#docursousuariodelete',function(){
			me.doUsuariodelete(idtodelete);
		});
	}

	me.doUsuariodelete = function(cursousuarioid){
		me.setMasked({
			maskMsg: 'Eliminando...'
		});

		me.ajax({
			url: 'php/cursousuarioscontrol.php',
			type: 'post',
			data: {
				operation: 'deletecursousuario',
				id: cursousuarioid
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
							message: 'El usuario se ha eliminado con éxito.',
							icon: 'glyphicon glyphicon-ok-sign'
						});

						me.iterateArray(me.adminrows,function(domitem) {
							if(domitem.attr('data-id') == adminid) {
								domitem.remove();
							}
						});
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
