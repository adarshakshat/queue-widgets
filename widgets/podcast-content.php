<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Podcast_Content extends Widget_Base{
    public function get_name() {
        return 'podcast-content';
    }

    public function get_title() {
        return __( 'Podcast Content', 'elementor-hello-world' );
    }
    public function get_icon() {
        return 'eicon-posts-ticker';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'elementor-hello-world','podcast-content-js' ];
    }
    public function get_style_depends() {
        return [ 'podcast-nav','dashicons' ];
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
            'author_name',
            [
                'label' => __( 'Author Name', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Enter podcast author name here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        // Description Control
        $this->add_control(
            'expert_info',
            [
                'label' => __( 'Expert Information', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter Expert Information description here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        // Description Control
        $this->add_control(
            'expert_about',
            [
                'label' => __( 'About Expert', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter podcast description here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        // Description Control
        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Enter podcast description here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // Twitter Link Control
        $this->add_control(
            'twitter_link',
            [
                'label' => __( 'Twitter Link', 'elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://twitter.com/yourprofile', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // LinkedIn Link Control
        $this->add_control(
            'linkedin_link',
            [
                'label' => __( 'LinkedIn Link', 'elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://linkedin.com/in/yourprofile', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // Audio Link Control
        $this->add_control(
            'audio_link',
            [
                'label' => __( 'Audio Link', 'elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://youraudiofile.com/audio.mp3', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // Audio Title Control
        $this->add_control(
            'audio_title',
            [
                'label' => __( 'Audio Title', 'elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Enter audio title here', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $menu_item_1_url = !empty($settings['menu_item_1_link']['url']) ? esc_url($settings['menu_item_1_link']['url']) : '#';
        $menu_item_2_url = !empty($settings['menu_item_2_link']['url']) ? esc_url($settings['menu_item_2_link']['url']) : '#';
        $schedule_btn_url = !empty($settings['schedule_btn_link']['url']) ? esc_url($settings['schedule_btn_link']['url']) : '#';
        $logo_url = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/logo.png' );
        $profile_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/profile.png' );
        $radio_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/radio.png' );
		$twitter = '
<svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="2.5" y="2" width="28" height="28" rx="14" fill="black"/>
<g clip-path="url(#clip0_78_2614)">
<path d="M26.305 11.805L23.8134 14.2966C23.31 20.1316 18.3892 24.6666 12.5 24.6666C11.29 24.6666 10.2925 24.475 9.53504 24.0966C8.92421 23.7908 8.67421 23.4633 8.61171 23.37C8.55598 23.2864 8.51986 23.1913 8.50604 23.0918C8.49223 22.9923 8.50107 22.891 8.53193 22.7954C8.56278 22.6998 8.61483 22.6124 8.6842 22.5397C8.75358 22.4671 8.83847 22.411 8.93254 22.3758C8.95421 22.3675 10.9525 21.6 12.2217 20.1391C11.5179 19.5605 10.9034 18.8809 10.3984 18.1225C9.36504 16.5883 8.20837 13.9233 8.56504 9.9408C8.57635 9.81426 8.62358 9.69358 8.70117 9.59298C8.77876 9.49237 8.88348 9.41604 9.00301 9.37296C9.12253 9.32987 9.25187 9.32184 9.37581 9.34981C9.49974 9.37777 9.6131 9.44057 9.70254 9.5308C9.73171 9.55997 12.4759 12.2891 15.8309 13.1741V12.6666C15.8296 12.1345 15.9348 11.6074 16.1403 11.1165C16.3458 10.6256 16.6475 10.1808 17.0275 9.8083C17.3966 9.43974 17.8358 9.14884 18.3191 8.95276C18.8025 8.75668 19.3202 8.65939 19.8417 8.66664C20.5413 8.67354 21.2273 8.86135 21.8328 9.21181C22.4384 9.56227 22.943 10.0635 23.2975 10.6666H25.8334C25.9653 10.6665 26.0943 10.7056 26.204 10.7788C26.3138 10.8521 26.3993 10.9562 26.4498 11.0781C26.5003 11.2 26.5135 11.3341 26.4877 11.4635C26.462 11.5929 26.3984 11.7117 26.305 11.805Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_78_2614">
<rect width="21.3333" height="21.3333" fill="white" transform="translate(5.83301 5.33331)"/>
</clipPath>
</defs>
</svg>
' ;
		$linkedin = '
<svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="2.5" y="2" width="28" height="28" rx="14" fill="#1275B1"/>
<path d="M13.1186 9.69215C13.1186 10.6267 12.3085 11.3843 11.3093 11.3843C10.31 11.3843 9.5 10.6267 9.5 9.69215C9.5 8.7576 10.31 8 11.3093 8C12.3085 8 13.1186 8.7576 13.1186 9.69215Z" fill="white"/>
<path d="M9.74742 12.6281H12.8402V22H9.74742V12.6281Z" fill="white"/>
<path d="M17.8196 12.6281H14.7268V22H17.8196C17.8196 22 17.8196 19.0496 17.8196 17.2049C17.8196 16.0976 18.1977 14.9855 19.7062 14.9855C21.411 14.9855 21.4008 16.4345 21.3928 17.5571C21.3824 19.0244 21.4072 20.5219 21.4072 22H24.5V17.0537C24.4738 13.8954 23.6508 12.4401 20.9433 12.4401C19.3354 12.4401 18.3387 13.1701 17.8196 13.8305V12.6281Z" fill="white"/>
</svg>
';
        ?>
        <div class="container podcast-content">
            <!-- Left Side with Floating Label Input -->
            <div class="left-side">
                <div class="floating-label">
                    <h1 class="title">In this episode</h1>
                    <p class="podcast-desc"><?php echo $settings['description']; ?></p>


                </div>
<!--                <div class="expert-infoTime" >-->
<!--                    <p class="infoTime"> <span>00:01 - 02:00</span> <span> - </span> answer for the question  </p>-->
<!--                    <p class="infoTime"> <span>00:01 - 02:00</span> <span> - </span> answer for the question  </p>-->
<!--                    <p class="infoTime"> <span>00:01 - 02:00</span> <span> - </span> answer for the question  </p>-->
<!--                </div>-->
            </div>

            <!-- Right Side Input -->
            <div class="right-side">
                <div class = "About">
                    <h1 class="AboutTitle"><?php echo $settings['author_name']; ?></h1>
                    <p class="AboutExpert-info"><?php echo $settings['expert_info']; ?></p>
                    <p class="AboutExpert-info">Follow me:</p>
                    <div class="social-icons">
						<a href="<?php echo $settings['linkedin_link']['url']; ?>" target="_blank" class="icon">
							<?php echo $linkedin ; ?>
						</a>
                        <a href="<?php echo $settings['twitter_link']['url']; ?>" target="_blank" class="icon">
							<?php echo $twitter ; ?>
						</a>

                    </div>
<!--                    <p class="AboutSocial">Add more Social Networks </p>-->
                </div>
                <div class ="lister-episode">
                    <span class="listen-text">Listen to full episode:</span>
                    <span class="episode-title"><?php echo $settings['audio_title']; ?></span>

                    <div class="audio-player">
                        <div class="progress-bar">
                            <div id="ap2-progress" class="progress"></div>
                        </div>
                        <div class="time-info">
                            <span class="time-left" id="ap2-lefttimeRemaining">00:00</span>
                            <span class="time-right" id="ap2-righttotalDuration">00:00</span>
                        </div>
                        <div class="playBtnID">
<!--                            <span id="playBtn" class="dashicons dashicons-controls-play"></span>-->
                            <span id="playBtn" class="play-btn2"></span>

<!--                            <img src="img/PlayButton.png" alt="play" class="playBtn">-->
                        </div>
                        <audio id="audioPlayer2" src="<?php echo $settings['audio_link']['url']; ?>"></audio>

                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
