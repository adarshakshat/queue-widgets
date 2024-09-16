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
        return __( 'Podcast List', 'queue-widgets' );
    }
    public function get_icon() {
        return 'eicon-posts-ticker';
    }
    public function get_categories() {
        return [ 'general' ];
    }
    public function get_script_depends() {
        return [ 'takeaway-expander','podcast-list-js','search','podcast-list-player' ];
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
        $play_btn2 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/blue_play.svg' );
        $pause_btn2 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/blue_pause.svg' );

        ?>

        <style>

            .audio-controls{
                display:block;
                width: 50px;
                height: 50px; /* Adjust height as needed */
                background-size: contain; /* Ensure the image covers the entire container */
                background-position: center; /* Center the image */
                background-repeat: no-repeat; /* Prevent image from repeating */
                position:relative;
                bottom:50px;
            }
            .audio-controls.play {
                background-image: url('<?php echo $play_btn2; ?>'); /* Add your image URL here */

            }
            .audio-controls.pause {
                background-image: url('<?php echo $pause_btn2; ?>'); /* Add your image URL here */
            }
            .bg1::after {
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
            .bg2::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('<?php echo $bg2; ?>') no-repeat center center; /* Add your image URL here */
                background-size: cover; /* Ensures the image covers the entire container */
                z-index: -1; /* Ensures the background stays behind the content */
                opacity: 0.5; /* Optional: adjust the opacity to create a blend effect */
                pointer-events: none; /* Prevent interaction with the pseudo-element */
            }
            .bg1::after {
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
            .bg2::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('<?php echo $bg2; ?>') no-repeat center center; /* Add your image URL here */
                background-size: cover; /* Ensures the image covers the entire container */
                z-index: -1; /* Ensures the background stays behind the content */
                opacity: 0.5; /* Optional: adjust the opacity to create a blend effect */
                pointer-events: none; /* Prevent interaction with the pseudo-element */
            }
        </style>
        <?php
        $podcasts_list = null;
        $play_icon = '
<svg width="61" height="61" viewBox="0 0 61 61" fill="none" xmlns="http://www.w3.org/2000/svg">
<g filter="url(#filter0_b_271_1976)">
<path d="M61 30.5C61 47.3447 47.3447 61 30.5 61C13.6553 61 0 47.3447 0 30.5C0 13.6553 13.6553 0 30.5 0C47.3447 0 61 13.6553 61 30.5Z" fill="#0E24D6"/>
<path d="M42.8906 28.9018C44.1615 29.6121 44.1615 31.3879 42.8906 32.0982L25.7344 41.6875C24.4635 42.3978 22.875 41.5099 22.875 40.0893L22.875 20.9107C22.875 19.4901 24.4635 18.6022 25.7344 19.3125L42.8906 28.9018Z" fill="white"/>
</g>
<defs>
<filter id="filter0_b_271_1976" x="-16" y="-16" width="93" height="93" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feGaussianBlur in="BackgroundImageFix" stdDeviation="8"/>
<feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_271_1976"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_271_1976" result="shape"/>
</filter>
</defs>
</svg>
';
        $pause_icon = '
<svg width="61" height="61" viewBox="0 0 61 61" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_283_2310)">
<path d="M30.5 0C13.664 0 0 13.664 0 30.5C0 47.336 13.664 61 30.5 61C47.336 61 61 47.336 61 30.5C61 13.664 47.336 0 30.5 0ZM27.45 42.7H21.35V18.3H27.45V42.7ZM39.65 42.7H33.55V18.3H39.65V42.7Z" fill="#0E24D6"/>
</g>
<defs>
<clipPath id="clip0_283_2310">
<rect width="61" height="61" fill="white"/>
</clipPath>
</defs>
</svg>
';
        $prev_icon ='
<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.8334 10H4.16675M4.16675 10L10.0001 15.8333M4.16675 10L10.0001 4.16666" stroke="#667085" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
';

        $next_icon = '
<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.1665 10H15.8332M15.8332 10L9.99984 4.16666M15.8332 10L9.99984 15.8333" stroke="#667085" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
';
        $remove_option_icon = '
<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM15 13.59L13.59 15L10 11.41L6.41 15L5 13.59L8.59 10L5 6.41L6.41 5L10 8.59L13.59 5L15 6.41L11.41 10L15 13.59Z" fill="black" fill-opacity="0.23"/>
</svg>
';

        $closeBtn_icon = '
<svg id="filter-content-close" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="black"/>
</svg>
';

        $chevron_down ='
<svg class="takeaway-icon" width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 1.86914L7 7.86914L13 1.86914" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
';
        $share_icon = '
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V12M16 6L12 2M12 2L8 6M12 2V15" stroke="#0E24D6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
';
        $face1 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/AvatarImage.png' );
        $search_icon ='
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="black" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
';
        $filter_icon = '
