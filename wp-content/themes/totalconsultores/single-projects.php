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
