window.addEvent('domready',function(){							
		
		//Una sola fecha 

       $('fecha').datePicker({
		format: '%Y-%m-%d',
		onShow: function(container){container.fade('hide').fade('in');},
		onHide: function(container){container.fade('out');}}
		);	
	  

		var hoy = new Date();
		var fecha1From = new Date(hoy.getFullYear(),hoy.getMonth(),hoy.getDate());
		fecha1From = [fecha1From.getFullYear(),fecha1From.getMonth(),fecha1From.getDate()];

		var dpFecha2 = $('fecha2').datePicker({
		format: '%Y-%m-%d',
		onShow: function(container){container.fade('hide').fade('in');},
		onHide: function(container){container.fade('out');}}
		);
		var dpFecha1 = $('fecha1').datePicker({
			format: '%Y-%m-%d',
		    onShow: function(container){container.fade('hide').fade('in');},
			onUpdate: function(date){
				var fecha2From = new Date(date.y,date.m,date.d);//desde
				dpFecha2.options.from = [fecha2From.getFullYear(),fecha2From.getMonth(),fecha2From.getDate()];
				dpFecha2.setFullDate(date.y,date.m,date.d).update();},
			onHide: function(container){container.fade('out');}}
		);

	});
