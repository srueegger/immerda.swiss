<?php
function id_show_icon_shortcode( $atts = array() ) {
  extract( shortcode_atts( array(
    'icon' => 'fas fa-home'
   ), $atts));
  return '<i class="' . $icon . '"></i>';
}
add_shortcode( 'icon', 'id_show_icon_shortcode' );