<?php

class Podcast_Post_Type {

    public function __construct() {
        add_action('init', [$this, 'register_podcast_post_type']);
        add_action('init', [$this, 'register_podcast_taxonomies']);
        add_action('rest_api_init', [$this, 'register_podcast_rest_routes']);
        add_action('cmb2_admin_init', [$this, 'initialize_cmb2_fields']); // Add CMB2 fields
    }

    public function register_podcast_post_type() {
        $labels = [
            'name'               => _x('Podcasts', 'post type general name'),
            'singular_name'      => _x('Podcast', 'post type singular name'),
            'menu_name'          => _x('Podcasts', 'admin menu'),
            'name_admin_bar'     => _x('Podcast', 'add new on admin bar'),
            'add_new'            => _x('Add New', 'podcast'),
            'add_new_item'       => __('Add New Podcast'),
            'new_item'           => __('New Podcast'),
            'edit_item'          => __('Edit Podcast'),
            'view_item'          => __('View Podcast'),
            'all_items'          => __('All Podcasts'),
            'search_items'       => __('Search Podcasts'),
            'parent_item_colon'  => __('Parent Podcasts:'),
            'not_found'          => __('No podcasts found.'),
            'not_found_in_trash' => __('No podcasts found in Trash.'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'menu_icon'            => 'dashicons-microphone',
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => ['title', 'author', 'thumbnail'],
            'show_in_rest'       => true, // Enables REST API
        ];

        register_post_type('podcast', $args);
    }

    public function register_podcast_taxonomies() {
        // Register "Industry" taxonomy
        $labels = [
            'name'              => _x('Industries', 'taxonomy general name'),
            'singular_name'     => _x('Industry', 'taxonomy singular name'),
            'search_items'      => __('Search Industries'),
            'all_items'         => __('All Industries'),
            'parent_item'       => __('Parent Industry'),
            'parent_item_colon' => __('Parent Industry:'),
            'edit_item'         => __('Edit Industry'),
            'update_item'       => __('Update Industry'),
            'add_new_item'      => __('Add New Industry'),
            'new_item_name'     => __('New Industry Name'),
            'menu_name'         => __('Industry'),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'industry'],
            'show_in_rest'      => true, // Enables REST API
        ];

        register_taxonomy('industry', ['podcast'], $args);

        // Register "Profession" taxonomy
        $labels = [
            'name'              => _x('Professions', 'taxonomy general name'),
            'singular_name'     => _x('Profession', 'taxonomy singular name'),
            'search_items'      => __('Search Professions'),
            'all_items'         => __('All Professions'),
            'parent_item'       => __('Parent Profession'),
            'parent_item_colon' => __('Parent Profession:'),
            'edit_item'         => __('Edit Profession'),
            'update_item'       => __('Update Profession'),
            'add_new_item'      => __('Add New Profession'),
            'new_item_name'     => __('New Profession Name'),
            'menu_name'         => __('Profession'),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'profession'],
            'show_in_rest'      => true, // Enables REST API
        ];

