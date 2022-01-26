window.addEvent('domready',function(){

//validar fecha 1 mayor que fecha 2 y diferencia menor a un año	
		var hoy = new Date();
		var fecha1From = new Date(hoy.getFullYear(),hoy.getMonth(),hoy.getDate());
		fecha1From = [fecha1From.getFullYear(),fecha1From.getMonth(),fecha1From.getDate()];

		var dpFecha2 = $('fecha2').datePicker({
		format: '%Y-%m-%d',
		onShow: function(container){container.fade('hide').fade('in');},
		onHide: function(container){container.fade('out');}}
		);
		var dpFecha1 = $('fecha1').datePicker({
			from: fecha1From,
			initial: fecha1From,
			setInitial: true,
			format: '%Y-%m-%d',
		    onShow: function(container){container.fade('hide').fade('in');},
			onUpdate: function(date){
				var fecha2From = new Date(date.y,date.m,date.d);//desde
				var fecha2To = new Date(date.y+1,date.m,date.d);//hasta
				dpFecha2.options.from = [fecha2From.getFullYear(),fecha2From.getMonth(),fecha2From.getDate()];
				dpFecha2.options.to = [fecha2To.getFullYear(),fecha2To.getMonth(),fecha2To.getDate()];
				dpFecha2.setFullDate(date.y,date.m,date.d).update();},
			onHide: function(container){container.fade('out');}}
		);

	});

