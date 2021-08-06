(function ($) {
	/* Globale Variabeln */
	var waypoint_screen_height = screen.height / 2 - 80;

	/* Pace initalisieren */
	Pace.on('done', function () {
		setTimeout(function () {
			$('#main_wrapper').fadeTo('250', 1);
			AOS.init();
		}, 0);
	});

	/* Funktionen beim scrollen ausführen */
	$(window).on('scroll', function() {
		var scroll = $(window).scrollTop();
		var navbar = $('#nav_head');
		if (scroll >= 70) {
			navbar.addClass('scrolling');
		} else {
			navbar.removeClass('scrolling');
		}
	});

	/* Menü Button Klasse nach klick auf aktiv setzen */
	$('.hamburger').on('click', function() {
		$(this).toggleClass('is-active');
		$('#main_menu').toggleClass('show_menu');
	});

	/* Animmiertes Scrollen zu einem Element */
	$('.js_scroll_to').on('click', function() {
		var scroll_to = $(this).data('scrollto');
		var offset = 160;
		if($(this).hasClass('no_offset')) {
			offset = 80;
		}
		$('html, body').animate({
			scrollTop: ($(scroll_to).offset().top - offset
		)}, 'slow');
	});

	/* Texte animieren */
	var count_elements = $('.text-rotating').text().split('|').length - 1;
	var text_rotating = $('.text-rotating');
	text_rotating.Morphext({
		animation: "flipInX",
		separator: "|",
		speed: text_rotating.data('speed'),
		complete: function () {
			if(this.index == count_elements) {
				$('.textanimation h2.dynamic').addClass('d-none');
				$('.textanimation h2.static').removeClass('d-none');
				$('.text-rotating-container').remove();
			}
		}
	});

	/* Link per JS öffnen */
	$('.js_goto').on('click', function() {
		var go_to_url = $(this).data('href');
		window.location.href = go_to_url;
	});

	var waypoints = $('.js_io_waypoint.start').waypoint(function(direction) {
		/* direction kann "down" oder "up" sein */
		if(direction == 'down') {
			this.element.classList.add('zoom');
		} else if(direction == 'up') {
			this.element.classList.remove('zoom');
		}
	}, {
		offset: waypoint_screen_height
	});
})(jQuery);