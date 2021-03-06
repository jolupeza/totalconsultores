<?php
/****************************************/
/* Define Constants */
/****************************************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT . '/images');
define('THEMEDOMAIN', 'total-framework');

/****************************************/
/* Load JS Files */
/****************************************/
function load_custom_scripts() {
  wp_enqueue_script('vendor_script', THEMEROOT . '/js/vendor.min.js', array('jquery'), false, true);
  wp_enqueue_script('main_script', THEMEROOT . '/js/main.js', array('jquery'), false, true);
  wp_localize_script('main_script', 'TCAjax', array('url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('tcajax-nonce')));
}

add_action('wp_enqueue_scripts', 'load_custom_scripts');

/****************************************/
/* Add Theme Support */
/****************************************/
if ( function_exists('add_theme_support') ) {
  add_theme_support('post-thumbnails', array('post', 'page', 'sliders', 'parallaxs', 'customers', 'projects', 'experts'));

  add_image_size('projects-single', 585, 311, [
    'x_crop_position' => 'center',
    'y_crop_position' => 'center'
  ]);

  add_image_size('projects-single-responsive', 768, 600, [
    'x_crop_position' => 'center',
    'y_crop_position' => 'center'
  ]);
}

/****************************************/
/* Add Logo Theme */
/****************************************/
function my_theme_setup() {
  add_theme_support('custom-logo', [
    'height'  => 62,
    'width' => 259,
    'flex-height' => true
  ]);
}

add_action('after_setup_theme', 'my_theme_setup');

/****************************************/
/* Add Menus */
/****************************************/
function register_my_menus() {
  register_nav_menus([
    'main-menu' => __('Main Menu', THEMEDOMAIN),
    'project-menu' => __('Project Menu', THEMEDOMAIN)
  ]);
}

add_action('init', 'register_my_menus');

/****************************************/
/* Menu Walker Project Menu */
/****************************************/
class Total_Walker_Nav_Menu_Hashtag extends Walker_Nav_Menu
{
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    /*public function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }*/

    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
    * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'#content"' : '';

        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/****************************************/
/* Add Sidebar Support */
/****************************************/
if (function_exists('register_sidebar')) {
  register_sidebar([
    'name'          => __('Main Sidebar', THEMEDOMAIN),
    'id'            => 'main-sidebar',
    'description'   => __('Área Sidebar Principal', THEMEDOMAIN),
    'class'         => '',
    'before_widget' => '<div class="Sidebar-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="Sidebar-title">',
    'after_title'   => '</h3>'
    ]
  );
}

/****************************************/
/* Add Excerpt to Page */
/****************************************/
function total_add_excerpts_to_pages() {
  add_post_type_support('page', 'excerpt');
}

add_action('init', 'total_add_excerpts_to_pages');

/****************************************/
/* Setting Mailtrap */
/****************************************/
function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = 'e6e50f29dbe2dd';
  $phpmailer->Password = 'f1ea173da928d9';
}

//add_action('phpmailer_init', 'mailtrap');

// Bugs send emails WP 4.6.1
add_filter('wp_mail_from', function() {
  return 'noreply@totalconsultoresperu.com';
});

/***********************************************************/
/* Register subscriptor via ajax */
/***********************************************************/
add_action('wp_ajax_register_contact', 'register_contact_callback');
add_action('wp_ajax_nopriv_register_contact', 'register_contact_callback');

function register_contact_callback()
{
  $nonce = $_POST['nonce'];
  $result = array(
    'result' => false,
    'error' => ''
  );

  if (!wp_verify_nonce($nonce, 'tcajax-nonce')) {
      die('¡Acceso denegado!');
  }

  $name = trim($_POST['contact_name']);
  $email = trim($_POST['contact_email']);
  $message = trim($_POST['contact_message']);

  if (!empty($name) && !empty($email) && is_email($email) && !empty($message)) {
    $options = get_option('tc_custom_settings');

    $name = sanitize_text_field($name);
    $email = sanitize_email($email);
    $message = sanitize_text_field($message);

    $receiverEmail = $options['email'];

    if (!isset($receiverEmail) || empty($receiverEmail)) {
      $receiverEmail = get_option('admin_email');
    }

    $subjectEmail = "Consulta Web Total Consultores S.A.C.";

    ob_start();
    $filename = TEMPLATEPATH . '/templates/email-contact.php';
    if (file_exists($filename)) {
      include $filename;

      $content = ob_get_contents();
      ob_get_clean();

      $headers[] = 'From: Total Consultores S.A.C.';
      //$headers[] = 'Reply-To: jolupeza@icloud.com';
      $headers[] = 'Content-type: text/html; charset=utf-8';

      if (wp_mail($receiverEmail, $subjectEmail, $content, $headers)) {
        // Send email to customer
        $subjectEmail = "Consulta enviada a Total Consultores S.A.C.";

        ob_start();
        $filename = TEMPLATEPATH . '/templates/email-gratitude.php';
        if (file_exists($filename)) {
          $textEmail = 'Ya tenemos su consulta. En breve nos pondremos en contacto con usted.';

          include $filename;

          $content = ob_get_contents();
          ob_get_clean();

          $headers[] = 'From: Total Consultores S.A.C.';
          //$headers[] = 'Reply-To: jolupeza@icloud.com';
          $headers[] = 'Content-type: text/html; charset=utf-8';

          wp_mail($email, $subjectEmail, $content, $headers);

          $post_id = wp_insert_post(array(
              'post_author' => 1,
              'post_status' => 'publish',
              'post_type' => 'contacts',
          ));
          update_post_meta($post_id, 'mb_name', $name);
          update_post_meta($post_id, 'mb_email', $email);
          update_post_meta($post_id, 'mb_message', $message);

          $result['result'] = true;
        } else {
          $result['error'] = 'Plantilla email no encontrada.';
          ob_get_clean();
        }
      } else {
        $result['error'] = 'No se puedo enviar el email.';
      }
    } else {
      $result['error'] = 'Plantilla email no encontrada.';
      ob_get_clean();
    }
  } else {
    $result['error'] = 'Verifique que ha ingresado los datos correctamente.';
  }

  echo json_encode($result);
  die();
}

/**********************************************/
/* Load Theme Options Page and Custom Widgets */
/**********************************************/
require_once(TEMPLATEPATH . '/functions/tc-theme-customizer.php');
require_once(TEMPLATEPATH . '/functions/widget-tc-posts-related.php');

/*
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
  function dump($var, $label = 'Dump', $echo = true) {
    // Store dump in variable
    ob_start();
    var_dump($var);
    $output = ob_get_clean();

    // Add formatting
    $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
    $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">'.$label.' => '.$output.'</pre>';

    // Output
    if ($echo == true) {
      echo $output;
    } else {
      return $output;
    }
  }
}

if (!function_exists('dump_exit')) {
  function dump_exit($var, $label = 'Dump', $echo = true) {
    dump($var, $label, $echo);
    exit;
  }
}

/***************************************************/
function login_errors_message() {
  return 'Ooooops!';
}
add_filter('login_errors', 'login_errors_message');

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

add_filter('pre_comment_content', 'wp_specialchars');
/***************************************************/
