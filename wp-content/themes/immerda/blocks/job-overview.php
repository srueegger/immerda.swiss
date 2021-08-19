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
    echo '<ul class="overview_list">';
    foreach( $jobs as $job ) {
      echo '<li><a href="' . get_the_permalink( $job->ID ) . '" class="fw-bold" target="_self">' . get_the_title( $job->ID ) . '<span class="fa-stack"><i class="fas fa-circle fa-stack-2x"></i><i class="fas fa-long-arrow-right fa-stack-1x fa-inverse"></i></span></a></li>';
    }
    echo '</ul>';
  } else {
    /* Keine Jobs vorhanden - Info ausgeben */
    echo '<h3>' . get_field( 'block_jobs_none' ) . '</h3>';
  }
  ?>
</div>