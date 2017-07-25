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
            <p class="Page-link">
              <a href="#" data-toggle="modal" data-target="#md-video"><i class="icon-play"></i> Ver Video Institucional</a>
            </p>
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

<?php
  $args = [
    'post_type' => 'experts',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
  ];

  $the_query = new WP_Query($args);

  if ($the_query->have_posts()) :
?>
<section class="Page">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h4 class="Page-legend text-uppercase text-right text-title">Nuestros</h4>
        <h3 class="Page-resalt text-uppercase text-right text-orange">Expertos</h3>
        <hr class="Page-separator Page-separator--short Page-separator--right Page-separator--orange">
      </div>
      <div class="col-md-8">
        <ul class="bxslider Bxslider-list">
          <?php while ($the_query->have_posts()) : ?>
            <?php $the_query->the_post(); ?>
            <?php if (has_post_thumbnail()) : ?>
              <li>
                <figure class="Bxslider-figure">
                  <?php the_post_thumbnail('full', [
                      'class' => 'img-responsive center-block',
                      'alt' => get_the_title()
                    ]);
                  ?>
                  <aside class="Bxslider-content">
                    <h3 class="Bxslider-title text-center"><?php the_title(); ?></h3>
                    <div class="Bxslider-text"><?php the_content(); ?></div>
                  </aside>
                </figure>
              </li>
            <?php endif; ?>
          <?php endwhile; ?>

          <?php /*
          <li>
            <figure class="Bxslider-figure">
              <img src="<?php echo IMAGES; ?>/experto.jpg" alt="" class="img-responsive center-block">
              <aside class="Bxslider-content">
                <h3 class="Bxslider-title text-center">Marco Barriga C.</h3>
                <p class="Bxslider-text">CEO TotalConsultores</p>
              </aside>
            </figure>
          </li>
          <li>
            <figure class="Bxslider-figure">
              <img src="<?php echo IMAGES; ?>/experto.jpg" alt="" class="img-responsive center-block">
              <aside class="Bxslider-content">
                <h3 class="Bxslider-title text-center">Marco Barriga C.</h3>
                <p class="Bxslider-text">CEO TotalConsultores</p>
              </aside>
            </figure>
          </li>
          <li>
            <figure class="Bxslider-figure">
              <img src="<?php echo IMAGES; ?>/experto.jpg" alt="" class="img-responsive center-block">
              <aside class="Bxslider-content">
                <h3 class="Bxslider-title text-center">Marco Barriga C.</h3>
                <p class="Bxslider-text">CEO TotalConsultores</p>
              </aside>
            </figure>
          </li>
          */ ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<!-- Modal Video -->
<?php
  $options = get_option('tc_custom_settings');

  $webm = isset($options['video_webm']) ? $options['video_webm'] : '';
  $mp4 = isset($options['video_mp4']) ? $options['video_mp4'] : '';
  $ogv = isset($options['video_ogv']) ? $options['video_ogv'] : '';
?>
<?php if (!empty($webm) || !empty($mp4) || !empty($ogv)) : ?>
  <div class="modal fade Modal Modal--video Modal--orange" id="md-video" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <figure class="Page-video text-center">
            <video controls poster="<?php echo IMAGES; ?>/video-about.jpg" >
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
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
