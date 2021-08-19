<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'presse-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'presse_block';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
  <?php
  if( have_rows( 'block_presse_content' ) ) {
    echo '<ol class="list-group press_list">';
    while( have_rows( 'block_presse_content' ) ) {
      the_row();
      $link = get_sub_field( 'link' );
      $link_target = $link['target'] ? $link['target'] : '_self';
      ?>
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="me-auto"><?php the_sub_field( 'text' ); ?></div>
        <div><a href="<?php echo $link['url']; ?>" target="<?php echo $link_target; ?>"><?php echo $link['title']; ?></a></div>
        <!-- <span class="badge bg-primary rounded-pill">14</span> -->
      </li>
      <?php
    }
    echo '</ol>';
  }
  ?>
</div>