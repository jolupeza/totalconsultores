<?php get_header('black'); ?>

<?php if (have_posts()) : ?>
  <section class="Page Page--default">
    <div class="container">
      <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <div class="row">
          <div class="col-md-12">
            <h2 class="Page-title text-center"><?php the_title(); ?></h2>

            <?php if (has_post_thumbnail()) : ?>
              <figure class="Page-single-figure">
                <?php the_post_thumbnail('full', [
                    'class' => 'img-responsive center-block',
                    'alt' => get_the_title()
                  ]);
                ?>
              </figure>
            <?php endif; ?>

            <?php the_content(); ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>
