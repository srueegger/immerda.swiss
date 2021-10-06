<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
      paceOptions = {
        eventLag: false
      };
    </script>
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
      $scroll_nav_menu_id = get_field( 'page_has_scrollnav', get_queried_object_id() );
      if( !empty( $scroll_nav_menu_id ) ) {
        $scroll_items = wp_get_nav_menu_items( $scroll_nav_menu_id );
        if( !empty( $scroll_items ) ) {
          echo '<ul class="side_btns list-unstyled">';
          foreach( $scroll_items as $item ) {
            echo '<li><a class="js_scroll_nav" href="' . esc_url( $item->url ) . '">' . esc_attr( $item->title ) . '</a></li>';
          }
          echo '</ul>';
        }
      }
      ?>
      <header>
        <nav id="nav_head" class="navbar navbar-toggleable-lg fixed-top shadow">
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
      <main id="site_main">