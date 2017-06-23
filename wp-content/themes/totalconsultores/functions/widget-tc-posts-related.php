<?php
/***********************************************************************************************/
/* Widget that displays a posts related */
/***********************************************************************************************/

  class Tc_Related_Widget extends WP_Widget {

    public function __construct() {
      parent::__construct(
        'tc_related_w',
        'Custom Widget: Posts Relacionados',
        array('description' => __('Mostrar Posts Relacionados', THEMEDOMAIN))
      );
    }

    public function form($instance) {
      $defaults = array(
        'title' => __('Post Relacionados', THEMEDOMAIN),
      );
      $instance = wp_parse_args((array) $instance, $defaults);
      ?>
      <!-- The Title -->
      <p>
        <label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Título:', THEMEDOMAIN); ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
      </p>
      <?php
    }

    public function update($new_instance, $old_instance) {
      $instance = $old_instance;

      // The Title
      $instance['title'] = strip_tags($new_instance['title']);

      return $instance;
    }

    public function widget($args, $instance) {
      extract($args);

      // Get the title and prepare it for display
      $title = apply_filters('widget_title', $instance['title']);

      echo $before_widget;

      if ($title) {
        echo $before_title . $title . $after_title;
      }
?>
    <?php
      $prevPost = get_previous_post();
      $nextPost = get_next_post();
    ?>
    <?php if (is_object($prevPost)) : ?>
      <article class="Sidebar-related">
        <?php
          $idPost = $prevPost->ID;
          $permalink = get_permalink($idPost);
          $image = wp_get_attachment_image_src(get_post_thumbnail_id($idPost), 'thumbnail');
        ?>
        <?php if ($image) : ?>
          <figure class="Sidebar-related-figure">
            <img src="<?php echo $image[0]; ?>" alt="<?php echo $prevPost->post_title; ?>" class="img-responsive center-block" />
          </figure>
        <?php endif; ?>
        <div class="Sidebar-related-content">
          <h4 class="Sidebar-related-content-title">
            <a href="<?php echo $permalink; ?>"><?php echo $prevPost->post_title; ?></a>
          </h4>
        </div>
      </article>
    <?php endif; ?>

    <?php if (is_object($nextPost)) : ?>
      <article class="Sidebar-related">
        <?php
          $idPost = $nextPost->ID;
          $permalink = get_permalink($idPost);
          $image = wp_get_attachment_image_src(get_post_thumbnail_id($idPost), 'thumbnail');
        ?>
        <?php if ($image) : ?>
          <figure class="Sidebar-related-figure">
            <img src="<?php echo $image[0]; ?>" alt="<?php echo $nextPost->post_title; ?>" class="img-responsive center-block">
          </figure>
        <?php endif; ?>
        <div class="Sidebar-related-content">
          <h4 class="Sidebar-related-content-title">
            <a href="<?php echo $permalink; ?>"><?php echo $nextPost->post_title; ?></a>
          </h4>
        </div>
      </article>
    <?php endif; ?>
<?php

      echo $after_widget;
    }
  }

  register_widget('Tc_Related_Widget');

?>
