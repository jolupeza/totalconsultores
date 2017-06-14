<?php
  /**
   * Template Name: TC Nosotros
   */
?>
<?php get_header('black'); ?>

<?php
  $idPage = 0;
  $parallaxAbout = null;
?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : ?>
    <?php the_post(); ?>

    <?php
      $idPage = get_the_id();
      $val = get_post_custom($idPage);
      $parallaxAbout = isset($val['mb_parallax']) ? esc_attr($val['mb_parallax'][0]) : $parallaxAbout;
    ?>
    <section class="Page Page--borderOrange Page--intro">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <h4 class="Page-legend text-uppercase text-right text-title">Pasión por.</h4>
            <h3 class="Page-resalt text-uppercase text-right text-orange">Construir</h3>
            <hr class="Page-separator Page-separator--short Page-separator--right Page-separator--orange">
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-6">
            <?php the_content(); ?>
            <p class="Page-link"><a href=""><i class="icon-play"></i> Ver Video Institucional</a></p>
          </div>
        </div>

        <?php
          $args = [
            'post_type' => 'customers',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
          ];

          $the_query = new WP_Query($args);

          if ($the_query->have_posts()) :
        ?>
          <article class="Page-section">
            <h3 class="text-center Page-subtitle">nuestros clientes</h3>

            <ul class="Page-list Page-list--flex">
              <?php while ($the_query->have_posts()) : ?>
                <?php $the_query->the_post(); ?>
                <?php
                  $values = get_post_custom(get_the_id());
                  $url = isset($values['mb_url']) ? esc_attr($values['mb_url'][0]) : '';
                  $target = isset($values['mb_target']) ? esc_attr($values['mb_target'][0]) : '';
                  $target = (!empty($target) && $target === 'on') ? ' target="_blank" rel="noopener noreferrer"' : '';
                ?>
                <li>
                  <?php if (has_post_thumbnail()) : ?>
                    <?php if (!empty($url)) : ?>
                      <a href="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>"<?php echo $target; ?>>
                        <?php
                          the_post_thumbnail('full', [
                            'class' => 'img-responsive center-block',
                            'alt' => get_the_title()
                          ]);
                        ?>
                      </a>
                    <?php else : ?>
                      <?php
                        the_post_thumbnail('full', [
                          'class' => 'img-responsive center-block',
                          'alt' => get_the_title()
                        ]);
                      ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </li>
              <?php endwhile; ?>
            </ul>
          </article>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (!is_null($parallaxAbout)) : ?>
  <?php
    $arguments = [
      'post_type' => 'parallaxs',
      'p' => (int)$parallaxAbout
    ];

    $parallaxData = new WP_Query($arguments);

    if ($parallaxData->have_posts()) :
      while ($parallaxData->have_posts()) :
        $parallaxData->the_post();

        $val = get_post_custom(get_the_id());
        $title = isset($val['mb_title']) ? esc_attr($val['mb_title'][0]) : '';
        $subtitle = isset($val['mb_subtitle']) ? esc_attr($val['mb_subtitle'][0]) : '';
  ?>
      <section class="Parallax">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('full', ['class' => 'img-responsive center-block']); ?>
          <article class="Parallax-caption animation-element animated" data-animation="fadeInLeft">
            <?php if (!empty($subtitle)) : ?><h3 class="Parallax-subtitle"><?php echo $subtitle; ?></h3><?php endif; ?>
            <?php if (!empty($title)) : ?><h2 class="Parallax-title"><?php echo $title; ?></h2><?php endif; ?>
          </article>
        <?php endif; ?>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>
<?php endif; ?>

<?php
  $args = [
    'post_type' => 'page',
    'post_parent' => (int)$idPage,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => -1
  ];

  $childPages = new WP_Query($args);

  if ($childPages->have_posts()) :
?>
<section class="Page">
  <div class="container">
    <h2 class="Page-title text-center">Lo que hacemos</h2>

    <section class="Page-flex Page-section">
      <?php while ($childPages->have_posts()) : ?>
        <?php $childPages->the_post(); ?>
        <article class="Page-flex-item Page-flex-item--50 Page-flex-item--icon Page-flex-item--icon-casco">
          <h3 class="Page-subtitle"><?php the_title(); ?></h3>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
