<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
  $image = get_field( 'people_image_detail' );
  if( get_field( 'people_position_2' ) ) {
    /* Inhalt ist rechts positioniert */
    $offset_lg = 'offset-lg-7';
  } else {
    /* Inhalt ist links positioniert */
    $offset_lg = '';
  }
  ?>
  <div class="people_content position-relative">
    <picture>
      <img class="people_content--image" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
    </picture>
    <div class="people_content--imagecontent">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-5 <?php echo $offset_lg; ?>">
            <h1>
            <?php
            $quote = get_field( 'people_quote_2' );
            echo '<span class="font_quote">&bdquo;</span>';
            if( empty( $quote ) ) {
              $quote = get_field( 'people_quote' );
            }
            echo $quote;
            echo '<span class="font_quote">&ldquo;</span>';
            ?></h1>
            <p class="mt-4"><?php the_title(); ?> - <?php the_field( 'people_job' ); ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="people_content--scrolldown w-100">
      <span class="js_scroll_to no_offset" data-scrollto="#people_content" role="button">
        <i class="fas fa-arrow-circle-down fa-fw"></i>
      </span>
    </div>
    <div id="people_content" class="container position-relative">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <?php the_field( 'people_txt' ); ?>
        </div>
      </div>
    </div>
  </div>
  <?php
endwhile; endif;
get_footer();