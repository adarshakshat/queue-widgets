<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Podcast_List extends Widget_Base{
    public function get_name() {
        return 'podcast-list';
    }

    public function get_title() {
        return __( 'Podcast List', 'elementor-hello-world' );
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
        return [ 'podcast-nav','podcast-list' ];
    }
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom-elementor-widgets' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $bg1 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/bg1.png' );
        $bg2 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/bg2.png' );

        ?>

<style>
/*todo remove */
        body::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('<?php echo $bg1; ?>') no-repeat center center; /* Add your image URL here */
        background-size: cover; /* Ensures the image covers the entire container */
        z-index: -1; /* Ensures the background stays behind the content */
        opacity: 0.5; /* Optional: adjust the opacity to create a blend effect */
        pointer-events: none; /* Prevent interaction with the pseudo-element */
        }
        /*::after {*/
        /*content: "";*/
        /*position: absolute;*/
        /*top: 0;*/
        /*left: 0;*/
        /*right: 0;*/
        /*bottom: 0;*/
        /*background: url('*/<?php //echo $bg2; ?>/*') no-repeat center center; /* Add your image URL here */*/
        /*background-size: cover; /* Ensures the image covers the entire container */*/
        /*z-index: -1; /* Ensures the background stays behind the content */*/
        /*opacity: 0.5; /* Optional: adjust the opacity to create a blend effect */*/
        /*pointer-events: none; /* Prevent interaction with the pseudo-element */*/
        /*}*/
</style>


        <?php

        $face1 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/face1.png' );

        $search = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : false;
        if($search){
            while ( have_posts() ) : the_post();
                echo the_title() . '<br>';
                ?>
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/').'podcast'); ?>">
                    <label>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr__('Search Posts...', 'plugin-name'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit"><?php echo esc_attr__('Search', 'plugin-name'); ?></button>
                </form>
            <?php endwhile;
        }

        else{?>
                <div class="pd-hero">
                    <h1 class="title">All Expert Podcasts</h1>
                    <p class="description">
                        Real expert interviews with Jessica, sharing their experience and knowledge. <br>
                        These interviews are driven by genuine human intelligence!
                    </p>
                    <?php
                    $images = [
                        [
                            'src' => 'img/group1.png',
                            'alt' => 'Expert 1'
                        ],
                        [
                            'src' => 'img/group2.png',
                            'alt' => 'Expert 2'
                        ],
                        [
                            'src' => 'img/group3.png',
                            'alt' => 'Expert 3'
                        ],
                        [
                            'src' => 'img/group4.png',
                            'alt' => 'Expert 4'
                        ],
                        [
                            'src' => 'img/group5.png',
                            'alt' => 'Expert 5'
                        ],
                        [
                            'src' => 'img/group6.png',
                            'alt' => 'Expert 6'
                        ]
                    ];
                    ?>

                    <div class="images-group">
                        <?php foreach ($images as $image): ?>
                            <img src="<?php echo esc_url($image['src']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
            <div class = "search">
                <div class="search-container">
                    <!-- <span class="search-text">Search</span>
                    <input type="text" class="search-input" placeholder="Type to search..." /> -->
                    <input type="text" class="search-input" value="Search" />
                    <span class="icon"><img src="img/search.png" alt="Search Icon"></span>
                </div>
                <filter class="filter-button">
                    Filter
                    <span class="filter-icon"><img src="img/filter.png" alt="Filter Icon"></span>
                </filter>

                <div id="filter-popup" class="popup">
                    <div class="popup-header">
                        <div class="filterBy-Txt">
                            Filter By
                        </div>
                        <div class="clear-all-Txt">
                            Clear all
                        </div>
                        <button class="apply-button">Apply</button>
                    </div>
                    <div class="popup-body">
                        <input type="text" class="search-industries" value="Search Industries" />
                    </div>
                    <div class="filters-buttons">
                        <button class="filters-button">Design <span class="cross-icon"><img src="img/Cancel.png" alt="Filter Icon"></span></button>
                        <button class="filters-button">Information Technology <span class="cross-icon"><img src="img/Cancel.png" alt="Filter Icon"></span></button>

                    </div>
                    <div class="popup-body">

                        <input type="text" class="search-title" value="Search title" />
                    </div>
                    <div class="filters-buttons">
                        <button class="filters-button">CEO <span class="cross-icon"><img src="img/Cancel.png" alt="Filter Icon"></span></button>
                        <button class="filters-button">COO <span class="cross-icon"><img src="img/Cancel.png" alt="Filter Icon"></span></button>
                        <button class="filters-button">Product Designer <span class="cross-icon"><img src="img/Cancel.png" alt="Filter Icon"></span></button>

                    </div>

                </div>
                <div class = "Filter-section">
                    <div class="description">
                        Most popular filters
                    </div>
                    <div class="filter_button">
                        <button>Design</button>
                        <button>Information Technology</button>
                        <button>Information Services</button>
                        <button>USA</button>
                        <button>Brasil</button>
                        <button>Portugal</button>
                        <button>CEO</button>
                        <button>COO</button>
                    </div>
                </div>
            </div>
            <div class="podcast-list ">
                <article class="cardbg2">
                    <div class="title">
                        <h2>Understanding the brain shows who we are as leaders</h2>
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
                <article class="cardbg1">
                    <div class="title">
                        <h2>Understanding the brain shows who we are as leaders</h2>
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
                <article class="cardbg3">
                    <div class="title">
                        <h2>Understanding the brain shows who we are as leaders</h2>
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
            </div>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'podcast',
                'posts_per_page' => 5, // or specify the number of posts
                'post_status' => 'publish',
                'paged' => $paged
            );
            $query = new \WP_Query($args);
            $settings = $this->get_settings_for_display();
            $menu_item_1_url = !empty($settings['menu_item_1_link']['url']) ? esc_url($settings['menu_item_1_link']['url']) : '#';
            $menu_item_2_url = !empty($settings['menu_item_2_link']['url']) ? esc_url($settings['menu_item_2_link']['url']) : '#';
            $schedule_btn_url = !empty($settings['schedule_btn_link']['url']) ? esc_url($settings['schedule_btn_link']['url']) : '#';
            $logo_url = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/logo.png' );
            $profile_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/profile.png' );
            $radio_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/radio.png' );
            if ( $query->have_posts() ) {
                echo '<ul class="archive-posts-list">';
                while ( $query->have_posts() ) {
                    $query->the_post();
                    echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                }
                echo '</ul>';

                // Pagination
                $total_pages = $query->max_num_pages;

                if ( $total_pages > 1 ) {
                    $current_page = max(1, get_query_var('paged'));

                    echo paginate_links( array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => '?paged=%#%',
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_text'    => __('« Prev'),
                        'next_text'    => __('Next »'),
                    ) );
                }

                // Reset post data
                wp_reset_postdata();
            } else {
                echo __( 'No posts found', 'plugin-name' );
            }
        }
    }
}


