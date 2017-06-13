<?php
/**
 * The TC Manager Public defines all functionality for the public-facing
 * sides of the plugin.
 */

/**
 * The TC Manager Public defines all functionality for the public-facing
 * sides of the plugin.
 *
 * This class defines the meta box used to display the post meta data and registers
 * the style sheet responsible for styling the content of the meta box.
 *
 * @since    1.0.0
 */
class Tc_Manager_Public
{
    /**
     * A reference to the version of the plugin that is passed to this class from the caller.
     *
     * @var string The current version of the plugin.
     */
    private $version;

    /**
     * Initializes this class and stores the current version of this plugin.
     *
     * @param string $version The current version of this plugin.
     */
    public function __construct($version)
    {
        $this->version = $version;
    }

    /**
     * Uses the partial located in the admin directory for rendering the
     * post meta data the end of the post content.
     *
     * @param string $content The post content.
     *
     * @return string $content    The post content including the given posts meta data.
     */
    public function display_post_meta_data($content)
    {
        ob_start();

        require_once plugin_dir_path(dirname(__FILE__)).'admin/partials/ilc-simulator.php';
        $template = ob_get_contents();
        $content .= $template;

        ob_end_clean();

        return $content;
    }
}
