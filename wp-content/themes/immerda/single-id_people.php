<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
  $image = get_field( 'people_image_detail' );
  ?>
  <div class="people_content">
    <picture>
      <img class="people_content--image" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
    </picture>
    <div class="people_content--imagecontent">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6">
            <h1>«
            <?php
            $quote = get_field( 'people_quote_2' );
            if( empty( $quote ) ) {
              $quote = get_field( 'people_quote' );
            }
            echo $quote;
            ?>
            »</h1>
            <p class="mt-4"><?php the_title(); ?> - <?php the_field( 'people_job' ); ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="people_content--scrolldown">
      <span class="js_scroll_to" data-scrollto="#people_content" role="button">
        <i class="fas fa-arrow-circle-down"></i>
      </span>
    </div>
    <div id="people_content" class="container position-relative">
      <div class="row">
        <div class="col-12">
          <?php the_field( 'people_txt' ); ?>
        </div>
      </div>
    </div>
  </div>
  <?php
endwhile; endif;
get_footer();