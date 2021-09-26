<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'image_overlay-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image_overlay';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
  <?php
  if( have_rows( 'block_overlays_layouts' ) ) {
    $overlay_counter = 1;
    while( have_rows( 'block_overlays_layouts' ) ) {
      the_row();
      $row_index = get_row_index();
      $add_class = '';
      if($row_index == 1) {
        $add_class .= ' start';
      }
      if( get_row_layout() == 'color_title' ) {
        /* Titel Layout ausgeben */
        ?>
        <div class="js_io_waypoint bg_<?php echo $row_index . $add_class; ?>">
          <div style="background-color: <?php the_sub_field( 'bg_color' ); ?>;" class="image_overlay--image">
            <div class="container yx_middle">
              <div class="row">
                <div class="col-11 offset-1 col-lg-12 offset-lg-0">
                  <h2 class="text-center image_overlay--title" style="color: <?php the_sub_field( 'txt_color' ); ?>;"><?php the_sub_field( 'title' ); ?></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      } elseif( get_row_layout() == 'image_txt' ) {
        /* Bild und Text ausgeben */
        $image = get_sub_field( 'image' );
        if( wp_is_mobile() ) {
          $image_print = $image['sizes']['slide_mobile'];
          $image_print_2x = $image['sizes']['slide_mobile-2x'];
        } else {
          $image_print = $image['sizes']['slider-lg'];
          $image_print_2x = $image['sizes']['slider-lg-2x'];
        }
        $image_print = $image['url'];
        $image_print_2x = $image['url'];
        ?>
        <style>
          #overlay_index_<?php echo $overlay_counter; ?> .image_overlay--image {
            background-image: url("<?php echo $image_print; ?>");
          }
          @media /* only for retina displays */
          only screen and (min-device-pixel-ratio: 2),
          only screen and (min-resolution: 192dpi),
          only screen and (min-resolution: 2dppx) {
            #overlay_index_<?php echo $overlay_counter; ?> .image_overlay--image {
              background-image: url("<?php echo $image_print_2x; ?>");
            }
          }
        </style>
        <div id="overlay_index_<?php echo $overlay_counter; ?>" class="js_io_waypoint bg_<?php echo $row_index . $add_class; ?>">
          <div class="image_overlay--image image_overlay--txt">
            <div class="container h-100">
              <div class="row h-100">
                <div class="col-11 offset-1 col-lg-12 offset-lg-0 align-self-center">
                  <?php the_sub_field( 'txt' ); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      } elseif( get_row_layout() == 'video' ) {
        ?>
        <div class="js_io_waypoint video bg_<?php echo $row_index . $add_class; ?>">
          <div style="background-color: <?php the_sub_field( 'bg_color' ); ?>;" class="image_overlay--image">
            <div class="id_embed_container">
              <?php the_sub_field( 'video' ); ?>
            </div>
          </div>
        </div>
        <?php
      } elseif( get_row_layout() == 'erlebnisse' ) {
        $taxonomies = get_sub_field( 'tax' );
        /* Erlebnisse laden */
        $args = array(
          'numberposts' => -1,
          'post_status' => 'publish',
          'post_type' => 'id_people',
          'tax_query' => array(
            array(
              'taxonomy' => 'id_people_cats',
              'field' => 'term_id',
              'terms' => $taxonomies
            )
          )
        );
        $erlebnisse = get_posts( $args );
        if( !empty( $erlebnisse ) ) {
          $erlebnis_counter = 1;
          foreach( $erlebnisse as $erlebnis ) {
            if( wp_is_mobile() ) {
              $image = get_field( 'people_image_mobile', $erlebnis->ID );
              $image_print = $image['sizes']['slide_mobile'];
              $image_print_2x = $image['sizes']['slide_mobile-2x'];
              $image_print = $image['url'];
              $image_print_2x = $image['url'];
            } else {
              $image = get_field( 'people_image', $erlebnis->ID );
              $image_print = $image['sizes']['slider-lg'];
              $image_print_2x = $image['sizes']['slider-lg-2x'];
              $image_print = $image['url'];
              $image_print_2x = $image['url'];
            }
            if( get_field( 'people_position', $erlebnis->ID ) ) {
              /* Inhalte werden auf dem Desktop rechts positioniert */
              $background_class = 'right_content';
              $offset_lg = 'offset-lg-8';
            } else {
              /* Inhalte werden auf dem Desktop links positioniert */
              $background_class = 'left_content';
              $offset_lg = 'offset-lg-0';
            }
            ?>
            <style>
              #overlay_index_<?php echo $overlay_counter; ?> .image_overlay--image.erlebnis_image_<?php echo $erlebnis_counter; ?> {
                background-image: url("<?php echo $image_print; ?>");
              }
              @media /* only for retina displays */
                only screen and (min-device-pixel-ratio: 2),
                only screen and (min-resolution: 192dpi),
                only screen and (min-resolution: 2dppx) {
                  #overlay_index_<?php echo $overlay_counter; ?> .image_overlay--image.erlebnis_image_<?php echo $erlebnis_counter; ?> {
                    background-image: url("<?php echo $image_print_2x; ?>");
                  }
                }
            </style>
            <div id="overlay_index_<?php echo $overlay_counter; ?>" class="js_io_waypoint bg_<?php echo $row_index . $add_class; ?>">
              <div class="image_overlay--image image_overlay--txt erlebnis_image_<?php echo $erlebnis_counter; ?>">
                <div class="<?php echo $background_class; ?>">
                  <div class="container position-relative h-100">
                    <div class="row h-100">
                      <div class="col-11 offset-1 col-lg-4 <?php echo $offset_lg; ?> align-self-end mb-40">
                        <h1 class="mb-5"><?php the_field( 'people_quote', $erlebnis->ID ); ?></h1>
                        <?php the_field( 'people_orga', $erlebnis->ID ); ?>
                        <p class="my-lg-4"><?php echo get_the_title( $erlebnis->ID ); ?> - <?php the_field( 'people_job', $erlebnis->ID ); ?></p>
                        <button type="button" data-href="<?php echo get_the_permalink( $erlebnis->ID ); ?>" class="btn btn-outline-light btn-lg js_goto"><?php the_field( 'people_btn', $erlebnis->ID ); ?></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            $erlebnis_counter++;
          }
        }
      }
      $overlay_counter++;
    }
  }
  ?>
</div>