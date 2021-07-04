<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'textanimation-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'textanimation position-relative';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
  <div class="container my-auto">
    <div class="row">
      <div class="col-12">
        <div class="text-rotating-container">
          <h2 class="text-center dynamic">
            <span data-speed="<?php the_field( 'block_ta_speed' ); ?>" class="text-rotating">
              <?php
              $count_statements = count( get_field( 'block_ta_txts' ) );
              if( have_rows( 'block_ta_txts' ) ) {
                while( have_rows( 'block_ta_txts' ) ) {
                  the_row();
                  $statement_text = get_sub_field( 'txt' );
                  echo $statement_text;
                  if( get_row_index() < $count_statements ) {
                    echo '|';
                  }
                }
              }
              ?>
            </span>
          </h2>
        </div>
        <h2 class="text-center static animated pulse infinite hinge d-none"><span class="id_logo no_font_size">#<span>immer</span>da</span></h2>
      </div>
    </div>
  </div>
  <div class="scroll_down_container text-center">
    <span class="js_scroll_to no_offset" data-scrollto=".js_scroll_me" role="button">
      <i class="fas fa-arrow-circle-down fa-3x"></i>
    </span>
  </div>
</div>