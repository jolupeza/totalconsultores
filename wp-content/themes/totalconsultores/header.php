<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />

    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Script required for extra functionality on the comment form -->
    <?php if (is_singular()) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="Header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <?php
              $customLogoId = get_theme_mod('custom_logo');
              $logo = wp_get_attachment_image_src($customLogoId, 'full');
            ?>
            <h1 class="Header-logo">
              <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                <img src="<?php echo $logo[0]; ?>" alt="<?php bloginfo('name') ?>|<?php bloginfo('description'); ?>" class="img-responsive center-block" />
              </a>
            </h1>
          </div>
          <div class="col-md-9">
            <?php
              $args = [
                'theme_location' => 'main-menu',
                'container' => 'nav',
                'container_class' => 'Header-menu',
                'menu_class' => 'MainMenu'
              ];

              wp_nav_menu($args);
            ?>
          </div>
        </div>
      </div>
    </header>