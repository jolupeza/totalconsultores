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
  // Links Social Media
  $wp_customize->add_section('tc_social', [
    'title' => __('Links Redes Sociales', THEMEDOMAIN),
    'description' => __('Mostrar links a redes sociales', THEMEDOMAIN),
    'priority' => 35
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
    'priority' => 36
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
}
