function Pilarescontrol(table, pilarpanel){
	var me = this;
	me.table;
	me.pilarpanel;
	me.pilarrows;
	me.newadminform;
	me.pilardata;

	me.initialize = function(table, pilarpanel){
		me.table = table;
		me.pilarpanel = pilarpanel;
		me.setMasked({
			position: 'absolute',
			maskMsg: 'Cargando...',
			maskCls: 'whitemask'
		},false,me.table.parents('.panel-body'));

		me.getData({
			src: 'php/pilarcontrol.php',
			params: {
				operation: 'getpilares'
			},
			success: function(data, message) {
				setTimeout(function(){
					me.setMasked(false,function(){
						if(!data) {
							me.popAlert({type: 'alert-danger', message: message, icon: 'glyphicon glyphicon-remove-sign'});
							return;
						}

						var rows = me.renderData(me.table.find('tbody'),'components/pilarrow.html',data);

						me.pilarrows = rows;
						me.pilardata = data;
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

		me.table.on('click','.deletepilarbtn',function(){
			me.onPilardelete(me.select(this).attr('data-id'));
		});

		me.pilarpanel.on('click', '.addpilarbtn', function(e){
		   me.onEditpilar(false);
		});

		me.table.on('click','.editpilarbtn',function(){
			me.onEditpilar(me.select(this).attr('data-id'));
		})
	}

	me.onEditpilar = function(idtoedit){
		var pilartoeditdata = {};
		if(idtoedit){
			pilartoeditdata = me.searchInArray(me.pilardata,'id', idtoedit);
		}else{
			var pilar =[{
				id: '',
				pilar: '',
				fecha: '',
				salon: '',
				cupo: ''
			}];
			pilartoeditdata = pilar;
		}

		var editmodal = me.renderData(me.viewport,'components/pilaredit.html',pilartoeditdata);

		editmodal[0].modal('show');

		editmodal[0].on('click','.canceledit',function(){
			editmodal[0].on('hidden.bs.modal',function(){
				editmodal[0].remove();
			});

			editmodal[0].modal('hide');
		})

		var editform = [
			{
				dom: 'input[name="cupo"]',
				errordom: '#pilarEditCupo',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo cupo es requerido.'
			},
			{
				dom: 'input[name="pilar"]',
				errordom: '#pilarEditPilar',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo pilar es requerido.'
			},
			{
				dom: 'input[name="salon"]',
				errordom: '#pilarEditSalon',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
			{
				dom: 'input[name="fecha"]',
				errordom: '#pilarEditFecha',
				validation: function(value){
					var regex = /^.+$/gi;
					return regex.test(value);
				},
				errormessage: 'El campo fecha es requerido.'
			},
			{
				dom: 'select[name="tipo"]',
				errordom: '#pilarEditTipo',
				validation: function(value){
					return true;
				},
				errormessage: ''
			},
		];

		me.editform = me.newForm(editform);

		$("select[name='tipo']").append($('<option>', { 
		        value: 0,
		        text : 'Normal' 
		}));

		$("select[name='tipo']").append($('<option>', { 
		        value: 1,
		        text : 'Magistral' 
		}));

		if(pilartoeditdata[0].tipo){
			$("select[name='tipo']").val(pilartoeditdata[0].tipo);
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

	me.onPilardelete = function(idtodelete){
		var pilartodeletedata = me.searchInArray(me.pilardata,'id',idtodelete);

		var deletemodal = me.renderData(me.viewport,'components/pilardelete.html', pilartodeletedata);

		deletemodal[0].modal('show');
		deletemodal[0].on('hidden.bs.modal', function(){
			deletemodal[0].remove();
		});

		deletemodal[0].on('click','#dopilardelete',function(){
			me.doPilardelete(idtodelete);
		});
	}

	me.onSaveedited = function(pilarid,editmodal) {
		editmodal.modal('hide');
		me.setMasked({maskMsg: 'Guardando'});

		var fields = {};

		for(var i in me.editform) {
			fields[me.editform[i].dom.attr('name')] = me.editform[i].dom.val();
		};

		var operation = 'newpilar';

		if(pilarid){
			operation = 'editpilar';
		}

		me.ajax({
			url: 'php/pilarcontrol.php',
			type: 'post',
			data: {
				operation: operation,
				fields: JSON.stringify(fields),
				id: pilarid
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
							message: 'Los datos del pilar se editaron con éxito.'
						});
						setTimeout(function(){
							window.location.href = 'pilares.php';
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

	me.doPilardelete = function(cursoid){
		me.setMasked({
			maskMsg: 'Eliminando...'
		});

		me.ajax({
			url: 'php/pilarcontrol.php',
			type: 'post',
			data: {
				operation: 'deletepilar',
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
							message: 'El pilar se ha eliminado con éxito.',
							icon: 'glyphicon glyphicon-ok-sign'
						});

						me.iterateArray(me.adminrows,function(domitem) {
							if(domitem.attr('data-id') == adminid) {
								domitem.remove();
							}
						});
						setTimeout(function(){
							window.location.href = 'pilares.php';
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

	me.initialize(table, pilarpanel);
}	

//heredar todos los metodos del global controller
Pilarescontrol.prototype = David.prototype;
Pilarescontrol.prototype.constructor = Pilarescontrol;

var table = global.select('.pilarpanel table');
var pilarpanel = global.select('.pilarpanel');
var pilarview = new Pilarescontrol(table, pilarpanel);

pilarview.setMinheight(pilarview.select('.pilarpanel .panel-body'));
