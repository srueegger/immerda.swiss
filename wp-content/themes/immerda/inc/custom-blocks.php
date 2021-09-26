<?php
if( function_exists('acf_register_block_type') ):

  acf_register_block_type(array(
    'name' => 'id_erlebnis_slider',
    'title' => 'Erlebnis - Slider',
    'description' => 'Dieser Block zeigt einen Slider mit ausgewählten Erlebnisberichten',
    'category' => 'widgets',
    'keywords' => array(
      0 => 'Erlebnis',
      1 => 'Slider',
      2 => 'Startseite',
    ),
    'post_types' => array(
      0 => 'page',
    ),
    'mode' => 'edit',
    'align' => '',
    'align_content' => NULL,
    'render_template' => 'blocks/erlebnis-slider.php',
    'render_callback' => '',
    'enqueue_style' => '',
    'enqueue_script' => '',
    'enqueue_assets' => '',
    'icon' => 'groups',
    'supports' => array(
      'align' => true,
      'mode' => true,
      'multiple' => true,
      'jsx' => false,
      'align_content' => false,
      'anchor' => false,
    ),
  ));
  
  acf_register_block_type(array(
    'name' => 'id_text_animation',
    'title' => 'Text Animation',
    'description' => 'Dieser Block zeigt eine Text Animation an.',
    'category' => 'widgets',
    'keywords' => array(
      0 => 'text',
      1 => 'animation',
      2 => 'startseite',
    ),
    'post_types' => array(
      0 => 'page',
    ),
    'mode' => 'edit',
    'align' => '',
    'align_content' => NULL,
    'render_template' => 'blocks/textanimation.php',
    'render_callback' => '',
    'enqueue_style' => '',
    'enqueue_script' => '',
    'enqueue_assets' => '',
    'icon' => 'editor-textcolor',
    'supports' => array(
      'align' => false,
      'mode' => true,
      'multiple' => true,
      'jsx' => false,
      'align_content' => false,
      'anchor' => false,
    ),
  ));
  
  acf_register_block_type(array(
    'name' => 'jobs_overview',
    'title' => 'Job Übersicht',
    'description' => 'Zeigt die Job-Übersicht an',
    'category' => 'widgets',
    'keywords' => array(
      0 => 'job',
    ),
    'post_types' => array(
      0 => 'page',
    ),
    'mode' => 'edit',
    'align' => '',
    'align_content' => NULL,
    'render_template' => 'blocks/job-overview.php',
    'render_callback' => '',
    'enqueue_style' => '',
    'enqueue_script' => '',
    'enqueue_assets' => '',
    'icon' => 'businessman',
    'supports' => array(
      'align' => false,
      'mode' => true,
      'multiple' => true,
      'jsx' => false,
      'align_content' => false,
      'anchor' => false,
    ),
  ));

  acf_register_block_type(array(
    'name' => 'image_overlays',
    'title' => 'Bild Overlay',
    'description' => 'Zeigt ein Bild-Overlay an',
    'category' => 'widgets',
    'keywords' => array(
      0 => 'apple',
      1 => 'overlay',
      2 => 'image'
    ),
    'post_types' => array(
      0 => 'page',
    ),
    'mode' => 'edit',
    'align' => '',
    'align_content' => NULL,
    'render_template' => 'blocks/image-overlay.php',
    'render_callback' => '',
    'enqueue_style' => '',
    'enqueue_script' => '',
    'enqueue_assets' => '',
    'icon' => 'images-alt',
    'supports' => array(
      'align' => false,
      'mode' => true,
      'multiple' => true,
      'jsx' => false,
      'align_content' => false,
      'anchor' => false,
    ),
  ));

  acf_register_block_type(array(
    'name' => 'presse_block',
    'title' => 'Pressebereich',
    'description' => 'Zeigt die Presseübersicht',
    'category' => 'widgets',
    'keywords' => array(
      0 => 'presse'
    ),
    'post_types' => array(
      0 => 'page',
    ),
    'mode' => 'edit',
    'align' => '',
    'align_content' => NULL,
    'render_template' => 'blocks/presse.php',
    'render_callback' => '',
    'enqueue_style' => '',
    'enqueue_script' => '',
    'enqueue_assets' => '',
    'icon' => 'images-alt',
    'supports' => array(
      'align' => false,
      'mode' => true,
      'multiple' => true,
      'jsx' => false,
      'align_content' => false,
      'anchor' => false,
    ),
  ));

  acf_register_block_type(array(
    'name' => 'facts_and_figures',
    'title' => 'Zahlen und Fakten',
    'description' => 'Zeigt die Zahlen und Fakten mit einer animierten Uhr',
    'category' => 'widgets',
    'keywords' => array(
      0 => 'zahlen',
      1 => 'fakten',
      2 => 'uhr'
    ),
    'post_types' => array(
      0 => 'page',
    ),
    'mode' => 'edit',
    'align' => '',
    'align_content' => NULL,
    'render_template' => 'blocks/factsfigures.php',
    'render_callback' => '',
    'enqueue_style' => '',
    'enqueue_script' => '',
    'enqueue_assets' => '',
    'icon' => 'info-outline',
    'supports' => array(
      'align' => false,
      'mode' => true,
      'multiple' => true,
      'jsx' => false,
      'align_content' => false,
      'anchor' => false,
    ),
  ));

  acf_register_block_type(array(
    'name' => 'team_overview',
    'title' => 'Team Übersicht',
    'description' => 'Zeigt die Übersicht der Teammitglieder an',
    'category' => 'widgets',
    'keywords' => array(
      0 => 'team',
      1 => 'mitarbeiter',
      2 => 'übersicht'
    ),
    'post_types' => array(
      0 => 'page',
    ),
    'mode' => 'edit',
    'align' => '',
    'align_content' => NULL,
    'render_template' => 'blocks/teamoverview.php',
    'render_callback' => '',
    'enqueue_style' => '',
    'enqueue_script' => '',
    'enqueue_assets' => '',
    'icon' => 'info-outline',
    'supports' => array(
      'align' => false,
      'mode' => true,
      'multiple' => true,
      'jsx' => false,
      'align_content' => false,
      'anchor' => false,
    ),
  ));
  
  endif;