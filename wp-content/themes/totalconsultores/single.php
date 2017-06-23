<?php get_header('black'); ?>

<?php if (have_posts()) : ?>
  <section class="Page Page-single">
    <div class="container">
      <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <div class="row">
          <div class="col-md-12">
            <h2 class="Page-single-title text-title"><?php the_title(); ?></h2>
            <h4 class="Page-single-category text-orange"><?php the_date('j F Y'); ?></h4>

            <?php if (has_post_thumbnail()) : ?>
              <figure class="Page-single-figure">
                <?php the_post_thumbnail('full', [
                    'class' => 'img-responsive center-block',
                    'alt' => get_the_title()
                  ]);
                ?>
              </figure>
            <?php endif; ?>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <?php the_content(); ?>
            <hr class="Hr">

            <?php /*
            <nav class="Single-tags">
              <h3 class="Single-tags-title">Etiquetas: </h3>
              <ul class="Single-tags-list">
                <li><a href="">#innovación</a></li>
                <li><a href="">#diseño</a></li>
                <li><a href="">#arquitectura</a></li>
              </ul>
            </nav>
            */ ?>
          </div>
      <?php endwhile; ?>
          <div class="col-md-4">
            <aside class="Sidebar">

              <?php get_sidebar(); ?>

            </aside>
          </div>
        </div>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>
