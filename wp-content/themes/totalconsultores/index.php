<?php get_header(); ?>


<?php
  if (file_exists(TEMPLATEPATH . '/partials/sliders.php')) {
    include TEMPLATEPATH . '/partials/sliders.php';
  }

  if (file_exists(TEMPLATEPATH . '/partials/services.php')) {
    include TEMPLATEPATH .'/partials/services.php';
  }

  if (file_exists(TEMPLATEPATH . '/partials/about.php')) {
    include TEMPLATEPATH . '/partials/about.php';
  }

  if (file_exists(TEMPLATEPATH . '/partials/blog.php')) {
    include TEMPLATEPATH . '/partials/blog.php';
  }

  if (file_exists(TEMPLATEPATH . '/partials/slogan.php')) {
    include TEMPLATEPATH . '/partials/slogan.php';
  }
?>

<?php get_footer(); ?>
