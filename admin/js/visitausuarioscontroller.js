function Visitacontrol(table, visitapanel){
	var me = this;
	me.table;
	me.visitausuariorows;
	me.visitausuariodata;
	me.visitapanel;

	me.initialize = function(table, visitapanel){
		me.visitapanel = visitapanel;
		me.table = table;
		me.setMasked({
			position: 'absolute',
			maskMsg: 'Cargando...',
			maskCls: 'whitemask'
		},false,me.table.parents('.panel-body'));

		var id = me.table.find('#visita_id').val();

		me.getData({
			src: 'php/visitausuarioscontrol.php',
			params: {
				operation: 'getvisitausuarios',
				visita_id: id 
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}
						var rows = me.renderData(me.table.find('tbody'),'components/visitausuariorow.html',data);

						me.visitausuariorows = rows;
						me.visitausuariodata = data;
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

		me.table.on('click','.deletevisitausuariobtn',function(){
			me.onVisitadelete(me.select(this).attr('data-id'));
		});

		me.visitapanel.on('click','.exportvisitabtn',function(){
			me.onExportvisita(me.select(this).attr('data-id'));
		});
	}

	me.onExportvisita = function(idtoexport){
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
				window.open( "php/exportvisita.php?id="+idtoexport, '_blank');
			});
		},1000);
	}

	me.onVisitadelete = function(idtodelete){
		var visitatodeletedata = me.searchInArray(me.visitausuariodata,'id',idtodelete);

		var deletemodal = me.renderData(me.viewport,'components/visitausuariodelete.html', visitatodeletedata);

		deletemodal[0].modal('show');
		deletemodal[0].on('hidden.bs.modal', function(){
			deletemodal[0].remove();
		});

		deletemodal[0].on('click','#dovisitausuariodelete',function(){
			me.doUsuariodelete(idtodelete);
		});
	}

	me.doUsuariodelete = function(visitausuarioid){
		me.setMasked({
			maskMsg: 'Eliminando...'
		});

		me.ajax({
			url: 'php/visitausuarioscontrol.php',
			type: 'post',
			data: {
				operation: 'deletevisitausuario',
				id: visitausuarioid
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

	me.initialize(table, visitapanel);
}	

//heredar todos los metodos del global controller
Visitacontrol.prototype = David.prototype;
Visitacontrol.prototype.constructor = Visitacontrol;

var table = global.select('.visitapanel table');
var visitapanel = global.select('.visitapanel');
var visitaview = new Visitacontrol(table, visitapanel);

visitaview.setMinheight(visitaview.select('.visitapanel .panel-body'));
