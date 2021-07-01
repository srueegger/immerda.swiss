<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
the_title( '<div class="container"><div class="row"><div class="col-12"><h1>', '</h1></div></div></div>' );
/* Inhalt ausgeben */
the_content();
endwhile; endif;
get_footer();