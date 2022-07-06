$(document).ready(function() {	


	$("nav").on("click", 'a', function(event) {
		event.preventDefault();
		var scrollAnchor = $(this).attr("href");
		var scrollVal = $(scrollAnchor).offset().top - 0;
		$('html, body').animate({scrollTop: scrollVal}, 400);
		return false;
	});


	//маска
	$("input[name=phone]").mask("+0 (000) 000-00-00", {
		clearIfNotMatch: true
	});


	if ( document.body.clientWidth > 800 ) {
		$('[name=device]').val('Десктоп');
	} else {
		$('[name=device]').val('Мобайл');
	}

	var referer = $_GET('utm_source');
	if( referer ) {
		$('[name=referer]').val(referer);
	}


	$(".fancybox").fancybox({});


	$(".open-modal").on('click', function(e) {
		e.preventDefault();

		var target = $(e.target);
		var href   = target.attr('href');

		var title  = $(target).data("title");
		var btn    = $(target).data("btn");
		var form_name = $(target).data("form");

		$.fancybox.open({
			href: href,
			beforeShow: function() {
				if( title && btn ) {
					$('.modal-form h2').html(title);
					$('.modal-form .btn').val(btn);
				} else {
					$('.modal-form h2').html('Оставьте контактные данные и наш менеджер свяжется с вами в ближайшее время');
					$('.modal-form .btn').val('Оставить заявку');
				}

				$('.modal-form [name=form]').val(form_name);
			}
		});
	});

	$("#cases").on('click', 'a.more', function(e) {
    var target = $(this);
    var href = target.attr('href');
		console.log(href);
    $.fancybox.open({
      href: href,
    });
    return false;
  });

	$("#cases .more").unbind();


	$(".accordion").on('click', 'li', function(e) {
		e.preventDefault();

		if( $(this).hasClass('active') ) {
			$(this).removeClass('active').find('.answer').slideUp();
		} else {
			$(this).addClass('active').find('.answer').slideDown();
		}

	});

	$(".show-docs").on('click', function(e) {
		e.preventDefault();
	});

	// var cases_slider = $("#cases .slider").owlCarousel({
	// 	center: true,
	// 	items: 1,
	// 	loop: true,
	// 	autoplay: false,
	// 	autoWidth: false,
	// 	autoplayHoverPause: false,
	// 	navigation: true,
	// 	navText: ["",""],
	// 	dots: true,
	// 	margin: 10,
	// 	responsive : {
	// 	    868 : {
	// 	        items: 1,
	// 	        navigation: true,
	// 	        margin: 10,
	// 	    }
	// 	}
	// });

	// var logos_slider = $("#logos .slider").owlCarousel({
	// 	center: true,
	// 	items: 3,
	// 	loop: true,
	// 	autoWidth: true,
	// 	autoplayHoverPause: false,
	// 	navigation: true,
	// 	autoplay: true,
	// 	autoplayTimeout: 1000,
	// 	navText: ["",""],
	// 	dots: true,
	// 	margin: 0,
	// 	responsive : {
	// 	    868 : {
	// 	        items: 10,
	// 	        navigation: true,
	// 	        margin: 0,
	// 	    }
	// 	}
	// });

	var docs_slider = $("#docs .slider").owlCarousel({
		items: 2,
		loop: true,
		autoWidth: false,
		autoplayHoverPause: false,
		navigation: true,
		autoplay: false,
		navText: ["",""],
		dots: true,
		margin: 10,
		responsive : {
		    868 : {
		        items: 4,
		        navigation: true,
		        margin: 10,
		    }
		}
	});

});