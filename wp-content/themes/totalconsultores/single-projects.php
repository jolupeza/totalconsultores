<?php get_header('black'); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : ?>
    <?php the_post(); ?>
    <section class="Page Page-single">
      <div class="container">
        <h2 class="Page-single-title text-title"><?php the_title(); ?></h2>
        <?php
          $types = get_terms([
            'taxonomy' => 'types'
          ]);

          if (count($types) > 0) :
        ?>
          <h4 class="Page-single-category text-orange">Categoría: <?php echo $types[0]->name; ?></h4>
        <?php endif; ?>
      </div>

      <?php if (has_post_thumbnail()) : ?>
        <figure class="Page-single-figure">
          <?php the_post_thumbnail('full', ['class' => 'img-responsive center-block']); ?>
        </figure>
      <?php endif; ?>

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php the_content(); ?>

            <hr class="Hr">
          </div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