<svg id="filter-button-svg" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M22 3H2L10 12.46V19L14 21V12.46L22 3Z" stroke="black" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
';
        $search = isset( $_GET['s'] ) ? sanitize_text_field( $_GET['s'] ) : false;
        if($search){
            while ( have_posts() ) : the_post();
                echo the_title() . '<br>';
                ?>
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/').'podcast'); ?>">
                    <label>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr__('Search Posts...', 'queue-widgets'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit"><?php echo esc_attr__('Search', 'queue-widgets'); ?>
                    <?php echo $search_icon; ?></button>
                </form>
            <?php endwhile;
        }

        else{?>
                <div class="pd-hero">
                    <h1 class="title">All Expert Podcasts</h1>

                    <?php
                    $images = [
                        [
                            'src' => QU_ASSETS_URL. 'img/group1.png',
                            'alt' => 'Expert 1'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/group2.png',
                            'alt' => 'Expert 2'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/group3.png',
                            'alt' => 'Expert 3'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/group4.png',
                            'alt' => 'Expert 4'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/group5.png',
                            'alt' => 'Expert 5'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/group6.png',
                            'alt' => 'Expert 6'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/Avatar Image-7.png',
                            'alt' => 'Expert 6'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/Avatar Image-8.png',
                            'alt' => 'Expert 6'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/Avatar Image-9.png',
                            'alt' => 'Expert 6'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/Avatar Image-10.png',
                            'alt' => 'Expert 6'
                        ],
                        [
                            'src' => QU_ASSETS_URL. 'img/Avatar Image-11.png',
                            'alt' => 'Expert 6'
                        ]
                    ];
                    ?>

                    <div class="images-group">
                        <?php foreach ($images as $image): ?>
                            <img src="<?php echo esc_url($image['src']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                        <?php endforeach; ?>
                    </div>
                    <p class="description">
                        Real expert interviews with Jessica, sharing their experience and knowledge. <br>
                        These interviews are driven by genuine human intelligence!
                    </p>
                </div>

            <div class="podcast-search">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/').'podcast'); ?>">

                    <div class="search-form">
                        <input id="podcast-search" type="search" class="search-field" placeholder="<?php echo esc_attr__('Search Posts...', 'queue-widgets'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="search-submit">
<!--                                --><?php //echo esc_attr__('Search', 'queue-widgets'); ?>
                                <?php echo $search_icon; ?>

                        </button>

                    </div>

                    <div class="search-filters">
                        <div class="filter-button" id="filter-button">
                            <p>Filter</p>
                            <?php echo $filter_icon; ?>
                            <div class="filter-popup" id="filter-popup">
                                <div class="filter-header">
                                    <span id="close-filter"><?php echo $closeBtn_icon; ?></span>
                                    <p>Filter By</p>
                                </div>
                                <div class="filter-content">
<!--                                    <input type="text" placeholder="Search Industries" />-->
                                    <div class="industry-wrapper">

                                        <select id="industry-select" name="tax_input[][industry]" multiple="multiple" style="width: 100%;">
                                            <!-- The options will be populated dynamically -->
                                        </select>
                                        <ul class="" id="industry-suggestion">


                                        </ul>

                                    </div>

<!--                                    <input type="text" placeholder="Search Professions" />-->
                                    <div class="profession-wrapper">
                                        <select id="profession-select" name="tax_input[][profession]" multiple="multiple" style="width: 100%;">
                                            <!-- The options will be populated dynamically -->
                                        </select>
                                        <ul class="" id="profession-suggestion">


                                        </ul>
                                    </div>

                                </div>
                                <div class="filter-btns">
                                    <div id="clear-filter">Clear All</div>
                                    <div id="apply-filter">Apply</div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
                <div class = "recommended-filter-section">
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

            <?php



            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Assuming 'industries' and 'profession' are taxonomy slugs
            $industry_filter = isset($_GET['industries']) ? $_GET['industries'] : '';
            $profession_filter = isset($_GET['profession']) ? $_GET['profession'] : '';

// Initialize the tax_query
            $tax_query = array();

// Add industry filter if it's available
            if (!empty($industry_filter)) {
                $tax_query[] = array(
                    'taxonomy' => 'industry',
                    'field'    => 'slug',
                    'terms'    => explode(',', $industry_filter), // assuming industries are comma-separated in the URL
                    'operator' => 'IN', // Use 'AND' if you want to match all terms
                );
            }

// Add profession filter if it's available
            if (!empty($profession_filter)) {
                $tax_query[] = array(
                    'taxonomy' => 'profession',
                    'field'    => 'slug',
                    'terms'    => explode(',', $profession_filter), // assuming profession is comma-separated in the URL
                    'operator' => 'IN', // Use 'AND' if you want to match all terms
                );
            }

// Prepare the final arguments
            $args = array(
                'post_type'      => 'podcast',
                'posts_per_page' => 10,
                'post_status'    => 'publish',
                'paged'          => $paged,
            );

// Only add tax_query if there are filters
            if (!empty($tax_query)) {
                $args['tax_query'] = $tax_query;
            }

            do_action( 'qm/debug', $args );

            $query = new \WP_Query($args);
            $settings = $this->get_settings_for_display();
            $menu_item_1_url = !empty($settings['menu_item_1_link']['url']) ? esc_url($settings['menu_item_1_link']['url']) : '#';
            $menu_item_2_url = !empty($settings['menu_item_2_link']['url']) ? esc_url($settings['menu_item_2_link']['url']) : '#';
            $schedule_btn_url = !empty($settings['schedule_btn_link']['url']) ? esc_url($settings['schedule_btn_link']['url']) : '#';
            $logo_url = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/logo.png' );
            $profile_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/profile.png' );
            $radio_img = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/radio.png' );
            if ( $query->have_posts() ) {


                ?>



<?php
                echo '<ul class="archive-posts-list podcast-list">';
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $post_id = get_the_ID();
                    $podcast_image = get_the_post_thumbnail_url($post_id, 'full');
                    $podtitle_title = get_post_meta($post_id,'podcast_title',true) ;
                    $expert_name = get_post_meta($post_id,'expert_name',true) ;
                    $expert_info = get_post_meta($post_id,'expert_info',true) ;
                    $podcast_audio_url = get_post_meta($post_id,'highlight_audio_url') ;
                    $highlight_list = get_post_meta($post_id,'highlight_list') ;


                    ?>
                    <article class=" ">
                        <div class="title">
                            <h2><?php echo $podtitle_title; ?></h2>
                        </div>
                        <div class="body">
                            <div class="media">
                                <div class="player">
                                    <audio src="<?php echo $podcast_audio_url[0]; ?>"></audio>

                                    <div class="summary-progress">
                                        <img src="<?php echo $face1; ?>" alt="Item 1 Image" class="profile_image_cart">
                                        <div class="audio-controls play">
                                        </div>
                                        <p class="time-remaining"></p>
                                    </div>

                                </div>
                                <div class="expert_name">
                                    <?php echo $expert_name; ?>
                                </div>
                                <div class="founder">
                                    <?php echo $expert_info; ?>
                                </div>
                            </div>
                            <div class="text">
                                <p>Main Takeaways <span class="takeaway-icon"><?php echo $chevron_down; ?></span></p>
                                <ol class="takeaway-list">
                                    <?php foreach ($highlight_list[0] as $takeaway) : ?>
                                        <li><?php echo esc_html($takeaway); ?></li>
                                    <?php endforeach; ?>
                                    <li>
                                        <?php echo $podtitle_title; ?>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="button-group">
                                <button class="outlined-btn">
                                    <?php echo $share_icon; ?>
                                    <span>Share</span>
                                </button>


                                <button class="filled-btn">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        Learn More
                                    </a>
                                </button>
                            </div>
                        </div>
                    </article>
                <?php
                }
                echo '</ul>';

                // Pagination
                $total_pages = $query->max_num_pages;

                if ( $total_pages > 1 ) {
                    $current_page = max(1, get_query_var('paged'));
                    echo '<div class="podcast-pagination">';
                    if ($current_page > 1) {
                        // Link to the previous page
                        echo '<a class="prev page-numbers" href="' . esc_url(get_pagenum_link($current_page - 1)) . '">' . $prev_icon. 'Previous</a>';
                    } else {
                        // On the first page, point back to the first page
                        echo '<p class="prev page-numbers">'. $prev_icon.'Previous</a>';
                    }
                    echo '<div class="podcast-pagination-pages">';

                    echo paginate_links( array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => '?paged=%#%',
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_next' => false

                    ) );
                    echo '</div>';

                    if ($current_page < $total_pages) {
                        // Link to the next page
                        echo '<a class="next page-numbers" href="' . esc_url(get_pagenum_link($current_page + 1)) . '">Next '. $next_icon.' </a>';
                    }
                    elseif ($current_page = $total_pages) {
                        // Link to the next page
                        echo '<p class="next page-numbers" >Next '. $next_icon.' </a>';
                    }
                    echo '</div>';

                }

                // Reset post data
            } else {
                echo __( 'No posts found', 'queue-widgets' );
            }
            wp_reset_postdata();
        }
    }
}


