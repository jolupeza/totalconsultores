<?php get_header('black'); ?>

<section class="Page Page--intro">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h4 class="Page-legend text-uppercase text-right text-title">Nuestros</h4>
        <h3 class="Page-resalt text-uppercase text-right text-orange">Proyectos</h3>
        <hr class="Page-separator Page-separator--short Page-separator--right Page-separator--orange">
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-6">
        <p>Con mas de 10 años de experiencia, Total Consultores ha estado presente en la planificación, construcción y ejecución de varios proyectos en diferentes campos.</p>
      </div>
    </div>
  </div>
</section>

<section class="Page">
  <div class="container">
    <?php
      $args = [
        'theme_location' => 'project-menu',
        'container' => 'nav',
        'container_class' => 'Page-nav',
        'menu_class' => 'Page-nav-list'
      ];

      wp_nav_menu($args);
    ?>

    <?php if (have_posts()) : ?>
      <section class="Page-flex Page-section Page-flex--blog">
        <?php while (have_posts()) : ?>
          <?php the_post(); ?>
          <article class="Page-flex-item Page-flex-item--50">
            <?php if (has_post_thumbnail()) : ?>
              <figure class="Page-flex--blog-figure">
                <?php the_post_thumbnail('projects-single', ['class' => 'img-responsive center-block']); ?>
                <div class="Page-flex--blog-content">
                  <h3 class="Page-subtitle"><?php the_title(); ?></h3>
                  <p><a href="<?php the_permalink(); ?>" class="Button Button--white Button--normal"><i class="icon-search"></i> ver proyecto</a></p>
                </div>
              </figure>
            <?php endif; ?>
          </article>
        <?php endwhile; ?>
      </section>
    <?php else : ?>
      <div class="alert alert-danger text-center" role="alert">Aún no existen proyectos para esta categoría.</div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
