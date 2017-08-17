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

      <?php
        global $wp_query;
        $total = $wp_query->max_num_pages;
      ?>

      <?php if ($total > 1) : ?>
        <nav class="Pagination text-center">
          <?php
            $current_page = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
            $format = ( get_option('permalink_structure' ) == '/%postname%/') ? 'page/%#%/' : '&paged=%#%';

            echo paginate_links(array(
              'base'      =>    get_pagenum_link(1) . '%_%',
              'format'    =>    $format,
              'current'   =>    $current_page,
              'prev_next' =>    True,
              'prev_text' =>    __('&larr;', THEMEDOMAIN),
              'next_text' =>    __('&rarr;', THEMEDOMAIN),
              'total'     =>    $total,
              'mid_size'  =>    4,
              'type'      =>    'list'
            ));
          ?>
        </nav>
      <?php endif; ?>
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
