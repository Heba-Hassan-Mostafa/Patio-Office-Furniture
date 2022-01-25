$(document).ready(function(){

    initTimer();
    // set timer function

    function initTimer()
    {
    	if($('.deals_timer_box').length)
    	{
    		var timers = $('.deals_timer_box');
    		timers.each(function()
    		{
    			var timer = $(this);

    			var targetTime;
    			var target_date;

    			// Add a date to data-target-time of the .deals_timer_box
    			// Format: "Feb 17, 2018"
    			if(timer.data('target-time') !== "")
    			{
    				targetTime = timer.data('target-time');
					target_date = new Date(targetTime).getTime();
    			}
    			else
    			{
    				var date = new Date();
			    	date.setDate(date.getDate() + 2);
			    	target_date = date.getTime();
    			}

				// variables for time units
				var days, hours, minutes, seconds;

				var h = timer.find('.deals_timer_hr');
				var m = timer.find('.deals_timer_min');
				var s = timer.find('.deals_timer_sec');

				setInterval(function ()
				{
				    // find the amount of "seconds" between now and target
				    var current_date = new Date().getTime();
				    var seconds_left = (target_date - current_date) / 1000;


					// console.log(seconds_left);

				    // do some time calculations
				    days = parseInt(seconds_left / 86400);
				    seconds_left = seconds_left % 86400;

				    hours = parseInt(seconds_left / 3600);
				    hours = hours + days * 24;
				    seconds_left = seconds_left % 3600;


				    minutes = parseInt(seconds_left / 60);
				    seconds = parseInt(seconds_left % 60);

				    if(hours.toString().length < 2)
				    {
				    	hours = "0" + hours;
				    }
				    if(minutes.toString().length < 2)
				    {
				    	minutes = "0" + minutes;
				    }
				    if(seconds.toString().length < 2)
				    {
				    	seconds = "0" + seconds;
				    }

				    // display results
				    h.text(hours);
				    m.text(minutes);
				    s.text(seconds);

				}, 1000);
    		});
    	}
    }




	// use data atrribite


	$(".all-items-news li").on('click',function () {
	  $(this).addClass('active').siblings().removeClass('active');
	  $(".content-all-data").hide();
	  $($(this).data('content')).fadeIn(1000);
	});


    // start like & dislike cart item

// 	$(".cart-box i").click(function(){
// 		$(this).toggleClass("like");
// 	})

	// use data attribite with all product in home page

	$(".all-items-product li").on('click',function () {
		$(this).addClass('active').siblings().removeClass('active');
		$(".all-product-item").hide();
		$($(this).data('content')).fadeIn(1000);
	  });





});
