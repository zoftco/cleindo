function David(){};
David.prototype.viewport = $('body');

David.prototype.popAlertholder = $('.popalertholder');

David.prototype.mask = false;

David.prototype.setMinheight = function(dom) {
	var windowheight = $(window).height();
	$(dom).css('min-height', windowheight*0.6+'px');
}

David.prototype.getTemplate = function(url) {
	var html;
	$.ajax({
		url: url,
		type: 'get',
		async: false,
		success: function(data){
			html = data;
		},
		error: function(){
			html = false;
		}
	});

	return html;
};

David.prototype.parseHtml = function(html,data) {
	var regex = /\{[a-zA-Z0-9_]+\}/gi;
	var output = html.replace(regex,function(str){
		var newstr = str.replace(/\{/g,'');
		var newstr2 = newstr.replace(/\}/g,'');
		if(data[newstr2]) {
			return data[newstr2];
		} else {
			return '';
		}
		
	});
	return output;
};

David.prototype.setMasked = function(options,callback,target) {
	var me = David.prototype;
	if(typeof options == 'object' && me.mask == false) {
		if(target) {
			me.mask = target.setMasked(options);
			return;
		}
		me.mask = this.viewport.setMasked(options);
	} else if (options == false) {
		me.mask.fadeOut(300,function(){
			me.mask.remove();
			me.mask = false;
			if(callback) {
				callback();
			}
		})
	}
};

David.prototype.popAlert = function(options) {
	var me = David.prototype;
	var alertTpl = me.getTemplate('components/popalert.html');
	alertTpl = me.parseHtml(alertTpl,options);

	me.popAlertholder.prepend(alertTpl);
	var alertDom = me.popAlertholder.find('div').eq(0);
	setTimeout(function(){
		alertDom.css({
			'-webkit-transform': 'rotate3d(1,0,0,0deg)',
			'-transform': 'rotate3d(1,0,0,0deg)',
			'opacity': 1
		});
		setTimeout(function(){
			alertDom.css({
				'-webkit-transform': 'rotate3d(1,0,0,-90deg)',
				'-transform': 'rotate3d(1,0,0,-90deg)',
				'opacity': 0
			});
			setTimeout(function(){
				alertDom.remove();
			},500);
		},4000);
	},10);
};

David.prototype.newForm = function(fields) {
	var form = new Array();
	for(var i in fields) {
		fields[i].dom = $(fields[i].dom);
		fields[i].errordom = $(fields[i].errordom);
		form.push(fields[i]);
	};

	return form;
};

David.prototype.formAddfields = function(formarray,fields) {
	for(var i in fields) {
		fields[i].dom = $(fields[i].dom);
		fields[i].errordom = $(fields[i].errordom);
		formarray.push(fields[i]);
	};

	return formarray;
};

David.prototype.formisValid = function(form) {
	var valid = true;
	for(var i in form) {
		if(!form[i].validation(form[i].dom.val())) {
			valid = false;
			form[i].valid = false;
		} else {
			form[i].valid = true;
		}
	};
	return valid;
};

David.prototype.select = function(selector) {
	return $(selector);
};

David.prototype.ajax = function(options) {
	var ajaxoptions = $.extend({
		async: true
	},options);

	$.ajax({
		url: ajaxoptions.url,
		type: ajaxoptions.type,
		async: ajaxoptions.async,
		data: ajaxoptions.data,
		success: function(response,aa,bb) {
			var respuesta = JSON.parse(response);
			ajaxoptions.success(respuesta);
		},
		error: ajaxoptions.error
	});
};

David.prototype.getData = function(options) {
	var me = David.prototype;
	me.ajax({
		url: options.src,
		type: 'post',
		data: options.params,
		success: function(response){
			if(response.success == false) {
				options.success(false, response.message);
			} else {
				options.success(response.data, null);
			}
		},
		error: function(response){
			options.success(false, response);
		}
	});
};

David.prototype.renderData = function(target,template, data, prepend) {
	var me = David.prototype;
	var tpl = me.getTemplate(template);
	var doms = [];

	for(var i in data) {
		if(prepend) {
			target.prepend(me.parseHtml(tpl,data[i]));
			doms.push(target.children(':first-child'));
		} else {
			target.append(me.parseHtml(tpl,data[i]));
			doms.push(target.children(':last-child'));
		}
	};

	return doms;
};

David.prototype.getDomelement = function(array,attribute,value) {
	var output;
	for(var i in array) {
		if(array[i].attr(attribute) == value) {
			output = array[i];
			break;
		}
	}

	return output;
};

David.prototype.searchInArray = function(array,field,value) {
	var output = [];
	for(var i in array) {
		if(array[i][field]) {
			if(array[i][field] == value) {
				output.push(array[i]);
			}
		}
	}

	return output;
};

David.prototype.iterateArray = function(array,fn) {
	for(var i in array) {
		fn(array[i]);
	}
};

var global = new David();

(function(){
	$.fn.setMasked = function(options){
		var settings = $.extend({
			id: 'processmask',
			maskCls: '',
			maskcontentCls: '',
			maskloaderCls: '',
			maskmsgCls: '',
			maskMsg: '',
			position: 'fixed'
		},options);

		var template = global.getTemplate('components/processmask.html');
		template = global.parseHtml(template, settings);

		this.prepend(template);
		var mask = this.find('#'+settings.id);
		mask.show(0);
		return mask;
	}
})(jQuery);


//controla el hover de los inputs
$('input').focus(function(){
	$(this).parents('.form-group').removeClass('has-error');
})


