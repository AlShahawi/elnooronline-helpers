
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;



    	var pusher = new Pusher('4bbeb2cfc72305409b1b', {
	      encrypted: true
	    });

        var channel = pusher.subscribe('notfications');

	    channel.bind('new', function(data) {
        liveNotfication();

        });
    

