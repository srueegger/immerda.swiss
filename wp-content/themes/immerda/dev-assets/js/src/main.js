(function ($) {
	/* Pace initalisieren */
	Pace.on('done', function () {
		setTimeout(function () {
			$('#main_wrapper').fadeTo('250', 1);
		}, 0);
	});
})(jQuery);