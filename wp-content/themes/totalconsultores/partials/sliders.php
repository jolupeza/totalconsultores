<?php
  $args = [
    'post_type' => 'sliders',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
  ];

  $the_query = new WP_Query($args);

  if ($the_query->have_posts()) :
    $i = 0;
?>
  <section id="carousel-home" class="carousel slide Carousel Carousel--home" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <?php while ($the_query->have_posts()) : ?>
        <?php $the_query->the_post(); ?>

        <?php
          $values = get_post_custom(get_the_id());
          $title = isset($values['mb_title']) ? esc_attr($values['mb_title'][0]) : '';
          $subtitle = isset($values['mb_subtitle']) ? esc_attr($values['mb_subtitle'][0]) : '';
          //$text = isset($values['mb_text']) ? esc_attr($values['mb_text'][0]) : '';
          //$url = isset($values['mb_url']) ? esc_attr($values['mb_url'][0]) : '';
          //$target = isset($values['mb_target']) ? esc_attr($values['mb_target'][0]) : '';
          //$target = (!empty($target) && $target === 'on') ? ' target="_blank" rel="noopener noreferrer"' : '';
          $responsive = isset( $values['mb_responsive'] ) ? esc_attr($values['mb_responsive'][0]) : '';
        ?>

        <div class="item<?php echo ($i === 0) ? ' active' : ''; ?>">
          <?php if (has_post_thumbnail()) : ?>
            <picture>
              <?php if (!empty($responsive)) : ?>
                <source class="img-responsive center-block" media="(max-width: 767px) and (orientation: portrait)" srcset="<?php echo $responsive; ?>" alt="<?php echo get_the_title(); ?>" />
              <?php endif; ?>
              <?php
                the_post_thumbnail('full', [
                  'class' => 'img-responsive center-block',
                  'alt' => get_the_title()
                ]);
              ?>
            </picture>
          <?php endif; ?>
          <div class="carousel-caption">
            <?php if (!empty($subtitle)) : ?><h3><?php echo $subtitle; ?></h3><?php endif; ?>
            <?php if (!empty($title)) : ?><h2><?php echo $title; ?></h2><?php endif; ?>
            <?php the_content(); ?>

            <?php //if (!empty($url)) : ?>
              <p class="text-uppercase js-menu-move-scroll">
                <a class="Button Button--orange" href="#contacto">Escríbenos</a>
                <!-- <a class="Button Button--orange" href="<?php echo $url; ?>"<?php echo $target; ?>><?php echo $text; ?></a> -->
              </p>
            <?php //endif; ?>
          </div>
        </div>
        <?php $i++; ?>
      <?php endwhile; ?>
    </div>

    <!-- <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a> -->

    <button class="Arrow js-move-scroll" data-href="about"><i class="glyphicon glyphicon-chevron-down"></i></button>
  </section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
