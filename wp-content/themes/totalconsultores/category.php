<?php get_header('black'); ?>

<section class="Page">
  <div class="container">
    <?php if (have_posts()) : ?>
      <section class="Page-section Blog">
        <?php while (have_posts()) : ?>
          <?php the_post(); ?>
          <article class="Blog-item">
            <?php if (has_post_thumbnail()) : ?>
              <figure class="Blog-item-figure">
                <?php the_post_thumbnail('projects-single', [
                    'class' => 'img-responsive center-block',
                    'alt' => get_the_title()
                  ]);
                ?>
                <div class="Blog-item-content">
                  <h3 class="Blog-title"><?php the_title(); ?></h3>
                  <?php the_content(' '); ?>
                  <div>
                    <a href="<?php the_permalink(); ?>" class="Button Button--transparent Button--normal Button--small">Leer más</a>
                  </div>
                </div>
              </figure>
            <?php endif; ?>
          </article>
        <?php endwhile; ?>
      </section>
    <?php else : ?>
      <section class="Page-section">
        <div class="alert alert-info" role="alert">
          <p class="text-center">Aún no hay noticias</p>
        </div>
      </section>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