        register_taxonomy('profession', ['podcast'], $args);
    }

    public function register_podcast_rest_routes() {
        register_rest_route('podcast-api/v1', '/create/', [
            'methods'  => 'POST',
            'callback' => [$this, 'create_podcast'],
            'permission_callback' => function () {
                return current_user_can('edit_posts');
            },
        ]);
    }

    public function create_podcast($data) {
        $params = $data->get_params();

        $postarr = [
            'post_title'    => sanitize_text_field($params['title']),
            'post_status'   => 'publish',
            'post_type'     => 'podcast',
            'meta_input'    => [],
        ];

        $post_id = wp_insert_post($postarr);

        if (is_wp_error($post_id)) {
            return new WP_Error('cant-create', __('Unable to create podcast'), ['status' => 500]);
        }

        // Handle taxonomies
        if (isset($params['industry'])) {
            wp_set_object_terms($post_id, intval($params['industry']), 'industry');
        }

        if (isset($params['profession'])) {
            wp_set_object_terms($post_id, intval($params['profession']), 'profession');
        }
        if (isset($params['podcast_title'])) {
            update_post_meta($post_id, 'podcast_title', sanitize_textarea_field($params['podcast_title']));
        }
        if (isset($params['podcast_quote'])) {
            update_post_meta($post_id, 'podcast_quote', sanitize_textarea_field($params['podcast_quote']));
        }

        if (isset($params['highlight_audio_url'])) {
            update_post_meta($post_id, 'highlight_audio_url', esc_url_raw($params['highlight_audio_url']));
        }

        if (isset($params['full_audio_url'])) {
            update_post_meta($post_id, 'full_audio_url', esc_url_raw($params['full_audio_url']));
        }
        if (isset($params['podcast_desc'])) {
            $allowed_tags = array(
                'a' => array(
                    'href' => array(),
                    'title' => array(),
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'p' => array(),
                'ul' => array(),
                'ol' => array(),
                'li' => array(),
            );
            $sanitized_html = wp_kses($params['podcast_desc'], $allowed_tags);
            update_post_meta($post_id, 'podcast_desc', $sanitized_html);
        }

        if (isset($params['expert_name'])) {
            update_post_meta($post_id, 'expert_name', sanitize_text_field($params['expert_name']));
        }

        if (isset($params['expert_info'])) {
            update_post_meta($post_id, 'expert_info', sanitize_textarea_field($params['expert_info']));
        }

        if (isset($params['expert_about'])) {
            update_post_meta($post_id, 'expert_about', sanitize_textarea_field($params['expert_about']));
        }

        if (isset($params['expert_image'])) {
            update_post_meta($post_id, 'expert_image', esc_url_raw($params['expert_image']));
        }

        if (isset($params['audio_title'])) {
            update_post_meta($post_id, 'audio_title', sanitize_text_field($params['audio_title']));
        }

        if (isset($params['twitter_link'])) {
            update_post_meta($post_id, 'twitter_link', esc_url_raw($params['twitter_link']));
        }

        if (isset($params['linkedin_link'])) {
            update_post_meta($post_id, 'linkedin_link', esc_url_raw($params['linkedin_link']));
        }
        if (isset($params['highlight_list']) && is_array($params['highlight_list'])) {
            $highlight_list = array_map('sanitize_text_field', $params['highlight_list']);
            update_post_meta($post_id, 'highlight_list', $highlight_list);
        }
        if (!is_wp_error($post_id) && !empty($params['featured_image_url'])) {
            $this->set_featured_image_from_url($post_id, esc_url_raw($params['featured_image_url']));
        }


        return new WP_REST_Response(['post_id' => $post_id], 200);
    }
    public static function set_featured_image_from_url($post_id, $image_url) {
        // Check if the URL is not empty
        if (!empty($image_url)) {
            // Download the image file to the server
            require_once(ABSPATH . 'wp-admin/includes/file.php');

            $temp_file = download_url($image_url);

            // If there's an error in downloading the image, stop the process
            if (is_wp_error($temp_file)) {
                return;
            }

            // Extract the file name and file type from the URL
            $file = [
                'name'     => basename($image_url),
                'type'     => mime_content_type($temp_file),
                'tmp_name' => $temp_file,
                'error'    => 0,
                'size'     => filesize($temp_file),
            ];

            // Handle the file upload in WordPress
            $sideload = wp_handle_sideload($file, ['test_form' => false]);

            // If the upload fails, stop the process and delete the temp file
            if (!empty($sideload['error'])) {
                @unlink($temp_file); // Delete the temporary file
                return;
            }

            // Insert the image into the media library
            $attachment_id = wp_insert_attachment([
                'guid'           => $sideload['url'],
                'post_mime_type' => $sideload['type'],
                'post_title'     => sanitize_file_name($file['name']),
                'post_content'   => '',
                'post_status'    => 'inherit',
            ], $sideload['file'], $post_id);

            // Generate the attachment's metadata
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $sideload['file']);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            // Set the image as the featured image for the post
            set_post_thumbnail($post_id, $attachment_id);
        }
    }
    public function initialize_cmb2_fields() {
        $cmb = new_cmb2_box([
            'id'            => 'podcast_metabox',
            'title'         => __('Podcast Details', 'cmb2'),
            'object_types'  => ['podcast'], // Post type
        ]);

        $cmb->add_field([
            'name' => __('Podcast Title', 'cmb2'),
            'id'   => 'podcast_title',
            'type' => 'text',
        ]);
        $cmb->add_field( array(
            'name'    => 'Podcast Description',
            'desc'    => 'In this Episode section text goes here',
            'id'      => 'podcast_desc',
            'type'    => 'wysiwyg',
            'options' => array(),
        ) );

        $cmb->add_field([
            'name' => __('Podcast Quote', 'cmb2'),
            'id'   => 'podcast_quote',
            'type' => 'text',
        ]);
        $cmb->add_field([
            'name' => __('Expert Name', 'cmb2'),
            'id'   => 'expert_name',
            'type' => 'textarea_small',
        ]);
        $cmb->add_field([
            'name' => __('Expert Info', 'cmb2'),
            'id'   => 'expert_info',
            'type' => 'textarea_small',
        ]);
        $cmb->add_field([
            'name' => __('About Expert', 'cmb2'),
            'id'   => 'expert_about',
            'type' => 'textarea_small',
        ]);
        $cmb->add_field( array(
            'name'    => 'Expert Image',
            'desc'    => 'Upload an image or enter an URL.',
            'id'      => 'expert_image',
            'type'    => 'file',
            'text'    => array(
                'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
            ),
            // query_args are passed to wp.media's library query.
            'query_args' => array(
                 'type' => array(
                     'image/gif',
                     'image/jpeg',
                     'image/png',
                 ),
            ),
            'preview_size' => 'large', // Image size to use when previewing in the admin.
        ) );
        $cmb->add_field([
            'name' => __('Audio Title', 'cmb2'),
            'id'   => 'audio_title',
            'type' => 'text',
        ]);
        $cmb->add_field([
            'name' => __('Highlight Audio URL', 'cmb2'),
            'id'   => 'highlight_audio_url',
            'type' => 'text_url',
        ]);

        $cmb->add_field([
            'name' => __('Full Audio URL', 'cmb2'),
            'id'   => 'full_audio_url',
            'type' => 'text_url',
        ]);

        $cmb->add_field([
            'name' => __('Twitter Link', 'cmb2'),
            'id'   => 'twitter_link',
            'type' => 'text_url',
        ]);

        $cmb->add_field([
            'name' => __('LinkedIn Link', 'cmb2'),
            'id'   => 'linkedin_link',
            'type' => 'text_url',
        ]);
        $cmb->add_field( array(
            'name'       => __( 'Highlight List', 'cmb2' ),
            'id'         => 'highlight_list',
            'type'       => 'text',
            'repeatable' => true,
            'description'=> 'Add the highlight items here. You can add as many as needed.',
            'options'    => array(
                'add_row_text' => 'Add Highlight', // Text for the "add" button
            ),
        ) );
    }
}

new Podcast_Post_Type();
