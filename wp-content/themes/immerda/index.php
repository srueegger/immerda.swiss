<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
  /* Prüfen ob der Titel angezeigt werden soll */
  if( !get_field( 'page_hide_title' ) ) {
    /* Prüfen ob der Titel eine spezielle Farbe hat */
    $page_title_color = get_field( 'page_title_color' );
    $title_style = '';
    if( !empty( $page_title_color ) ) {
      $title_style = ' style="color: ' . $page_title_color . '"';
    }
    the_title( '<div class="container header_spacer mb-5"><div class="row"><div class="col-12"><h1 class="text-uppercase"' . $title_style . '>', '</h1></div></div></div>' );
  }
  /* Inhalt ausgeben */
  if( is_woocommerce() ) {
    if( is_product() ) {
      echo '<div class="container mb-4"><div class="row"><div class="col-12">';
      echo '<a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '"><i class="far fa-long-arrow-left"></i> ' . __( 'Zurück zum Shop' ) . '</a>';
      echo '</div></div></div>';
    }
    echo '<div class="container"><div class="row"><div class="col-12">';
    the_content();
    echo '</div></div></div>';
  } else {
    the_content();
  }
endwhile; endif;
get_footer();