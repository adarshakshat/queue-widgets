<?php


namespace ElementorHelloWorld\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Podcast_List_Hero extends Widget_Base{
    public function get_name() {
        return 'podcast-list-hero';
    }

    public function get_title() {
        return __( 'Podcast List Hero', 'elementor-hello-world' );
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


        $this->end_controls_section();
    }

    protected function render() {
        $bg1 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/bg1.png' );
        $bg2 = esc_url( plugin_dir_url( __FILE__ ) . '../assets/img/bg2.png' );

        ?>
        <div class="pd-hero">
            <h1 class="title">All Expert Podcasts</h1>
            <p class="description">
                Real expert interviews with Jessica, sharing their experience and knowledge. <br>
                These interviews are driven by genuine human intelligence!
            </p>
            <?php
            $badge_img = esc_url( QU_ASSETS_URL . 'img/jessica.png');

            $images = [
                [
                    'src' => QU_ASSETS_URL .'img/group1.png',
                    'alt' => 'Expert 1'
                ],
                [
                    'src' => QU_ASSETS_URL .'img/group2.png',
                    'alt' => 'Expert 2'
                ],
                [
                    'src' => QU_ASSETS_URL .'img/group3.png',
                    'alt' => 'Expert 3'
                ],
                [
                    'src' => QU_ASSETS_URL .'img/group4.png',
                    'alt' => 'Expert 4'
                ],
                [
                    'src' => QU_ASSETS_URL .'img/group5.png',
                    'alt' => 'Expert 5'
                ],
                [
                    'src' => QU_ASSETS_URL .'img/group6.png',
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
        <?php
    }
}


