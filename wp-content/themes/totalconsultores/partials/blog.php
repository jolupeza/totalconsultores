<?php
  $args = [
    'post_type' => 'post',
    'posts_per_page' => 3
  ];

  $postsQuery = new WP_Query($args);

  if ($postsQuery->have_posts()) :
?>
<section class="Page">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="Page-title">Lo último.</h2>
      </div>
    </div>

    <section class="Page-blog">
      <?php while ($postsQuery->have_posts()) : ?>
        <?php $postsQuery->the_post(); ?>
        <article class="Page-blog-item">
          <?php if (has_post_thumbnail()) : ?>
            <figure class="Page-blog-figure">
              <?php the_post_thumbnail('projects-single', [
                  'class' => 'img-responsive center-block',
                  'alt' => get_the_title()
                ]);
              ?>
            </figure>
          <?php endif; ?>
          <h4 class="Page-blog-date">/ <?php echo get_the_date('d.m.Y'); ?></h4>
          <h2 class="Page-blog-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <?php the_content(' '); ?>
          <p>
            <a href="<?php the_permalink(); ?>" class="Page-blog-readmore">&rsaquo; Leer más</a>
          </p>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
