<?php
/* Gravitsyforms Optionen */
function place_zip_before_city() {
	return 'zip_before_city';
}
add_filter( 'gform_address_display_format', 'place_zip_before_city' );