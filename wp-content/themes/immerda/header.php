<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="main_wrapper">
      <header>
        <nav id="nav_head" class="navbar navbar-expand-lg">
          <div class="container">
            <a class="navbar-brand" target="_self" href="<?php echo HOME_URI; ?>">
              <?php
              $custom_logo_id = get_theme_mod( 'custom_logo' );
              $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
              ?>
              <picture>
                <img width="210" height="42" src="<?php echo esc_url( $logo[0] ); ?>" alt="Immerda Logo">
              </picture>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#immerda_nav" aria-controls="immerda_nav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="immerda_nav">
              <?php
              $args = array(
                'theme_location' => 'main',
                'container' => false,
                'menu_class' => '',
                'menu_id' => 'immerda_nav_list',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<ul id="%1$s" class="navbar-nav mx-auto mb-2 mb-lg-0 %2$s">%3$s</ul>',
                'depth' => 2,
                'walker' => new bootstrap_5_wp_nav_menu_walker()
              );
              wp_nav_menu( $args );
              ?>
            </div>
          </div>
        </nav>
      </header>
      <main id="site_main">