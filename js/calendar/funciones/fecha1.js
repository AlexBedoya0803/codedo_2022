window.addEvent('domready',function(){							
		
		//Una sola fecha 

       $('fecha').datePicker({
		format: '%Y-%m-%d',
		onShow: function(container){container.fade('hide').fade('in');},
		onHide: function(container){container.fade('out');}}
		);				
									

	});

