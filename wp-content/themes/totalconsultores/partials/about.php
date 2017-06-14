<?php
  $aboutPage = get_page_by_title('Conócenos');
  $parallaxAbout = null;

  $args = [
    'post_type' => 'page',
    'p' => $aboutPage->ID
  ];

  $aboutQuery = new WP_Query($args);

  if ($aboutQuery->have_posts()) :
    while ($aboutQuery->have_posts()) :
      $aboutQuery->the_post();

      $values = get_post_custom(get_the_id());
      $parallaxAbout = isset($values['mb_parallax']) ? esc_attr($values['mb_parallax'][0]) : $parallaxAbout;
?>
  <section class="Page" id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h2 class="Page-title"><?php the_title(); ?></h2>
          <h3 class="Page-subtitle">Presentación</h3>
          <?php the_content(); ?>
          <p class="text-uppercase">
            <a class="Button Button--orange" href="<?php the_permalink(); ?>">Saber más</a>
          </p>
        </div>
        <div class="col-md-7">
          <figure class="Page-video">
            <img src="<?php echo IMAGES; ?>/video-about.jpg" class="img-responsive center-block" />
          </figure>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

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
  <?php wp_reset_postdata(); ?>
<?php endif; ?>
