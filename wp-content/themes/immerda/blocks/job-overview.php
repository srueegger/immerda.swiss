<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'jobs-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'jobs_overview';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
  <?php
  /* Jobs ermitteln (Child Pages) */
  $args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent' => get_queried_object_id(),
  );
  $jobs = get_posts( $args );
  if( !empty( $jobs ) ) {
    /* Jobs ausgeben */
    echo '<div class="list-group">';
    foreach( $jobs as $job ) {
      echo '<a href="' . get_the_permalink( $job->ID ) . '" target="_self" class="list-group-item">' . get_the_title( $job->ID ) . '</a>';
    }
    echo '</div>';
  } else {
    /* Keine Jobs vorhanden - Info ausgeben */
    echo '<h3>' . get_field( 'block_jobs_none' ) . '</h3>';
  }
  ?>
</div>