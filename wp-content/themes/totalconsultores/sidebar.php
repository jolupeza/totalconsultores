<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('main-sidebar')) : ?>

  <div class="Sidebar-widget">
    <h3 class="Sidebar-title"><?php bloginfo('title'); ?></h3>
    <p><?php bloginfo('description'); ?></p>
  </div>

<?php endif; ?>
