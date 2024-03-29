(function ($) {
	/* Globale Variabeln */
	var waypoint_screen_height = calculate_half_screenheight();
	var team_original_image = '';
	var team_original_image_alt = '';
	var body = $('body');

	/* Pace initalisieren */
	Pace.on('done', function () {
		setTimeout(function () {
			$('#main_wrapper').fadeTo('250', 1);
			AOS.init();
			run_text_animation();
			search_team_iframes();
			/* Logo Grösse anpassen bei Chatbot */
			$('.chatbot_chat--header span').addClass('no_font_size');
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
		$('#nav_head').toggleClass('set_black');
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

	function run_text_animation() {
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
	}

	/* Link per JS öffnen */
	$('.js_goto').on('click', function() {
		var go_to_url = $(this).data('href');
		window.location.href = go_to_url;
	});

	/* Animationen auf der Startseite auslösen */
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

	/* Snap Scrolling aktivieren */
	$.scrollify({
		section: '.js_io_waypoint, .textanimation',
		setHeights: false,
		scrollSpeed: 750,
		afterResize:function() {
			/* Screenhöhe aktualisieren */
			waypoint_screen_height = calculate_half_screenheight();
		},
		after:function() {
			/* Navigationspunkte aktualisieren */
			var hash = window.location.hash;
			var new_selected_element = $('.js_scroll_nav[href=' + hash + ']').parent();
			if(new_selected_element.length) {
				$('.js_scroll_nav').parent().removeClass('active');
				new_selected_element.addClass('active');
			}
		},
		afterRender:function() {
			/* Beim Laden des Events, Navigationspunkt initialisieren */
			var hash = window.location.hash;
			if(!hash) {
				hash = '#1';
			}
			var new_selected_element = $('.js_scroll_nav[href=' + hash + ']').parent();
			if( new_selected_element.length ) {
				/* Element existiert, dieses Element als aktiv kennzeichnen */
				new_selected_element.addClass('active');
			} else {
				/* Element existiert nicht, das zugehörige Menü Element finden und markieren */
				var highest_number = 1;
				$('.js_scroll_nav').each(function() {
					var nav_number = $(this).prop('href');
					nav_number = nav_number.substring(nav_number.indexOf('#')).substring(1);
					if(parseInt(hash.substr(1)) > parseInt(nav_number)) {
						highest_number = nav_number;
					}
				});
				$('.js_scroll_nav[href=#' + highest_number + ']').parent().addClass('active');
			}
		}
	});

	/* Scroll Nav on Click */
	$('.js_scroll_nav').on('click', function(event) {
		event.preventDefault();
		var go_to = $(this).prop('href');
		if(go_to.indexOf('#') != -1) {
			$.scrollify.move(go_to.substring(go_to.indexOf('#')));
		} else {
			window.location.href = go_to;
		}
	});

	function calculate_half_screenheight() {
		var half_screen_height = screen.height / 2 - 80;
		return half_screen_height;
	}

	/* Team-Übersicht Hover Effekt */
	$('.teamoverview--container.hover_effect').on({
		mouseenter: function () {
			/* Aktion bei Mouseover */
			var img = $(this).find('img');
			var name = $(this).find('.teamoverview--name');
			/* Daten vom Bild in globale Variabel speichern */
			team_original_image = img.prop('src');
			team_original_image_alt = img.prop('alt');
			/* Bild ändern */
			var new_image_src = img.data('secondimage');
			var new_image_alt = img.data('secondalt');
			img.prop('src', new_image_src);
			img.prop('alt', new_image_alt);
			name.addClass('show');
    },
		mouseleave: function () {
			/* Aktion bei Mouseleave */
			var img = $(this).find('img');
			var name = $(this).find('.teamoverview--name');
			/* Bild wieder zurücksetzen */
			img.prop('src', team_original_image);
			img.prop('alt', team_original_image_alt);
			name.removeClass('show');
    }
	});

	/* Team-Übersicht Klick Effekt */
	$('.teamoverview--container').on('click', function() {
		/* Alle Boxen entfernen */
		$('.teamoverview--content').removeClass('show');
		/* Box bei geklicktem Element hinzufügen */
		var content = $(this).find('.teamoverview--content');
		content.addClass('show');
	});

	/* Falls ein iFrame auf einer Teamseite ein Responsive Embed hinzufügen*/
	function search_team_iframes() {
		if(body.hasClass('id_people-template-default')) {
			var iframe = $('iframe');
			if(iframe.length) {
				$('#people_content').removeClass('container');
				iframe.parent().parent().parent().removeClass('row');
				iframe.parent().addClass('id_embed_container').addClass('absolute_container');
				/* Höhe vom iframe ermitteln */
				correct_frame_embed_size();
			}
		}
	}

	/* Da iframe absolut positioniert wird, muss die Höhe vom Content Container an das iframe nagepasst werden, damit der Footer nicht verdeckt wird. */
	function correct_frame_embed_size() {
		var iframe = $('iframe');
		if(iframe.length) {
			var frame_height = iframe.outerHeight();
			$('#people_content').css('height', frame_height);
		}
	}

	/* Höhe von Video Frame bei Grösse ändern anpassen */
	$( window ).resize(function() {
		correct_frame_embed_size();
	});

	/* Chatbot starten */
	$('#chatbot_icon').on('click', function() {
		/* Chatbot nut öffnen wenn er noch nicht offen ist */
		var chatbot = $('#chatbot_chat');
		if(!chatbot.hasClass('show')) {
			/* HTML Inhalt leeren */
			var chatbot_message_area = $('.chatbot_chat--body--inner');
			chatbot_message_area.html('');
			/* Chatbot anzeigen */
			chatbot.addClass('show');
			/* Einleitungstexte anzeigen */
			chatbot_render_messages(id_vars.chatbot.welcome);
		}
	});

	function chatbot_render_messages(messages_object) {
		var chatbot_message_area = $('.chatbot_chat--body--inner');
		$.each(messages_object, function(key, value) {
			/* "msg_typ" auslesen. Mögliche Werte sind:
			txt = für eine Chatbot Nachricht
			asw = für eine Antwortoption 
			form = Eingabefeld */
			var $this = value;
			setTimeout(function(){
				if($this.msg_typ == 'txt') {
					/* Textnachricht ausgeben */
					chatbot_message_area.append( chatbot_render_txt_msg($this.text, 'bot') );
				} else if($this.msg_typ == 'asw') {
					/* Antwortoption ausgeben */
					chatbot_message_area.append( chatbot_render_answer_option($this.resp, $this.resp_id) );
				} else if($this.msg_typ == 'form') {
					/* Formularfeld ausgeben */
					chatbot_message_area.append( chatbot_render_formarea($this.formname, $this.resp_id, $this.sendmail, $this.mailadr) );
				}
				scroll_chatbot_to_bottom();
			}, 1000 * key);
		});
	}

	/* Chatbot Nachrichten renden */
	/* Variabel: sender = bot or user */
	function chatbot_render_txt_msg(msg, sender) {
		var now = new Date();
		if(sender == 'bot') {
			var message = id_vars.chatbot.msg_before;
		} else if(sender == 'user') {
			var message = id_vars.chatbot.msg_before_user;
		}
		message += msg;
		message += id_vars.chatbot.msg_after;
		if(sender == 'bot') {
			message += id_vars.chatbot.name;
		} else if (sender == 'user') {
			message += id_vars.chatbot.name_user;
		}
		message += ', ' + now.getHours() + ':' + now.getFullMinutes();
		message += '</div>';
		return message;
	}

	/* Antowrtoption rendern */
	function chatbot_render_answer_option(msg, response_id) {
		var message = '<div class="bot_message"><button data-responseid="' + response_id + '" class="response_btn" type="button">';
		message += msg;
		message += '</button></div>';
		return message;
	}

	/* Chatbot Eingabefeld rendern */
	function chatbot_render_formarea( msg, response_id, sendmail, mailadr ) {
		var message = '<form data-sendmail="' + sendmail + '" data-mailadress="' + mailadr + '" autocomplete="off" class="chatbot_input_form" action=""><div class="input-group"><input type="hidden" name="responseid" value="' + response_id + '"><input type="text" class="form-control" name="inputxt" placeholder="' + msg + '" required><button class="btn btn-primary" type="submit"><i class="fas fa-angle-right text-white"></i></button></div></form>';
		return message;
	}

	/* Chatbot Funktionen ausführen wenn auf eine Antwort geklickt wird */
	$(document).on('click', '.response_btn', function() {
		var chatbot_message_area = $('.chatbot_chat--body--inner');
		var clicked_btn_text = $(this).text();
		var response_id = $(this).data('responseid');
		var response_btns = $('.response_btn');
		/* Alle Buttons ausblenden und entfernen */
		response_btns.parent().fadeOut(250);
		/* Wieder nach unten scrollen */
		scroll_chatbot_to_bottom();
		chatbot_message_area.append( chatbot_render_txt_msg(clicked_btn_text, 'user') );
		/* Korrektes Antwortobject suchen */
		var new_messages;
		$.each(id_vars.chatbot.conclusions, function(index, value) {
			if( parseInt( value.id ) == response_id ) {
				/* Antwort gefunden */
				new_messages = value.interactions;
				return false;
			}
		});
		chatbot_render_messages(new_messages);
	});

	/* Chatbot Funktion ausführen wenn ein Formularfeld ausgefüllt wird */
	$(document).on('submit', '.chatbot_input_form', function(event) {
		event.preventDefault();
		var chatbot_message_area = $('.chatbot_chat--body--inner');
		var sendmail = $(this).data('sendmail');
		/* 
		0: responseid
		1: Input text
		 */
		var form_datas = $(this).serializeArray();
		/* Eingabeformular ausblenden und entfernen */
		$(this).fadeOut(250);
		setTimeout(function() {
			/* Das entfernen ist wichtig, damit bei einem nachfolgenden Formular diese nicht auch submitet wird */
			$(this).remove();
		}, 250);
		/* Wieder nach unten scrollen */
		scroll_chatbot_to_bottom();
		/* Den eingegebene Text als NAchricht anzeigen */
		chatbot_message_area.append( chatbot_render_txt_msg(form_datas[1].value, 'user') );
		/* Prüfen ob eine E-Mail gesendet werden muss */
		if( sendmail === true ) {
			/* E-Mail sehen */
			var mail_adresse = $(this).data('mailadress');
			var bot_inhalt = chatbot_message_area.html();
			$.ajax({
				type: 'POST',
				url: id_vars.ajax_url,
				data: {
					action: 'chatbot_send_mail_ajax',
					email: mail_adresse,
					bot_content: bot_inhalt
				}
    });
		}
		/* Korrektes Antwortobject suchen */
		var new_messages;
		$.each(id_vars.chatbot.conclusions, function(index, value) {
			if( parseInt( value.id ) == parseInt( form_datas[0].value ) ) {
				/* Antwort gefunden */
				new_messages = value.interactions;
				return false;
			}
		});
		chatbot_render_messages(new_messages);
	});

	/* Chatbot schliessen */
	$('#chatbot_close').on('click', function() {
		$('#chatbot_chat').removeClass('show');
	});

	/* Beim Chatbot nach unten scrollen */
	function scroll_chatbot_to_bottom() {
		var div = document.getElementById('chatbot_body');
		$('#chatbot_body').animate({
			 scrollTop: div.scrollHeight - div.clientHeight
		}, 500);
	}

	/* JavaScript Date - Minuten mit führender 0 ausgeben*/
	Date.prototype.getFullMinutes = function () {
		if (this.getMinutes() < 10) {
				return '0' + this.getMinutes();
		}
		return this.getMinutes();
 	};
 
})(jQuery);