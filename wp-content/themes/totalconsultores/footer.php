    <?php $options = get_option('tc_custom_settings'); ?>

    <section class="Contact">
      <article class="Contact-map">
        <figure class="Contact-map-figure">
          <img src="images/map.jpg" class="img-responsive" />
        </figure>
      </article>
      <article class="Contact-form">
        <h2 class="Page-title Page-title--white">Contáctanos</h2>

        <form class="Form">
          <div class="form-group">
            <label for="contact_name" class="sr-only">Nombre</label>
            <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="contact_email" class="sr-only">Correo</label>
            <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="Correo">
          </div>
          <div class="form-group">
            <label for="contact_message" class="sr-only">Mensaje</label>
            <textarea class="form-control" name="contact_message" id="contact_message" placeholder="Mensaje" rows="3"></textarea>
          </div>
          <p class="text-center">
            <button type="submit" class="Button Button--orange text-uppercase">enviar</button>
          </p>
        </form>
      </article>
    </section>

    <footer class="Footer">
      <div class="container">
        <?php
          $customLogoId = get_theme_mod('custom_logo');
          $logo = wp_get_attachment_image_src($customLogoId, 'full');
        ?>
        <div class="row">
          <div class="col-md-3">
            <h1 class="Footer-logo">
              <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                <img src="<?php echo $logo[0]; ?>" alt="<?php bloginfo('name') ?>|<?php bloginfo('description'); ?>" class="img-responsive" />
              </a>
            </h1>
          </div>
          <div class="col-md-9"></div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <p class="Footer-text"><?php bloginfo('description'); ?></p>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php if (!empty($options['phone'])) : ?>
              <p class="Footer-text text-right"><?php echo $options['phone']; ?></p>
            <?php endif; ?>
            <?php if (!empty($options['email'])) : ?>
              <p class="Footer-text text-right"><?php echo $options['email']; ?></p>
            <?php endif; ?>
          </div>
        </div>

        <hr class="Footer-separator">

        <div class="row">
          <div class="col-md-6">
            <p class="Footer-text">&copy; <?php echo date('Y'); ?> Derechos Reservados</p>
          </div>
          <div class="col-md-6">
            <?php if ($options['display_social_link'] && !is_null($options['display_social_link'])) : ?>
              <ul class="text-right list-inline Footer-social">
                <?php if (!empty($options['facebook'])) : ?>
                  <li class="Footer-social-item">
                    <a href="https://www.facebook.com/<?php echo $options['facebook']; ?>" title="Ir a Facebook" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  </li>
                <?php endif; ?>
                <?php if (!empty($options['twitter'])) : ?>
                  <li class="Footer-social-item">
                    <a href="https://twitter.com/<?php echo $options['twitter']; ?>" title="Ir a Twitter" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  </li>
                <?php endif; ?>
                <?php if (!empty($options['instagram'])) : ?>
                  <li class="Footer-social-item">
                    <a href="https://www.instagram.com/<?php echo $options['instagram']; ?>" title="Ir a Instagram" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                  </li>
                <?php endif; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </footer>

    <script>
      _root_ = '<?php echo home_url(); ?>';
    </script>

    <?php wp_footer(); ?>
  </body>
</html>
