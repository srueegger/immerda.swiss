<?php
/* Template Name: Shop-Seite */
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
  echo '<div class="container"><div class="row"><div class="col-12">';
  the_content();
  echo '</div></div></div>';
endwhile; endif;
get_footer();