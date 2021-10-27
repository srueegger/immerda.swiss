<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'teamoverview-' . $block['id'];
if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'teamoverview container-fluid';
if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}
?>
<div data-aos="fade-up" id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
  <?php
  $args = array(
    'numberposts' => -1,
    'post_status' => 'publish',
    'post_type' => 'id_team',
    'orderby' => 'rand',
    'suppress_filters' => false
  );
  $team_members = get_posts( $args );
  if( !empty( $team_members ) ) {
    /* Team Einträge ausgeben */
    echo '<div class="row">';
    foreach( $team_members as $team ) {
      $image_1 = get_field( 'team_img_1', $team->ID );
      $image_2 = get_field( 'team_img_2', $team->ID );
      /* Mobile muss ein anderes Bild ausgegeben werden */
      if( wp_is_mobile() ) {
        $image_output = $image_2['url'];
        $image_alt_output = $image_2['alt'];
        $hover_effect = '';
        $showname = ' show';
      } else {
        $image_output = $image_1['url'];
        $image_alt_output = $image_1['alt'];
        $hover_effect = ' hover_effect';
        $showname = '';
      }
      $team_mail = get_field( 'team_mail', $team->ID );
      ?>
      <div class="col-12 col-md-6 col-lg-4 teamoverview--container position-relative<?php echo $hover_effect; ?>">
        <picture>
          <img loading="lazy" data-secondimage="<?php echo esc_url( $image_2['url'] ); ?>" data-secondalt="<?php echo esc_attr( $image_2['alt'] ); ?>" class="teamoverview--image" src="<?php echo esc_url( $image_output ); ?>" alt="<?php echo esc_attr( $image_alt_output ); ?>">
        </picture>
        <div class="teamoverview--name<?php echo $showname; ?>">
          <p><?php echo get_the_title( $team->ID ); ?></p>
        </div>
        <div class="teamoverview--icon">
          <i class="fas fa-arrow-right"></i>
        </div>
        <div id="team-<?php echo $team->ID; ?>" class="teamoverview--content">
          <p class="teamoverview--content--title"><?php echo get_the_title( $team->ID ); ?></p>
          <p class="teamoverview--content--desc"><?php the_field( 'team_job_desc', $team->ID ); ?></p>
          <blockquote><?php the_field( 'team_quote', $team->ID ); ?></blockquote>
          <p class="teamoverview--content--mail"><a href="mailto:<?php echo $team_mail; ?>"><?php echo $team_mail; ?></a></p>
        </div>
      </div>
      <?php
    }
    echo '</div>';
  }
  ?>
</div>