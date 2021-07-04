<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'erlebnis_slider-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'erlebnis_slider';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" style="background: gray;" class="<?php echo esc_attr( $className ); ?>">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php
        $args = array(
          'numberposts' => -1,
          'post_status' => 'publish',
          'post_type' => 'id_people',
          'tax_query' => array(
            array(
              'taxonomy' => 'id_people_cats',
              'field' => 'term_id',
              'terms' => get_field( 'block_es_tax' )
            )
          )
        );
        $erlebnisse = get_posts( $args );
        $count_erlebnisse = count( $erlebnisse );
        if( !empty( $erlebnisse ) ) {
          echo '<div id="carousel_' . esc_attr( $id ) . '" class="carousel slide" data-bs-ride="carousel">';
          if( $count_erlebnisse > 1 ) {
            /* Carousel Indikatoren anzeigen */
            echo '<div class="carousel-indicators">';
            for($i = 0; $i < $count_erlebnisse; $i++) {
              $add_active_class = '';
              if( $i == 0 ) {
                $add_active_class = ' class="active" aria-current="true"';
              }
              echo '<button type="button" data-bs-target="#carousel_' . esc_attr( $id ) . '" data-bs-slide-to="' . $i . '"'. $add_active_class .'></button>';
            }
            echo '</div>';
          }
          echo '<div class="carousel-inner">';
          $counter = 0;
          foreach( $erlebnisse as $erlebnis ) {
            $add_active = '';
            if($counter == 0) {
              $add_active = ' active';
            }
            $image_desktop = get_field( 'people_image', $erlebnis->ID );
            ?>
            <div class="carousel-item<?php echo $add_active; ?>">
              <a href="<?php echo get_the_permalink( $erlebnis->ID ); ?>" target="_self"><div class="carousel_content">
                <picture>
                  <source srcset="<?php echo $image_desktop['sizes']['slider-lg']; ?> 1x, <?php echo $image_desktop['sizes']['slider-lg-2x']; ?> 2x">
                  <img loading="lazy" src="<?php echo $image_desktop['sizes']['slider-lg']; ?>" alt="<?php echo $image_desktop['alt']; ?>">
                </picture>
                <div class="carousel_content--text row">
                  <div class="col-12 col-lg-8 offset-lg-4">
                    <h1><?php the_field( 'people_quote', $erlebnis->ID ); ?></h1>
                    <?php the_field( 'people_orga', $erlebnis->ID ); ?>
                    <p><?php echo get_the_title( $erlebnis->ID ); ?> - <?php the_field( 'people_job', $erlebnis->ID ); ?></p>
                  </div>
                </div>
              </div></a>
            </div>
            <?php
            $counter++;
          }
          echo '</div></div>';
        }
        ?>
      </div>
    </div>
  </div>
</div>