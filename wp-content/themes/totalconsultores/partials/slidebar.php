<?php $options = get_option('tc_custom_settings'); ?>

<section class="Slidebar">
  <aside class="Slidebar-close">
    <i class="icon-close js-toggle-slidebar"></i>
  </aside>

  <article class="Slidebar-content">
    <?php
      $args = [
        'theme_location' => 'main-menu',
        'container' => 'nav',
        'container_class' => 'Header-menu',
        'menu_class' => 'MainMenu'
      ];

      wp_nav_menu($args);
    ?>

    <article class="Slidebar-info">
      <?php if (!empty($options['phone'])) : ?>
        <p class="Slidebar-text text-center"><?php echo $options['phone']; ?></p>
      <?php endif; ?>

      <?php if (!empty($options['email'])) : ?>
        <p class="Slidebar-text text-center"><?php echo $options['email']; ?></p>
      <?php endif; ?>
    </article>

    <?php if ($options['display_social_link'] && !is_null($options['display_social_link'])) : ?>
      <ul class="Slidebar-social">
        <?php if (!empty($options['facebook'])) : ?>
          <li class="Slidebar-social-item">
            <a href="https://www.facebook.com/<?php echo $options['facebook']; ?>" title="Ir a Facebook" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          </li>
        <?php endif; ?>
        <?php if (!empty($options['twitter'])) : ?>
          <li class="Slidebar-social-item">
            <a href="https://twitter.com/<?php echo $options['twitter']; ?>" title="Ir a Twitter" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          </li>
        <?php endif; ?>
        <?php if (!empty($options['instagram'])) : ?>
          <li class="Slidebar-social-item">
            <a href="https://www.instagram.com/<?php echo $options['instagram']; ?>" title="Ir a Instagram" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          </li>
        <?php endif; ?>
      </ul>
    <?php endif; ?>
  </article>
</section>
