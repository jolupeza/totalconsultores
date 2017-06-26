<?php

/**
 * The TC Manager Admin defines all functionality for the dashboard
 * of the plugin.
 */

/**
 * The TC Manager Admin defines all functionality for the dashboard
 * of the plugin.
 *
 * This class defines the meta box used to display the post meta data and registers
 * the style sheet responsible for styling the content of the meta box.
 *
 * @since    1.0.0
 */
class Tc_Manager_Admin
{
    /**
     * A reference to the version of the plugin that is passed to this class from the caller.
     *
     * @var string The current version of the plugin.
     */
    private $version;

    /**
     * Labels indicate allowed in custom fields.
     *
     * @var array
     */
    private $allowed;

    private $domain;

    /**
     * Initializes this class and stores the current version of this plugin.
     *
     * @param string $version The current version of this plugin.
     */
    public function __construct($version)
    {
        $this->version = $version;
        $this->allowed = array(
            'h2' => array(
              'style' => array(),
            ),
            'h4' => array(
              'style' => array(),
            ),
            'h5' => array(
              'style' => array(),
            ),
            'p' => array(
              'style' => array(),
            ),
            'a' => array(// on allow a tags
                'href' => array(),
                'target' => array(),
            ),
            'ul' => array(
                'class' => array(),
            ),
            'ol' => array(),
            'li' => array(
                'style' => array(),
            ),
            'strong' => array(),
            'br' => array(),
            'span' => array(),
        );

        $this->domain = 'tc-framework';
//        add_action('wp_ajax_generate_pdf', array(&$this, 'generate_pdf'));
//        add_action('wp_ajax_download_cv', array(&$this, 'download_cv'));
    }

    /**
     * Enqueues the style sheet responsible for styling the contents of this
     * meta box.
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            'tc-manager-admin',
            plugin_dir_url(__FILE__).'css/tc-manager-admin.css',
            array(),
            $this->version,
            false
        );
    }

    /**
     * Enqueues the scripts responsible for functionality.
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'tc-manager-admin',
            plugin_dir_url(__FILE__).'js/tc-manager-admin.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with post type sliders.
     */
    public function cd_mb_sliders_add()
    {
        add_meta_box(
            'mb-sliders-id', 'Configuraciones', array($this, 'render_mb_sliders'), 'sliders', 'normal', 'core'
        );
    }

