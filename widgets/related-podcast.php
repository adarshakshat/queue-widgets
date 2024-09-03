<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Related_Podcast extends Widget_Base{
    public function get_name() {
        return 'related-podcast';
    }

    public function get_title() {
        return __( 'Related Podcast', 'elementor-hello-world' );
    }
    public function get_icon() {
        return 'eicon-posts-ticker';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'related-podcast-js' ];
    }
    public function get_style_depends() {
        return [ 'podcast-nav' ];
    }
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom-elementor-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu_item_1',
            [
                'label' => __( 'Menu Item 1 Text', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'My Podcasts', 'custom-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'menu_item_1_link',
            [
                'label' => __( 'Menu Item 1 Link', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'custom-elementor-widgets' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'menu_item_2',
            [
                'label' => __( 'Menu Item 2 Text', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'All Experts', 'custom-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'menu_item_2_link',
            [
                'label' => __( 'Menu Item 2 Link', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'custom-elementor-widgets' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        // Schedule Button Text and Link
        $this->add_control(
            'schedule_btn_text',
            [
                'label' => __( 'Schedule Button Text', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Schedule Call', 'custom-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'schedule_btn_link',
            [
                'label' => __( 'Schedule Button Link', 'custom-elementor-widgets' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-schedule-link.com', 'custom-elementor-widgets' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $args = array(
            'post_type' => 'podcast',
            'posts_per_page' => 5, // or specify the number of posts
            'post_status' => 'publish'
        );
        $podcast_query = new \WP_Query($args);
        $settings = $this->get_settings_for_display();
        $menu_item_1_url = !empty($settings['menu_item_1_link']['url']) ? esc_url($settings['menu_item_1_link']['url']) : '#';
        $menu_item_2_url = !empty($settings['menu_item_2_link']['url']) ? esc_url($settings['menu_item_2_link']['url']) : '#';
        $schedule_btn_url = !empty($settings['schedule_btn_link']['url']) ? esc_url($settings['schedule_btn_link']['url']) : '#';
        $logo_url = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/logo.png' );
        $profile_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/profile.png' );
        $radio_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/radio.png' );
?>
        <section class="containerSwipper">
            <div class="card__container swiper">
                <div class="card__content">
                    <div class="swiper-wrapper">
        <?php
        if ($podcast_query->have_posts()) :
            while ($podcast_query->have_posts()) : $podcast_query->the_post();
                $pid = get_the_ID();
                $expert_image = get_the_post_thumbnail_url();
                $expert_name = get_post_meta($pid, 'expert_name', true);
                $expert_profession = get_post_meta($pid, 'expert_info', true);
                $podcast_desc = get_post_meta($pid, 'podcast_quote', true);
                $audio_url = get_post_meta($pid, 'highlight_audio_url', true);
                $thumbs_up = esc_url( QU_ASSETS_URL . 'img/thumbs-up.svg');
                $thumbs_down = esc_url( QU_ASSETS_URL . 'img/thumbs-down.svg');
                ?>
                <div class="cart-item swiper-slide">
                    <div class="cart-icons">
                        <img src="<?php echo esc_url($thumbs_up); ?>" alt="like" class=" ">
                        <img src="<?php echo esc_url($thumbs_down); ?>" alt="dislike" class=" ">

<!--                        <span class="dashicons dashicons-thumbs-up"></span>-->
<!--                        <span class="dashicons dashicons-thumbs-down"></span>-->
                    </div>
                    <div class="cart-image">
                        <img src="<?php echo esc_url($expert_image); ?>" alt="Profile Image" class="profile-img">
                    </div>

                    <h3 class="cart-name"><?php echo esc_html($expert_name); ?></h3>
                    <h4 class="cart-profession"><?php echo esc_html($expert_profession); ?></h4>

                    <p class="cart-description">
                        <?php echo wp_kses_post($podcast_desc); ?>
                    </p>
                    <div class="audio-playertop">
                        <span id="playPauseBtn<?php echo $pid; ?>" class="play-btn"></span>
<!--                        <span id="playPauseBtn4" class="dashicons dashicons-controls-play"></span>-->
                        <div class="progress-barMiddle">
                            <div id="progress" class="progressTop"></div>
                        </div>
                        <audio id="audioPlayer" src="<?php echo esc_url($audio_url); ?>"></audio>
                    </div>
                    <div class="time-DurationSwip">
                        <p class="Secswip" id="timeRemaining">Play 1 min highlight</p>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;

        ?>
                    </div>
                </div>

                <!-- Navigation buttons -->
                <!-- <div class="swiper-button-next">
                   <i class="ri-arrow-right-s-line"></i>
                </div>

                <div class="swiper-button-prev">
                   <i class="ri-arrow-left-s-line"></i>
                </div> -->

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <?php
    }
}


