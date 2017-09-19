$(document).ready(function(){
	function sendPing(obj_clicked) {
		
            var req = 'api.php?r=ping&ip=' + obj_clicked.attr('data-ip') + '&port=' + obj_clicked.attr('data-port') +'';
            obj_clicked.html('<i class="fa fa-refresh fa-spin"></i> checking');
            if(obj_clicked.attr('data-ip') && obj_clicked.attr('data-port')){
                $.ajax({
                    timeout:3000,
                    type:"POST",
                    url: req,
                    success: function(data){
			console.log(data);
                        if(data =='online')
                        {
                            obj_clicked.removeClass('btn-info').addClass('btn-success').html('<i class="fa fa-check"></i> ' + obj_clicked.attr('data-service'));
                        }
    			if(data =='offline')
                        {
                             obj_clicked.removeClass('btn-info').addClass('btn-danger').html('<i class="fa fa-toggle-off"></i> ' + obj_clicked.attr('data-service'));
		     	}
    		     },
		    error: function (data) {
                        obj_clicked.removeClass('btn-info').addClass('btn-danger').html('<i class="fa fa-toggle-off"></i> ' + obj_clicked.attr('data-service'));
		    }
    		});
	    };
	};

	function sendControlRequest(obj_clicked) {
		
	    var control_request = obj_clicked.attr('data-control-request');
            var req = 'api.php?r=' + control_request + '&ip=' + obj_clicked.attr('data-ip') ;
            obj_clicked.html('<i class="fa fa-refresh fa-spin"></i> processing');
	    obj_clicked.prop("disabled", true);
            if(obj_clicked.attr('data-ip') && obj_clicked.attr('data-control-request')){
                $.ajax({
                    timeout:3000,
                    type:"POST",
                    url: req,
                    success: function(data){
			console.log(data);
                        if(data =='done')
                        {
                            obj_clicked.removeClass('btn-info').addClass('btn-success').html('<i class="fa fa-check"></i> ' + obj_clicked.attr('data-service'));
	    		    obj_clicked.prop("disabled", false);
                        }
    			if(data =='error')
                        {
                            obj_clicked.removeClass('btn-info').addClass('btn-danger').html('<i class="fa fa-toggle-off"></i> ' + obj_clicked.attr('data-service'));
	    		    obj_clicked.prop("disabled", false);
		     	}
    		     },
		    error: function (data) {
                        obj_clicked.removeClass('btn-info').addClass('btn-danger').html('<i class="fa fa-toggle-off"></i> ' + obj_clicked.attr('data-service'));
	    		    obj_clicked.prop("disabled", false);
		    }
    		});
	    };
	};

	function refreshAll (cb) {
		var refresh_button = $('#refresh-btn');
		refresh_button.html('<i class="fa fa-refresh fa-spin"></i> Refreshing');
		refresh_button.prop("disabled", true);
		var set = $('a.ping');
		var length = set.length;
		set.each(function (i) {
			var $that = $(this);
			setTimeout( function () {
				sendPing($that);
			}, i*500);
		});
		setTimeout( function() {
			refresh_button.html('<i class="fa fa-refresh"></i> Refresh</button>');
			refresh_button.prop("disabled", false);
		}, length*500);
	}

        $('table#control-panel a.ping').on('click', function() {
		sendPing($(this));
        });
	$('#refresh-btn').on('click', function () {
		var $t = $(this);
		$t.html('<i class="fa fa-refresh fa-spin"></i> Refreshing');
		refreshAll();
	});

	$('.reboot-btn').on('click', function () {
		if (confirm('Sure?')) {
			sendControlRequest($(this));	
		};
	});

	$('.shutdown-btn').on('click', function () {
		if (confirm('Sure?')) {
			sendControlRequest($(this));	
		};
	});
	
	refreshAll();
    });
