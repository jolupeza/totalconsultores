<?php
  $options = get_option('tc_custom_settings');

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
          <?php
            $webm = isset($options['video_webm']) ? $options['video_webm'] : '';
            $mp4 = isset($options['video_mp4']) ? $options['video_mp4'] : '';
            $ogv = isset($options['video_ogv']) ? $options['video_ogv'] : '';
          ?>
          <?php if (!empty($webm) || !empty($mp4) || !empty($ogv)) : ?>
            <figure class="Page-video text-center">
              <video width="640" controls poster="<?php echo IMAGES; ?>/video-about.jpg" >
                <?php if (!empty($webm)) : ?>
                  <source
                    src="<?php echo $webm; ?>"
                    type="video/webm">
                <?php endif; ?>

                <?php if (!empty($mp4)) : ?>
                  <source
                    src="<?php echo $mp4; ?>"
                    type="video/mp4">
                <?php endif; ?>

                <?php if (!empty($ogv)) : ?>
                  <source
                    src="<?php echo $ogv; ?>"
                    type="video/ogg">
                <?php endif; ?>
                Su navegador no admite etiquetas de video HTML5.
              </video>
            </figure>
          <?php endif; ?>
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
        $backgroundUrl = wp_get_attachment_url(get_post_thumbnail_id(get_the_id()));
  ?>
      <section class="Parallax" style="background-image: url('<?php echo $backgroundUrl; ?>');">
        <article class="Parallax-caption animation-element animated" data-animation="fadeInLeft">
          <?php if (!empty($subtitle)) : ?><h3 class="Parallax-subtitle"><?php echo $subtitle; ?></h3><?php endif; ?>
          <?php if (!empty($title)) : ?><h2 class="Parallax-title"><?php echo $title; ?></h2><?php endif; ?>
        </article>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>
