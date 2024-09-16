<?php
namespace ElementorHelloWorld\Widgets;


use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Podcast_List_Card extends Widget_Base{
    public function get_name() {
        return 'podcast-list-card';
    }

    public function get_title() {
        return __( 'Podcast List Card', 'elementor-hello-world' );
    }
    public function get_icon() {
        return 'eicon-posts-ticker';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'related-podcast-js','takeaway-expander' ];
    }
    public function get_style_depends() {
        return [ 'podcast-nav','podcast-list-hero' ];
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
            'podcast_id',
            [
                'label' => __( 'Enter a Number', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'number', // Make it a number input
                'default' => '10', // Set a default value if needed
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = Plugin::instance()->documents->get( get_the_ID() );
        $post = $settings['podcast_id'];
        global $wp_query;
        $posts = $wp_query->posts;
        do_action( 'qm/debug', $id);
//        do_action( 'qm/debug', $wp_query);

        ?>
        <article class="cardbg1">
            <div class="title">
                <h2> <?php echo the_title(); ?>Understanding the brain shows who we are as leaders</h2>
            </div>
            <div class="body">
                <div class="media">
                    <img src="<?php echo $face1; ?>" alt="Item 1 Image" class="profile_image_cart">
                    <div class="MainTakewayName">
                        Noah Pierre
                    </div>
                    <div class="founder">
                        Founder of Queue
                    </div>
                </div>
                <div class="text">
                    <p>Main Takeaways <span class="takeaway-icon">icon</span></p>
                    <ol class="takeaway-list">
                        <li>
                            Ready to be passionately expressed to bring us closer together.
                        </li>
                        <li>
                            The impact on their relationship and how they are still talking about it so often, even months later.
                        </li>
                        <li>
                            From landing in our space, to our workshops, the opening show and the many performances you'll encounter, everything is part of the story.
                        </li>
                    </ol>
                </div>
            </div>
            <div class="footer">
                <div class="button-group">
                    <button class="outlined-btn">
                        Share
                    </button>

                    <button class="filled-btn">
                        Learn More
                    </button>
                </div>
            </div>


        </article>

        <?php
    }
}


