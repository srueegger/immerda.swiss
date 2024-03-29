<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <script>
      paceOptions = {
        eventLag: false
      };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Secular+One&display=swap" rel="stylesheet"> 
    <?php wp_head(); ?>
    <script src="https://kit.fontawesome.com/402771fbad.js" crossorigin="anonymous"></script>
  </head>
  <?php
  /* Hintergrundfarbe der Seite definieren */
  $page_bg_color = get_field( 'page_bg_color', get_queried_object_id() );
  $page_background = '';
  if( is_page() ) {
    if( empty( $page_bg_color ) ) {
      $page_background = ' style="background: #fff;"';
    } else {
      $page_background = ' style="background: ' . $page_bg_color . ';"';
    }
  }
  ?>
  <body <?php body_class(); ?><?php echo $page_background; ?>>
    <div id="main_wrapper">
      <?php
      /* Sidebar Menü anzeigen, falls eines konfiguriert wurde */
      get_sidebar( 'sidemenu' );
      ?>
      <header>
        <nav id="nav_head" class="navbar navbar-toggleable-lg fixed-top shadow">
          <div class="container position-relative">
            <a class="navbar-brand" target="_self" href="<?php echo HOME_URI; ?>">
             <?php the_field( 'sys_logo_txt', 'option' ); ?>
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
              if( is_woocommerce() ) {
                global $woocommerce;
                echo '<li class="list-inline-item"><a target="_self" href="' . esc_url( $woocommerce->cart->get_cart_url() ) . '"><i class="far fa-shopping-cart cart-icon"></i></a></li>';
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
          'depth' => 2
        );
        wp_nav_menu( $args );
        ?>
      </div>
      <main id="site_main">