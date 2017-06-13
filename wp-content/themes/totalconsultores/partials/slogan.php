<?php $options = get_option('tc_custom_settings'); ?>

<?php if (isset($options['slogan_subtitle']) && isset($options['slogan_title'])) : ?>
  <section class="Slogan">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <article class="animation-element animated" data-animation="flipInX">
            <?php if (!empty($options['slogan_subtitle'])) : ?>
              <h3 class="Slogan-subtitle"><?php echo $options['slogan_subtitle']; ?></h3>
            <?php endif; ?>

            <?php if (!empty($options['slogan_title'])) : ?>
              <h2 class="Slogan-title"><?php echo $options['slogan_title']; ?></h2>
            <?php endif; ?>
          </article>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
