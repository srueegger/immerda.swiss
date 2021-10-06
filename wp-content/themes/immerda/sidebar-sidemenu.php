<?php
$scroll_nav_menu_id = get_field( 'page_has_scrollnav', get_queried_object_id() );
if( !empty( $scroll_nav_menu_id ) ) {
  $scroll_items = wp_get_nav_menu_items( $scroll_nav_menu_id );
  if( !empty( $scroll_items ) ) {
    echo '<ul class="side_btns list-unstyled">';
    foreach( $scroll_items as $item ) {
      $color = '';
      if( get_field( 'menu_color', $item ) ) {
        $color = ' class="red"';
      }
      echo '<li' . $color . '><a class="js_scroll_nav" href="' . esc_url( $item->url ) . '">' . esc_attr( $item->title ) . '</a></li>';
    }
    echo '</ul>';
  }
}