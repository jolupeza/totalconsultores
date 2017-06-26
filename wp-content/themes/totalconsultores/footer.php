    <?php $options = get_option('tc_custom_settings'); ?>
    <?php
      $lat = isset($options['latitud']) ? $options['latitud'] : '';
      $long = isset($options['longitud']) ? $options['longitud'] : '';
    ?>

    <section class="Contact">
      <article class="Contact-map">
        <?php if (!empty($lat) && !empty($long)) : ?>
          <figure class="Contact-map-figure" id="map" data-lat="<?php echo $lat; ?>" data-long="<?php echo $long; ?>"></figure>
        <?php endif; ?>
      </article>
      <article class="Contact-form">
        <h2 class="Page-title Page-title--white">Contáctanos</h2>

        <p class="text-white text-center" id="js-form-contact-msg"></p>

        <form class="Form" action="" method="POST" id="js-frm-contact">
          <div class="form-group">
            <label for="contact_name" class="sr-only">Nombre</label>
            <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Nombre" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="contact_email" class="sr-only">Correo</label>
            <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="Correo" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="contact_message" class="sr-only">Mensaje</label>
            <textarea class="form-control" name="contact_message" id="contact_message" placeholder="Mensaje" rows="3" required></textarea>
          </div>

          <p class="text-center">
            <button type="submit" class="Button Button--orange text-uppercase">enviar <span class="Form-loader rotateIn hidden" id="js-form-contact-loader"><i class="fa fa-refresh"></i></span></button>
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
          <div class="col-md-4 col-sm-8">
            <p class="Footer-text"><?php bloginfo('description'); ?></p>
          </div>
          <div class="col-md-4 hidden-sm hidden-xs"></div>
          <div class="col-md-4 col-sm-4">
            <article class="Footer-info">
              <?php if (!empty($options['phone'])) : ?>
                <p class="Footer-text text-right"><?php echo $options['phone']; ?></p>
              <?php endif; ?>
              <?php if (!empty($options['email'])) : ?>
                <p class="Footer-text text-right"><?php echo $options['email']; ?></p>
              <?php endif; ?>
            </article>
          </div>
        </div>

        <hr class="Footer-separator">

        <div class="row">
          <div class="col-sm-6">
            <p class="Footer-text">&copy; <?php echo date('Y'); ?> Derechos Reservados</p>
          </div>
          <div class="col-sm-6">
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

    <button class="ArrowTop text-hide" title="Ir arriba"><i class="glyphicon glyphicon-chevron-up"></i></button>

    <script>
      _root_ = '<?php echo home_url(); ?>';
    </script>

    <script>
      var map, marker, infowindow;
    </script>
    <?php wp_footer(); ?>

    <?php
      if (!empty($lat) && !empty($long)) :
    ?>
      <script>
        var lat = <?php echo $lat; ?>,
            lon = <?php echo $long; ?>;
        var contentString = '<div id="content" class="Marker">'+
              '<div id="siteNotice">'+
              '</div>'+
              '<h1 id="firstHeading" class="firstHeading Marker-title text-center">Total Consultores S.A.C.</h1>'+
              '<div id="bodyContent" class="Marker-body">'+
              '<ul class="Marker-list">'+
              '<li><strong>Dirección: </strong><?php echo $options['address'] ?></li>'+
              '<li><strong>Teléfono: </strong><?php echo $options['phone'] ?></li>'+
              '<li><strong>Correo: </strong><?php echo $options['email'] ?></li>'+
              '</ul>'+
              '</div>'+
              '</div>';

        function initMap() {
          var mapCoord = new google.maps.LatLng(lat, lon);
          var opciones = {
            zoom: 16,
            center: mapCoord,
            scrollwheel: false,
          };

          infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 300
          });

          map = new google.maps.Map(document.getElementById('map'), opciones);

          marker = new google.maps.Marker({
            position: mapCoord,
            map: map,
            title: 'Total Consultores S.A.C.'
          });

          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });

          // mapFooter = new google.maps.Map(document.getElementById('mapFooter'), opcionesMapFooter);

          // markerFooter = new google.maps.Marker({
          //   position: mapCoord,
          //   map: mapFooter,
          //   title: 'Cepuch'
          // });

          // markerFooter.addListener('click', function() {
          //   infowindow.open(mapFooter, markerFooter);
          // });
        }
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDz89lMNjhrpWjPg24sYNSmvv3bpTJGEx0&callback=initMap" async defer></script>
    <?php endif; ?>
  </body>
</html>
