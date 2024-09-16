<?php

namespace ElementorHelloWorld;

use ElementorHelloWorld\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin
{

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return Plugin An instance of the class.
     * @since 1.2.0
     * @access public
     *
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function search_taxonomy_terms() {
        $taxonomy = isset($_GET['taxonomy']) ? sanitize_text_field($_GET['taxonomy']) : '';
        $search_term = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : 'industry';

        if (!$taxonomy || !$search_term) {
            wp_send_json_error('Invalid search.');
            wp_die();
        }

        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'search' => $search_term,
            'hide_empty' => false,
        ));

        $results = array();
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $results[] = array(
                    'id' => $term->term_id, // Send term ID
                    'text' => $term->name,   // Display term name in the select2 dropdown
                );
            }
        }

        wp_send_json($results);
        wp_die();
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts()
    {
        wp_register_script('queue-widgets', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
        wp_register_script('swiper-js', plugins_url('/assets/js/swiper-bundle.min.js', __FILE__));
        wp_register_script('related-podcast-js', plugins_url('/assets/js/related-podcast.js', __FILE__), ['swiper-js'], false, true);
        wp_register_script('takeaway-expander', plugins_url('/assets/js/takeaway-expander.js', __FILE__), ['jquery'], false, true);
        wp_register_script('podcast-hero-js', plugins_url('/assets/js/podcast-hero.js', __FILE__), true);
        wp_register_script('podcast-content-js', plugins_url('/assets/js/podcast-content.js', __FILE__), true);
        wp_register_script('podcast-list-js', plugins_url('/assets/js/podcast-list.js', __FILE__), true);
        wp_register_script('podcast-list-player', plugins_url('/assets/js/podcast-list-player.js', __FILE__), true);
        wp_enqueue_script( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ) );
        wp_register_script('search', plugins_url('/assets/js/search.js', __FILE__), true);
        wp_localize_script('search', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }

    /**
     * Editor scripts
     *
     * Enqueue plugin javascripts integrations for Elementor editor.
     *
     * @since 1.2.1
     * @access public
     */
    public function editor_scripts()
    {
        add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

        wp_enqueue_script(
            'queue-widgets-editor',
            plugins_url('/assets/js/editor/editor.js', __FILE__),
            [
                'elementor-editor',
            ],
            '1.2.1',
            true
        );
    }

    /**
     * Force load editor script as a module
     *
     * @param string $tag
     * @param string $handle
     *
     * @return string
     * @since 1.2.1
     *
     */
    public function editor_scripts_as_a_module($tag, $handle)
    {
        if ('queue-widgets-editor' === $handle) {
            $tag = str_replace('<script', '<script type="module"', $tag);
        }

        return $tag;
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @param Widgets_Manager $widgets_manager Elementor widgets manager.
     * @since 1.2.0
     * @access public
     *
     */
    public function register_widgets($widgets_manager)
    {
        // Its is now safe to include Widgets files
        require_once(__DIR__ . '/widgets/podcast-nav.php');
        require_once(__DIR__ . '/widgets/podcast-hero.php');
        require_once(__DIR__ . '/widgets/podcast-content.php');
        require_once(__DIR__ . '/widgets/jessica-cta.php');
        require_once(__DIR__ . '/widgets/related-podcast.php');
        require_once(__DIR__ . '/widgets/footer.php');
        require_once(__DIR__ . '/widgets/podcast-list.php');
        require_once(__DIR__ . '/widgets/podcast-list-hero.php');
        require_once(__DIR__ . '/assets-css.php');

        // Register Widgets
        $widgets_manager->register(new Widgets\Podcast_Nav());
        $widgets_manager->register(new Widgets\Podcast_Hero());
        $widgets_manager->register(new Widgets\Podcast_Content());
        $widgets_manager->register(new Widgets\Jessica_CTA());
        $widgets_manager->register(new Widgets\Footer());
        $widgets_manager->register(new Widgets\Related_Podcast());
        $widgets_manager->register(new Widgets\Podcast_List());
        $widgets_manager->register(new Widgets\Podcast_List_Hero());
    }

    /**
     * Add page settings controls
     *
     * Register new settings for a document page settings.
     *
     * @since 1.2.1
     * @access private
     */
    private function add_page_settings_controls()
    {
        require_once(__DIR__ . '/page-settings/manager.php');
        new Page_Settings();
    }


    function register_widget_styles()
    {
        wp_enqueue_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
        wp_register_style('podcast-nav', plugins_url('assets/css/podcast-nav.css', __FILE__));
        wp_register_style('podcast-list', plugins_url('assets/css/podcast-list.css', __FILE__));
        wp_register_style('podcast-list-hero', plugins_url('assets/css/podcast-list-hero.css', __FILE__));
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct()
    {

        add_action('wp_ajax_search_taxonomy_terms', [$this, 'search_taxonomy_terms'] );
        add_action('wp_ajax_nopriv_search_taxonomy_terms', [$this, 'search_taxonomy_terms'] );


        add_action('wp_enqueue_scripts', [$this, 'register_widget_styles']);

        // Register widget scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

        // Register widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Register editor scripts
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

        $this->add_page_settings_controls();
    }
}

// Instantiate Plugin Class
Plugin::instance();
