<?php

namespace WPMovieList;

class WPMovieList {

    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->plugin_name = 'wp-movie-list';
        $this->version = '1.0.0';

        $this->Webilia_load_dependencies();
        $this->Webilia_set_locale();
        $this->Webilia_define_admin_hooks();
        $this->Webilia_define_public_hooks();
    }

    private function Webilia_load_dependencies() {
        require_once plugin_dir_path(__FILE__) . 'services/class-post-type-service.php';
        require_once plugin_dir_path(__FILE__) . 'services/class-taxonomy-service.php';
        require_once plugin_dir_path(__FILE__) . 'services/class-shortcode-service.php';
        require_once plugin_dir_path(__FILE__) . 'services/class-ajax-service.php';
        require_once plugin_dir_path(__FILE__) . 'services/class-i18n.php';
        require_once plugin_dir_path(__FILE__) . 'admin/class-admin-service.php';
        require_once plugin_dir_path(__FILE__) . 'frontend/class-public-service.php';
        require_once plugin_dir_path(__FILE__) . 'services/class-template-loader.php';


        $post_type_service = new Services\PostTypeService();
        $post_type_service->Webilia_register();

        $taxonomy_service = new Services\TaxonomyService();
        $taxonomy_service->Webilia_register();

        $shortcode_service = new Services\ShortcodeService();
        $shortcode_service->Webilia_register();

        $ajax_service = new Services\AjaxService();
        $ajax_service->Webilia_register();

        $admin_service = new Admin\AdminService();
        $admin_service->Webilia_register();

        $public_service = new Frontend\PublicService();
        $public_service->Webilia_register();

        $template_loader = new Services\TemplateLoader();
        $template_loader->Webilia_register();
    }

    private function Webilia_set_locale() {
        $plugin_i18n = new Services\i18n();
        add_action('plugins_loaded', [$plugin_i18n, 'Webilia_load_plugin_textdomain']);
    }

    private function Webilia_define_admin_hooks() {
        // Define admin-specific hooks here
    }

    private function Webilia_define_public_hooks() {
        // Define public-specific hooks here
    }

    public function Webilia_run() {
        // Run the plugin
    }

    public function Webilia_get_plugin_name() {
        return $this->plugin_name;
    }

    public function Webilia_get_version() {
        return $this->version;
    }

    public function Webilia_create_challenge_page() {
        $query = new \WP_Query([
            'post_type' => 'page',
            'post_status' => 'publish',
            'title' => 'Webilia Challenge',
            'posts_per_page' => 1,
            'no_found_rows' => true,
        ]);
    
        if ($query->have_posts()) {
            $page_id = $query->posts[0]->ID;
            $page_data = array(
                'ID'           => $page_id,
                'post_content' => '[movies]',
            );
            wp_update_post($page_data);
        } else {
            $page_data = array(
                'post_title'   => 'Webilia Challenge',
                'post_content' => '[movies]',
                'post_status'  => 'publish',
                'post_type'    => 'page',
            );
            wp_insert_post($page_data);
        }
    }
    
}
