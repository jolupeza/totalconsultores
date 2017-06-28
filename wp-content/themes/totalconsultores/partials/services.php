<?php
  $pageParent = get_page_by_title('Servicios');

  $args = [
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'posts_per_page' => -1
  ];

  $services = new WP_Query($args);

  if ($services->have_posts()) :
?>
  <section class="Services hidden-xs hidden-sm">
    <?php while ($services->have_posts()) : ?>
      <?php $services->the_post(); ?>
      <?php if (has_post_thumbnail()) : ?>
        <article class="Services-item">
          <?php the_post_thumbnail('full', [
              'class' => 'img-responsive center-block',
              'alt' => get_the_title()
            ]);
          ?>
          <aside class="Services-title text-uppercase">
            <h3 class="text-center"><?php the_title(); ?>.</h3>
          </aside>
        </article>
      <?php endif; ?>
    <?php endwhile; ?>
  </section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
