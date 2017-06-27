<?php get_header('black'); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : ?>
    <?php the_post(); ?>
    <section class="Page Page-single">
      <div class="container">
        <h2 class="Page-single-title text-title"><?php the_title(); ?></h2>
        <?php
          $types = get_the_terms(get_the_id(), 'types');

          if (count($types) > 0) :
            $i = 0;
            $totalTypes = count($types);
        ?>
          <h4 class="Page-single-category text-orange">Categoría:
            <?php foreach ($types as $type) : ?>
              <?php $i++; ?>
              <a class="text-orange" href="<?php echo get_term_link($type); ?>"><?php echo $type->name; ?></a>
              <?php if ($i < $totalTypes) : ?>, <?php endif; ?>
            <?php endforeach; ?>
          </h4>
        <?php endif; ?>
      </div>

      <?php
        $values = get_post_custom(get_the_id());
        $gallery = isset($values['mb_gallery']) ? $values['mb_gallery'][0] : '';
        $i = 0; $j = 0;

        if (!empty($gallery)) :
          $gallery = unserialize($gallery);
          $thumb = false;
          $galleryIds = array();

          if (count($gallery)) :
      ?>
          <section id="carousel-project" class="carousel slide Carousel Carousel--project Page-single-figure" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <?php if (has_post_thumbnail()) : ?>
                <?php $thumb = true; ?>
                <div class="item active">
                  <?php
                    $responsive = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'projects-single-responsive');
                  ?>
                  <picture>
                    <source class="img-responsive center-block" media="(max-width: 767px) and (orientation: portrait)" srcset="<?php echo $responsive[0]; ?>" alt="<?php echo get_the_title(); ?>" />

                    <?php the_post_thumbnail('full', [
                        'class' => 'img-responsive center-block',
                        'alt' => get_the_title()
                      ]);
                    ?>
                  </picture>
                </div>
              <?php endif; ?>

              <?php foreach ($gallery as $image) : ?>
                <?php
                  global $wpdb;
                  $idImage = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE guid = '$image' AND post_type = 'attachment'");
                  $galleryIds[] = $idImage[0];
                ?>
              <?php endforeach; ?>

              <?php foreach ($galleryIds as $idImage) : ?>
                <?php
                  $image = wp_get_attachment_image_src((int)$idImage, 'full');
                  $responsive = wp_get_attachment_image_src((int) $idImage, 'projects-single-responsive')[0];

                  $active = ($i === 0) && !$thumb ? ' active' : '';
                ?>
                <div class="item<?php echo $active; ?>">
                  <picture>
                    <source class="img-responsive center-block" media="(max-width: 767px) and (orientation: portrait)" srcset="<?php echo $responsive; ?>" alt="<?php echo get_the_title(); ?>" />
                    <img class="img-responsive center-block" src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                  </picture>
                </div>
                <?php $i++; ?>
              <?php endforeach; ?>
            </div>

            <ol class="carousel-indicators">
              <?php if (has_post_thumbnail()) : ?>
                <li data-target="#carousel-project" data-slide-to="0" class="active">
                  <?php the_post_thumbnail('thumbnail', ['class' => 'img-responsive img-thumbnail']); ?>
                </li>
              <?php endif; ?>

              <?php foreach ($galleryIds as $idImage) : ?>
                <?php
                  $image = wp_get_attachment_image_src((int)$idImage, 'thumbnail');
                  $active = (!$thumb && $j === 0) ? 'class="active"' : '';
                  $index = ($thumb) ? $j + 1 : $j;
                ?>
                <li data-target="#carousel-project" data-slide-to="<?php echo $index; ?>"<?php echo $active; ?>>
                  <img src="<?php echo $image[0]; ?>" class="img-responsive img-thumbnail">
                </li>
                <?php $j++; ?>
              <?php endforeach; ?>
            </ol>

            <a class="left carousel-control" href="#carousel-project" role="button" data-slide="prev">
              <i class="icon-keyboard_arrow_left"></i>
            </a>
            <a class="right carousel-control" href="#carousel-project" role="button" data-slide="next">
              <i class="icon-keyboard_arrow_right"></i>
            </a>
          </section>
        <?php endif; ?>
      <?php else : ?>
        <?php if (has_post_thumbnail()) : ?>
          <?php
            $responsive = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'projects-single-responsive');
          ?>
          <figure class="Page-single-figure">
            <picture>
              <source class="img-responsive center-block" media="(max-width: 767px) and (orientation: portrait)" srcset="<?php echo $responsive[0]; ?>" alt="<?php echo get_the_title(); ?>" />
              <?php the_post_thumbnail('full', ['class' => 'img-responsive center-block']); ?>
            </picture>
          </figure>
        <?php endif; ?>
      <?php endif; ?>

      <div class="container">
        <?php the_content(); ?>

        <hr class="Hr">

        <?php
          $prevPost = get_previous_post();
          $nextPost = get_next_post();
        ?>

        <nav class="Single-nav">
          <?php if (is_object($prevPost)) : ?>
            <a href="<?php echo get_permalink($prevPost); ?>" class="Single-nav-pre"><i class="icon-arrow-circle-o-left"></i><span><?php echo $prevPost->post_title; ?></span></a>
          <?php else : ?>
            <span>&nbsp;</span>
          <?php endif; ?>

          <?php if (is_object($nextPost)) : ?>
            <a href="<?php echo get_permalink($nextPost); ?>" class="Single-nav-next"><span><?php echo $nextPost->post_title; ?></span><i class="icon-arrow-circle-o-right"></i></a>
          <?php else : ?>
            <span>&nbsp;</span>
          <?php endif; ?>
        </nav>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
