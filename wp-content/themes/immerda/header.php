<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <script src="https://kit.fontawesome.com/402771fbad.js" crossorigin="anonymous"></script>
  </head>
  <body <?php body_class(); ?>>
    <div id="main_wrapper">
      <div id="side_btn" class="shadow">
        <a class="text-decoration-none text-white text-uppercase" href="<?php echo get_the_permalink( get_field( 'sys_soli_page', 'option' ) ); ?>" target="_self"><?php _e( 'Solidarisieren' ); ?></a>
      </div>
      <header>
        <nav id="nav_head" class="navbar navbar-toggleable-lg fixed-top">
          <div class="container position-relative">
            <a class="navbar-brand" target="_self" href="<?php echo HOME_URI; ?>">
             <span class="id_logo text-white">#<span>immer</span>da</span>
            </a>
            <button class="hamburger hamburger--elastic mx-auto" type="button" aria-label="Toggle navigation">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
            <?php
            /* Social Menü ausgeben */
            $locations = get_nav_menu_locations();
            $social_menu_id = $locations['social'];
            $social_menu = wp_get_nav_menu_items( $social_menu_id );
            if( !empty( $social_menu ) ) {
              echo '<div id="social_menu_container"><ul id="social_menu" class="list-inline mb-0">';
              foreach( $social_menu as $menu_item ) {
                $link_target = $menu_item->target ? $menu_item->target : '_self';
                $link_icon = get_field( 'socialmenu_icon', $menu_item );
                echo '<li class="list-inline-item"><a href="' . esc_url( $menu_item->url ) . '" target="' . esc_attr( $link_target ) . '"><i class="' . esc_attr( $link_icon ) . '"></i></a></li>';
              }
              echo '</ul></div>';
            }
            id_custom_lng_switch();
            ?>
          </div>
        </nav>
      </header>
      <div id="main_menu">
        <?php
        $args = array(
          'theme_location' => 'main',
          'container' => 'div',
          'container_id' => 'main_menu_content',
          'menu_class' => '',
          'menu_id' => 'immerda_nav_list',
          'fallback_cb' => '__return_false',
          'items_wrap' => '<ul id="%1$s" class="navbar-nav mx-auto mb-2 mb-lg-0 %2$s">%3$s</ul>',
          'depth' => 2,
          //'walker' => new bootstrap_5_wp_nav_menu_walker()
        );
        wp_nav_menu( $args );
        ?>
      </div>
      <?php
      /* Prüfen ob die Seite einen speziellen Hintergrund haben soll */
      $add_background_class = '';
      if( get_field( 'page_background', get_queried_object_id() ) ) {
        $add_background_class = ' class="special_background"';
      }
      ?>
      <main id="site_main"<?php echo $add_background_class; ?>>