function Actividadcontrol(table, actividadpanel){
	var me = this;
	me.table;
	me.actividadpanel;
	me.activdadrows;
	me.newadminform;
	me.actividaddata;

	me.initialize = function(table, actividadpanel){
		me.table = table;
		me.actividadpanel = actividadpanel;
		me.setMasked({
			position: 'absolute',
			maskMsg: 'Cargando...',
			maskCls: 'whitemask'
		},false,me.table.parents('.panel-body'));

		me.getData({
			src: 'php/actividadcontrol.php',
			params: {
				operation: 'getusuarios'
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}
						var rows = me.renderData(me.table.find('tbody'),'components/actividadrow.html?get=1231424',data);

						me.activdadrows = rows;
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

		me.table.on('click','.printactividadbtn',function(){
			me.onPrintActividad(me.select(this).attr('data-id'), me.select(this).attr('data-nombre'));
		});
	}

	me.onPrintActividad = function(idusuario, nombre){

		me.setMasked({
			maskMsg: 'Imprimiendo...'
		});

		setTimeout(function(){
			me.setMasked(false,function(){
				me.popAlert({
					type: 'alert-success',
					message: 'Impresión realizada',
					icon: 'glyphicon glyphicon-ok-sign'
				});

				window.open( "php/printactividades.php?id="+idusuario+"&nombre="+nombre,'_blank');
			});
		},1000);
	}

	me.initialize(table, actividadpanel);
}	

//heredar todos los metodos del global controller
Actividadcontrol.prototype = David.prototype;
Actividadcontrol.prototype.constructor = Actividadcontrol;

var table = global.select('.actividadpanel table');
var actividadpanel = global.select('.actividadpanel');
var actividadview = new Actividadcontrol(table, actividadpanel);

actividadview.setMinheight(actividadview.select('.actividadpanel .panel-body'));