    public function cd_mb_sliders_save($post_id)
    {
        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'sliders_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Title
        if (isset($_POST['mb_title']) && !empty($_POST['mb_title'])) {
            update_post_meta($post_id, 'mb_title', esc_attr($_POST['mb_title']));
        } else {
            delete_post_meta($post_id, 'mb_title');
        }
        
        // SubTitle
        if (isset($_POST['mb_subtitle']) && !empty($_POST['mb_subtitle'])) {
            update_post_meta($post_id, 'mb_subtitle', esc_attr($_POST['mb_subtitle']));
        } else {
            delete_post_meta($post_id, 'mb_subtitle');
        }

        // Text Link
        if (isset($_POST['mb_text']) && !empty($_POST['mb_text'])) {
            update_post_meta($post_id, 'mb_text', esc_attr($_POST['mb_text']));
        } else {
            delete_post_meta($post_id, 'mb_text');
        }

        // URL
        if (isset($_POST['mb_url']) && !empty($_POST['mb_url'])) {
            update_post_meta($post_id, 'mb_url', esc_attr($_POST['mb_url']));
        } else {
            delete_post_meta($post_id, 'mb_url');
        }

        // Target
        $target = isset($_POST['mb_target']) && $_POST['mb_target'] ? 'on' : 'off';
        update_post_meta($post_id, 'mb_target', $target);

        // Carrera
        /*if (isset($_POST['mb_carrera']) && !empty($_POST['mb_carrera'])) {
            update_post_meta($post_id, 'mb_carrera', esc_attr($_POST['mb_carrera']));
        } else {
            delete_post_meta($post_id, 'mb_carrera');
        }*/

        // Image Responsive
        if (isset($_POST['mb_responsive']) && !empty($_POST['mb_responsive'])) {
            update_post_meta($post_id, 'mb_responsive', esc_attr($_POST['mb_responsive']));
        } else {
            delete_post_meta($post_id, 'mb_responsive');
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_sliders()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/tc-mb-sliders.php';
    }
    
    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with post type parallaxs.
     */
    public function cd_mb_parallaxs_add()
    {
        add_meta_box(
            'mb-parallaxs-id', 'Configuraciones', array($this, 'render_mb_parallaxs'), 'parallaxs', 'normal', 'core'
        );
    }

    public function cd_mb_parallaxs_save($post_id)
    {
        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'parallaxs_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // title
        if (isset($_POST['mb_title']) && !empty($_POST['mb_title'])) {
            update_post_meta($post_id, 'mb_title', esc_attr($_POST['mb_title']));
        } else {
            delete_post_meta($post_id, 'mb_title');
        }
        
        // subtitle
        if (isset($_POST['mb_subtitle']) && !empty($_POST['mb_subtitle'])) {
            update_post_meta($post_id, 'mb_subtitle', esc_attr($_POST['mb_subtitle']));
        } else {
            delete_post_meta($post_id, 'mb_subtitle');
        }

        // legend
        if (isset($_POST['mb_legend']) && !empty($_POST['mb_legend'])) {
            update_post_meta($post_id, 'mb_legend', esc_attr($_POST['mb_legend']));
        } else {
            delete_post_meta($post_id, 'mb_legend');
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_parallaxs()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/tc-mb-parallaxs.php';
    }
    
    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with post type page.
     */
    public function cd_mb_pages_add()
    {
        add_meta_box(
            'mb-pages-id',
            'Configuraciones',
            array($this, 'render_mb_pages'),
            'page',
            'normal',
            'core'
        );
    }

    public function cd_mb_pages_save($post_id)
    {
        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'pages_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Parallax
        if (isset($_POST['mb_parallax']) && !empty($_POST['mb_parallax'])) {
            update_post_meta($post_id, 'mb_parallax', esc_attr($_POST['mb_parallax']));
        } else {
            delete_post_meta($post_id, 'mb_parallax');
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_pages()
    {
        require_once plugin_dir_path(__FILE__).'partials/tc-mb-pages.php';
    }
    
    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with post type contacts.
     */
    public function cd_mb_contacts_add()
    {
        add_meta_box(
            'mb-contacts-id',
            'Datos del Contacto',
            array($this, 'render_mb_contacts'),
            'contacts',
            'normal',
            'core'
        );
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_contacts()
    {
        require_once plugin_dir_path(__FILE__).'partials/tc-mb-contacts.php';
    }

    public function custom_columns_contacts($columns)
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Nombre'),
            'email' => __('Correo electrónico'),
            'date' => __('Fecha'),
        );

        return $columns;
    }

    public function custom_column_contacts($column)
    {
        global $post;

        // Setup some vars
        $edit_link = get_edit_post_link($post->ID);
        $post_type_object = get_post_type_object($post->post_type);
        $can_edit_post = current_user_can('edit_post', $post->ID);
        $values = get_post_custom($post->ID);

        switch ($column) {
            case 'name':
                $name = isset($values['mb_name']) ? esc_attr($values['mb_name'][0]) : '';

                // Display the name
                if (!empty($name)) {
                    if($can_edit_post && $post->post_status != 'trash') {
                        echo '<a class="row-title" href="' . $edit_link . '" title="' . esc_attr(__('Editar este elemento')) . '">' . $name . '</a>';
                    } else {
                        echo $name;
                    }
                }

                // Add admin actions
                $actions = array();
                if ($can_edit_post && 'trash' != $post->post_status) {
                    $actions['edit'] = '<a href="' . get_edit_post_link($post->ID, true) . '" title="' . esc_attr(__( 'Editar este elemento')) . '">' . __('Editar') . '</a>';
                }

                if (current_user_can('delete_post', $post->ID)) {
                    if ('trash' == $post->post_status) {
                        $actions['untrash'] = "<a title='" . esc_attr(__('Restaurar este elemento desde la papelera')) . "' href='" . wp_nonce_url(admin_url(sprintf($post_type_object->_edit_link . '&amp;action=untrash', $post->ID)), 'untrash-post_' . $post->ID) . "'>" . __('Restaurar') . "</a>";
                    } elseif(EMPTY_TRASH_DAYS) {
                        $actions['trash'] = "<a class='submitdelete' title='" . esc_attr(__('Mover este elemento a la papelera')) . "' href='" . get_delete_post_link($post->ID) . "'>" . __('Papelera') . "</a>";
                    }

                    if ('trash' == $post->post_status || !EMPTY_TRASH_DAYS) {
                        $actions['delete'] = "<a class='submitdelete' title='" . esc_attr(__('Borrar este elemento permanentemente')) . "' href='" . get_delete_post_link($post->ID, '', true) . "'>" . __('Borrar permanentemente') . "</a>";
                    }
                }

                $html = '<div class="row-actions">';
                if (isset($actions['edit'])) {
                    $html .= '<span class="edit">' . $actions['edit'] . ' | </span>';
                }
                if (isset($actions['trash'])) {
                    $html .= '<span class="trash">' . $actions['trash'] . '</span>';
                }
                if (isset($actions['untrash'])) {
                    $html .= '<span class="untrash">' . $actions['untrash'] . ' | </span>';
                }
                if (isset($actions['delete'])) {
                    $html .= '<span class="delete">' . $actions['delete'] . '</span>';
                }
                $html .= '</div>';

                echo $html;
                break;
            case 'email':
                $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
                echo $email;
                break;
        }
    }

    public function contacts_button_view_edit($views)
    {
        echo '<p>'
        . '<a href="' . plugin_dir_url(dirname(__FILE__)) . 'contacts/generateExcel" class="button button-primary">Generar excel</a>'
        . '</p>';

        return $views;
    }
    
    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with post type customers.
     */
    public function cd_mb_customers_add()
    {
        add_meta_box(
            'mb-customers-id', 'Configuraciones', array($this, 'render_mb_customers'), 'customers', 'normal', 'core'
        );
    }

    public function cd_mb_customers_save($post_id)
    {
        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'customers_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // URL
        if (isset($_POST['mb_url']) && !empty($_POST['mb_url'])) {
            update_post_meta($post_id, 'mb_url', esc_attr($_POST['mb_url']));
        } else {
            delete_post_meta($post_id, 'mb_url');
        }

        // Target
        $target = isset($_POST['mb_target']) && $_POST['mb_target'] ? 'on' : 'off';
        update_post_meta($post_id, 'mb_target', $target);
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_customers()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/tc-mb-customers.php';
    }
    
    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with post type projects.
     */
    public function cd_mb_projects_add()
    {
        add_meta_box(
            'mb-projects-id', 'Configuraciones', array($this, 'render_mb_projects'), 'projects', 'normal', 'core'
        );
    }

    public function cd_mb_projects_save($post_id)
    {
        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'projects_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        if (isset($_POST['mb_gallery'])) {
            $gallery = $_POST['mb_gallery'];

            $save = false;
            $newArrGallery = array();

            foreach ($gallery as $img) {
                if (!empty($img)) {
                    $save = true;
                    $newArrGallery[] = $img;
                }
            }

            if ($save) {
                update_post_meta($post_id, 'mb_gallery', $newArrGallery);
            } else {
                delete_post_meta($post_id, 'mb_gallery');
            }
        } else {
            delete_post_meta($post_id, 'mb_gallery');
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_projects()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/tc-mb-projects.php';
    }
    
    /**
     * Add custom content type slides.
     */
    public function add_post_type()
    {
        $labels = array(
            'name'               => __('Sliders', $this->domain),
            'singular_name'      => __('Slider', $this->domain),
            'add_new'            => __('Nuevo slider', $this->domain),
            'add_new_item'       => __('Agregar nuevo slider', $this->domain),
            'edit_item'          => __('Editar slider', $this->domain),
            'new_item'           => __('Nuevo slider', $this->domain),
            'view_item'          => __('Ver slider', $this->domain),
            'search_items'       => __('Buscar slider', $this->domain),
            'not_found'          => __('Slider no encontrado', $this->domain),
            'not_found_in_trash' => __('Slider no encontrado en la papelera', $this->domain),
            'all_items'          => __('Todos los sliders', $this->domain),
//            'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
//            'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'. 
//            'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
//            'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
//            'featured_image' - Default is Featured Image.
//            'set_featured_image' - Default is Set featured image.
//            'remove_featured_image' - Default is Remove featured image.
//            'use_featured_image' - Default is Use as featured image.
//            'menu_name' - Default is the same as `name`.
//            'filter_items_list' - String for the table views hidden heading.
//            'items_list_navigation' - String for the table pagination hidden heading.
//            'items_list' - String for the table hidden heading.
//            'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`. 
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Sliders visibles en el homepage',
            // 'public'              => false,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-images-alt2',
            // 'hierarchical'        => false,
            'supports' => array(
                'title',
                'editor',
                'custom-fields',
                'author',
                'thumbnail',
                'page-attributes',
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
            // 'has_archive' => false,
             'rewrite'     => false
        );
        register_post_type('sliders', $args);
        
        $labels = array(
            'name'               => __('Parallaxs', $this->domain),
            'singular_name'      => __('Parallax', $this->domain),
            'add_new'            => __('Nuevo parallax', $this->domain),
            'add_new_item'       => __('Agregar nuevo parallax', $this->domain),
            'edit_item'          => __('Editar parallax', $this->domain),
            'new_item'           => __('Nuevo parallax', $this->domain),
            'view_item'          => __('Ver parallax', $this->domain),
            'search_items'       => __('Buscar parallax', $this->domain),
            'not_found'          => __('Parallax no encontrado', $this->domain),
            'not_found_in_trash' => __('Parallax no encontrado en la papelera', $this->domain),
            'all_items'          => __('Todos los parallaxs', $this->domain),
//            'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
//            'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'. 
//            'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
//            'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
//            'featured_image' - Default is Featured Image.
//            'set_featured_image' - Default is Set featured image.
//            'remove_featured_image' - Default is Remove featured image.
//            'use_featured_image' - Default is Use as featured image.
//            'menu_name' - Default is the same as `name`.
//            'filter_items_list' - String for the table views hidden heading.
//            'items_list_navigation' - String for the table pagination hidden heading.
//            'items_list' - String for the table hidden heading.
//            'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`. 
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Todos los Parallaxs',
            // 'public'              => false,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-format-image',
            // 'hierarchical'        => false,
            'supports' => array(
                'title',
                'editor',
                'custom-fields',
                'author',
                'thumbnail',
//                'page-attributes',
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
            // 'has_archive' => false,
             'rewrite'     => false
        );
        register_post_type('parallaxs', $args);
        
        $labels = array(
            'name'               => __('Contactos', $this->domain),
            'singular_name'      => __('Contacto', $this->domain),
            'add_new'            => __('Nuevo contacto', $this->domain),
            'add_new_item'       => __('Agregar nuevo contacto', $this->domain),
            'edit_item'          => __('Editar contacto', $this->domain),
            'new_item'           => __('Nuevo contacto', $this->domain),
            'view_item'          => __('Ver contacto', $this->domain),
            'search_items'       => __('Buscar contacto', $this->domain),
            'not_found'          => __('Contacto no encontrado', $this->domain),
            'not_found_in_trash' => __('Contactp no encontrado en la papelera', $this->domain),
            'all_items'          => __('Todos los contactos', $this->domain),
  //          'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
  //          'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
  //          'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
  //          'featured_image' - Default is Featured Image.
  //          'set_featured_image' - Default is Set featured image.
  //          'remove_featured_image' - Default is Remove featured image.
  //          'use_featured_image' - Default is Use as featured image.
  //          'menu_name' - Default is the same as `name`.
  //          'filter_items_list' - String for the table views hidden heading.
  //          'items_list_navigation' - String for the table pagination hidden heading.
  //          'items_list' - String for the table hidden heading.
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Listado de usuarios que realizaron alguna consulta a través del formulario de contacto.',
            // 'public'              => false,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-money',
            // 'hierarchical'        => false,
            'supports' => array(
//                'title',
//                'editor',
                'custom-fields',
                'author',
//                'thumbnail',
//                'page-attributes',
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
            // 'has_archive' => false,
             'rewrite'     => false
        );
        register_post_type('contacts', $args);
        
        $labels = array(
            'name'               => __('Clientes', $this->domain),
            'singular_name'      => __('Cliente', $this->domain),
            'add_new'            => __('Nuevo cliente', $this->domain),
            'add_new_item'       => __('Agregar nuevo cliente', $this->domain),
            'edit_item'          => __('Editar cliente', $this->domain),
            'new_item'           => __('Nuevo cliente', $this->domain),
            'view_item'          => __('Ver cliente', $this->domain),
            'search_items'       => __('Buscar cliente', $this->domain),
            'not_found'          => __('Cliente no encontrado', $this->domain),
            'not_found_in_trash' => __('Cliente no encontrado en la papelera', $this->domain),
            'all_items'          => __('Todos los clientes', $this->domain),
//            'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
//            'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'. 
//            'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
//            'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
//            'featured_image' - Default is Featured Image.
//            'set_featured_image' - Default is Set featured image.
//            'remove_featured_image' - Default is Remove featured image.
//            'use_featured_image' - Default is Use as featured image.
//            'menu_name' - Default is the same as `name`.
//            'filter_items_list' - String for the table views hidden heading.
//            'items_list_navigation' - String for the table pagination hidden heading.
//            'items_list' - String for the table hidden heading.
//            'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`. 
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Nuestro clientes',
            // 'public'              => false,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-groups',
            // 'hierarchical'        => false,
            'supports' => array(
                'title',
//                'editor',
                'custom-fields',
                'author',
                'thumbnail',
                'page-attributes',
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
            // 'has_archive' => false,
             'rewrite'     => false
        );
        register_post_type('customers', $args);
        
        $labels = array(
            'name'               => __('Proyectos', $this->domain),
            'singular_name'      => __('Proyecto', $this->domain),
            'add_new'            => __('Nuevo proyecto', $this->domain),
            'add_new_item'       => __('Agregar nuevo proyecto', $this->domain),
            'edit_item'          => __('Editar proyecto', $this->domain),
            'new_item'           => __('Nuevo proyecto', $this->domain),
            'view_item'          => __('Ver proyecto', $this->domain),
            'search_items'       => __('Buscar proyecto', $this->domain),
            'not_found'          => __('Proyecto no encontrado', $this->domain),
            'not_found_in_trash' => __('Proyecto no encontrado en la papelera', $this->domain),
            'all_items'          => __('Todos los proyectos', $this->domain),
//            'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
//            'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'. 
//            'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
//            'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
//            'featured_image' - Default is Featured Image.
//            'set_featured_image' - Default is Set featured image.
//            'remove_featured_image' - Default is Remove featured image.
//            'use_featured_image' - Default is Use as featured image.
//            'menu_name' - Default is the same as `name`.
//            'filter_items_list' - String for the table views hidden heading.
//            'items_list_navigation' - String for the table pagination hidden heading.
//            'items_list' - String for the table hidden heading.
//            'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`. 
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Nuestro proyectos',
             'public'              => true,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-store',
            // 'hierarchical'        => false,
            'supports' => array(
                'title',
                'editor',
                'custom-fields',
                'author',
                'thumbnail',
//                'page-attributes',
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
             'has_archive' => true,
             'rewrite'     => array(
                 'slug' => 'proyectos'
             )
        );
        register_post_type('projects', $args);
        
        flush_rewrite_rules();
    }

    public function unregister_post_type()
    {
        global $wp_post_types;

        if (isset($wp_post_types[ 'testimonials' ])) {
            unset($wp_post_types[ 'testimonials' ]);

            return true;
        }

        return false;
    }
    
    /**
     * Add custom taxonomies types to post type projects.
     */
    public function add_taxonomies_projects()
    {
        $labels = array(
            'name' => _x('Tipos de Proyectos', 'Taxonomy plural name', THEMEDOMAIN),
            'singular_name' => _x('Tipo de Proyecto', 'Taxonomy singular name', THEMEDOMAIN),
            'search_items' => __('Buscar Tipo de Proyecto', THEMEDOMAIN),
            'popular_items' => __('Tipos de Proyectos Populares', THEMEDOMAIN),
            'all_items' => __('Todas las Tipos de Proyectos', THEMEDOMAIN),
            'parent_item' => __('Tipo de Proyecto Padre', THEMEDOMAIN),
            'parent_item_colon' => __('Tipo de Proyecto Padre', THEMEDOMAIN),
            'edit_item' => __('Editar Tipo de Proyecto', THEMEDOMAIN),
            'update_item' => __('Actualizar Tipo de Proyecto', THEMEDOMAIN),
            'add_new_item' => __('Añadir nuevo Tipo de Proyecto', THEMEDOMAIN),
            'new_item_name' => __('Nuevo Tipo de Proyecto', THEMEDOMAIN),
            'add_or_remove_items' => __('Añadir o eliminar Tipo de Proyecto', THEMEDOMAIN),
            'choose_from_most_used' => __('Choose from most used text-domain', THEMEDOMAIN),
            'menu_name' => __('Tipos de Proyectos', THEMEDOMAIN),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
            'show_tagcloud' => false,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array(
              'slug' => 'tipo-proyecto',
            ),
            'query_var' => true,
//            'capabilities' => array(),
        );

        register_taxonomy('types', 'projects', $args);
    }
}
