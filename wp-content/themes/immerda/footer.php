      </main>
      <footer id="site_footer">
        <div id="top_footer">
          <div class="container">
            <div class="row">
              <div class="col-12 text-center text-white">
                <p class="fw-bold sub_1 mb-0"><?php the_field( 'sys_footer_line_1', 'option' ); ?></p>
                <p class="sub_2"><?php the_field( 'sys_footer_line_2', 'option' ); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <ul id="footer_menu" class="mb-0 text-white">
                <?php
                /* Footer Menü ausgeben */
                $locations = get_nav_menu_locations();
                $footer_menu_id = $locations['footer'];
                $footer_menu = wp_get_nav_menu_items( $footer_menu_id );
                if( !empty( $footer_menu ) ) {
                  foreach( $footer_menu as $menu_item ) {
                    $link_target = $menu_item->target ? $menu_item->target : '_self';
                    echo '<li class="text-uppercase"><a class="text-decoration-none text-white" href="' . esc_url( $menu_item->url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_attr( $menu_item->title ) . '</a></li>';
                  }
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </footer>
      <?php get_template_part( 'templates/chat', 'bot' ); ?>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>