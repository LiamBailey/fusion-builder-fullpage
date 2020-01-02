<?php
/**
 * Plugin Name: Woo Siteorigin Fullpage
 * Description: Makes fullpage.js work with Siteorigin theme
 * Author: Webby Scots (Liam Bailey)
 * Author URI: https://webbyscots.com/
 */

add_action('wp_enqueue_scripts', 'wswp_enqueue');

function wswp_enqueue() {
    wp_enqueue_style('fullpage_css', plugins_url('js/fullpage.css', __FILE__));
    wp_register_script('fullpage_js', plugins_url('js/fullpage.js', __FILE__), array('jquery'));
    wp_enqueue_script('wswp_script', plugins_url('js/script.js', __FILE__), array('fullpage_js'));
    wp_enqueue_style('wswp_style', plugins_url('css/style.css',__FILE__));
}


add_filter('siteorigin_panels_before_content', 'wswp_panels_before_content', 100, 1);

function wswp_panels_before_content() {
    global $post;
    if (is_page('hem') || is_page('hem2')) {
        return '<ul id="menu">
        <li data-menuanchor="firstPage"><a href="#firstPage">First slide</a></li>
        <li data-menuanchor="secondPage"><a href="#secondPage">Second slide</a></li>
        <li data-menuanchor="3rdPage"><a href="#3rdPage">Third slide</a></li>
    </ul>
    <div id="fullpage">';
    }
}

add_filter('siteorigin_panels_after_content', 'wswp_panels_after_content', 100, 1);

function wswp_panels_after_content() {
    if (is_page('hem') || is_page('hem2')) {
        return "</div>";
    }
}

add_filter('siteorigin_panels_row_classes', 'wswp_add_classes', 200, 2);

function wswp_add_classes($classes, $data) {
    if (is_page('hem2')) {
      array_push($classes, 'section');
    }
    return $classes;
}

add_filter('siteorigin_panels_row_attributes', 'wswp_add_id', 200, 2);

function wswp_add_id($atts, $data) {
    static $counter = 0;
    if (is_page('hem2')) {
        $atts['id'] = "section{$counter}";
        $counter++;
    }
    return $atts;
}