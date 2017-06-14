<?php
/***********************************************************************************************/
/* Add a menu option to link to the customizer */
/***********************************************************************************************/
add_action('admin_menu', 'display_custom_options_link');

function display_custom_options_link() {
    add_theme_page('Theme TC Options', 'Theme TC Options', 'edit_theme_options', 'customize.php');
}

/***********************************************************************************************/
/* Add a menu option to link to the customizer */
/***********************************************************************************************/
add_action('customize_register', 'tc_customize_register');

function tc_customize_register($wp_customize) {
  // Logo
  $wp_customize->add_section('tc_logo', array(
    'title' => __('Logo', THEMEDOMAIN),
    'description' => __('Le permite cargar un logo personalizado.', THEMEDOMAIN),
    'priority' => 35
  ));

  $wp_customize->add_setting('tc_custom_settings[logo_black]', array(
    'default' => IMAGES . '/logo-black.png',
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_black', array(
    'label' => __('Logo Cabecera Blanca', THEMEDOMAIN),
    'section' => 'tc_logo',
    'settings' => 'tc_custom_settings[logo_black]'
  )));

  $wp_customize->add_setting('tc_custom_settings[logo_scroll]', array(
    'default' => IMAGES . '/logo-min.png',
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_scroll', array(
    'label' => __('Logo al hacer scroll', THEMEDOMAIN),
    'section' => 'tc_logo',
    'settings' => 'tc_custom_settings[logo_scroll]'
  )));

  // Links Social Media
  $wp_customize->add_section('tc_social', [
    'title' => __('Links Redes Sociales', THEMEDOMAIN),
    'description' => __('Mostrar links a redes sociales', THEMEDOMAIN),
    'priority' => 36
  ]);

  $wp_customize->add_setting('tc_custom_settings[display_social_link]', [
    'default' => 0,
    'type' => 'option'
  ]);

  $wp_customize->add_control('tc_custom_settings[display_social_link]', [
    'label' => __('¿Mostrar links?', THEMEDOMAIN),
    'section' => 'tc_social',
    'settings' => 'tc_custom_settings[display_social_link]',
    'type' => 'checkbox'
  ]);

  // Facebook
  $wp_customize->add_setting('tc_custom_settings[facebook]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('tc_custom_settings[facebook]', [
    'label' => __('Facebook', THEMEDOMAIN),
    'section' => 'tc_social',
    'settings' => 'tc_custom_settings[facebook]',
    'type' => 'text'
  ]);

  // Twitter
  $wp_customize->add_setting('tc_custom_settings[twitter]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('tc_custom_settings[twitter]', [
    'label' => __('Twitter', THEMEDOMAIN),
    'section' => 'tc_social',
    'settings' => 'tc_custom_settings[twitter]',
    'type' => 'text'
  ]);

  // Instagram
  $wp_customize->add_setting('tc_custom_settings[instagram]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('tc_custom_settings[instagram]', [
    'label' => __('Instagram', THEMEDOMAIN),
    'section' => 'tc_social',
    'settings' => 'tc_custom_settings[instagram]',
    'type' => 'text'
  ]);

  // Information
  $wp_customize->add_section('tc_info', [
    'title' => __('Datos de la empresa', THEMEDOMAIN),
    'description' => __('Configurar información sobre la empresa', THEMEDOMAIN),
    'priority' => 37
  ]);

  // Phone
  $wp_customize->add_setting('tc_custom_settings[phone]', array(
    'default' => '',
    'type'    => 'option'
  ));

  $wp_customize->add_control('tc_custom_settings[phone]', array(
    'label'    => __('Teléfonos', THEMEDOMAIN),
    'section'  => 'tc_info',
    'settings' => 'tc_custom_settings[phone]',
    'type'     => 'text'
  ));

  // Email
  $wp_customize->add_setting('tc_custom_settings[email]', array(
    'default' => '',
    'type'    => 'option'
  ));

  $wp_customize->add_control('tc_custom_settings[email]', array(
    'label'    => __('Correo electrónico', THEMEDOMAIN),
    'section'  => 'tc_info',
    'settings' => 'tc_custom_settings[email]',
    'type'     => 'text'
  ));

  // Address
  $wp_customize->add_setting('tc_custom_settings[address]', array(
    'default' => '',
    'type'    => 'option'
  ));

  $wp_customize->add_control('tc_custom_settings[address]', array(
    'label'    => __('Dirección', THEMEDOMAIN),
    'section'  => 'tc_info',
    'settings' => 'tc_custom_settings[address]',
    'type'     => 'text'
  ));

  // Latitud
  $wp_customize->add_setting('tc_custom_settings[latitud]', array(
    'default' => '',
    'type'    => 'option'
  ));

  $wp_customize->add_control('tc_custom_settings[latitud]', array(
    'label'    => __('Ubicación Google Map Latitud', THEMEDOMAIN),
    'section'  => 'tc_info',
    'settings' => 'tc_custom_settings[latitud]',
    'type'     => 'text'
  ));

  // Longitud
  $wp_customize->add_setting('tc_custom_settings[longitud]', array(
    'default' => '',
    'type'    => 'option'
  ));

  $wp_customize->add_control('tc_custom_settings[longitud]', array(
    'label'    => __('Ubicación Google Map Longitud', THEMEDOMAIN),
    'section'  => 'tc_info',
    'settings' => 'tc_custom_settings[longitud]',
    'type'     => 'text'
  ));

  // Slogan
  $wp_customize->add_section('tc_slogan', [
    'title' => __('Frase o Slogan', THEMEDOMAIN),
    'description' => __('Configurar frase o slogan de la empresa', THEMEDOMAIN),
    'priority' => 38
  ]);

  // Slogan Subtitle
  $wp_customize->add_setting('tc_custom_settings[slogan_subtitle]', array(
    'default' => '',
    'type'    => 'option'
  ));

  $wp_customize->add_control('tc_custom_settings[slogan_subtitle]', array(
    'label'    => __('Texto Superior', THEMEDOMAIN),
    'section'  => 'tc_slogan',
    'settings' => 'tc_custom_settings[slogan_subtitle]',
    'type'     => 'text'
  ));

  // Slogan Title
  $wp_customize->add_setting('tc_custom_settings[slogan_title]', array(
    'default' => '',
    'type'    => 'option'
  ));

  $wp_customize->add_control('tc_custom_settings[slogan_title]', array(
    'label'    => __('Texto Principal', THEMEDOMAIN),
    'section'  => 'tc_slogan',
    'settings' => 'tc_custom_settings[slogan_title]',
    'type'     => 'text'
  ));
}
