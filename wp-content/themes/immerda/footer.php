      </main>
      <footer id="site_footer">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <ul id="footer_menu" class="mb-0 text-black">
                <li class="text-uppercase"><i class="fal fa-copyright me-1"></i>Helfen helfen<sup><i class="fal fa-registered"></i></sup> Schweiz</i></li>
                <?php
                /* Footer Menü ausgeben */
                $locations = get_nav_menu_locations();
                $footer_menu_id = $locations['footer'];
                $footer_menu = wp_get_nav_menu_items( $footer_menu_id );
                if( !empty( $footer_menu ) ) {
                  foreach( $footer_menu as $menu_item ) {
                    $link_target = $menu_item->target ? $menu_item->target : '_self';
                    echo '<li class="text-uppercase"><a class="text-decoration-none" href="' . esc_url( $menu_item->url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_attr( $menu_item->title ) . '</a></li>';
                  }
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>