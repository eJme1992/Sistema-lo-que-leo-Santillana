<?php

/**
 * @package WordPress
 * @subpackage ID-Peru-Theme-Wordpress
 * @since HTML5 ID 2.0
 */
// Options Framework (https://github.com/devinsays/options-framework-plugin)
if (!function_exists('optionsframework_init')) {
    define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/');
    require_once dirname(__FILE__) . '/_/inc/options-framework.php';
}

// Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
function html5reset_setup() {
    load_theme_textdomain('html5reset', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('structured-post-formats', array('link', 'video'));
    add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status'));
    register_nav_menu('primary', __('Navigation Menu', 'html5reset'));
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'html5reset_setup');

// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
function html5reset_scripts_styles() {
    global $wp_styles;

    // Load Comments
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    // Load Stylesheets
//		wp_enqueue_style( 'html5reset-reset', get_template_directory_uri() . '/reset.css' );
//		wp_enqueue_style( 'html5reset-style', get_stylesheet_uri() );
    // Load IE Stylesheet.
//		wp_enqueue_style( 'html5reset-ie', get_template_directory_uri() . '/css/ie.css', array( 'html5reset-style' ), '20130213' );
//		$wp_styles->add_data( 'html5reset-ie', 'conditional', 'lt IE 9' );
    // Modernizr
    // This is an un-minified, complete version of Modernizr. Before you move to production, you should generate a custom build that only has the detects you need.
    // wp_enqueue_script( 'html5reset-modernizr', get_template_directory_uri() . '/_/js/modernizr-2.6.2.dev.js' );
}

add_action('wp_enqueue_scripts', 'html5reset_scripts_styles');

// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
function html5reset_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed())
        return $title;

//		 Add the site name.
    $title .= get_bloginfo('name');

//		 Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";

//		 Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'html5reset'), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'html5reset_wp_title', 10, 2);




//OLD STUFF BELOW
// Load jQuery
if (!function_exists('core_mods')) {

    function core_mods() {
        if (!is_admin()) {
            wp_deregister_script('jquery');
            wp_register_script( 'jquery', ( "http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ), false);
            wp_enqueue_script('jquery');
        }
    }

    add_action('wp_enqueue_scripts', 'core_mods');
}

// Clean up the <head>, if you so desire.
//	function removeHeadLinks() {
//    	remove_action('wp_head', 'rsd_link');
//    	remove_action('wp_head', 'wlwmanifest_link');
//    }
//    add_action('init', 'removeHeadLinks');
// Custom Menu
//register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );
register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'id-theme'),
            'main-mobile' => 'Mobile Main Menu',
            'footer_one' => 'Footer Menu One',
            'footer_two' => 'Footer Menu Two',
            'footer_three' => 'Footer Menu Three'
        )
);

// Widgets
if (function_exists('register_sidebar')) {

    function html5reset_widgets_init() {
        register_sidebar(array(
            'name' => __('Sidebar Widgets', 'html5reset'),
            'id' => 'sidebar-primary',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }

    add_action('widgets_init', 'html5reset_widgets_init');
}

// Navigation - update coming from twentythirteen
function post_navigation() {
    echo '<div class="navigation">';
    echo '	<div class="next-posts">' . get_next_posts_link('&laquo; Older Entries') . '</div>';
    echo '	<div class="prev-posts">' . get_previous_posts_link('Newer Entries &raquo;') . '</div>';
    echo '</div>';
}

// Posted On
function posted_on() {
    printf(__('<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', ''), esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_author())
    );
}

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

function cubiq_setup() {
    remove_action('wp_head', 'wp_generator');                // #1
    remove_action('wp_head', 'wlwmanifest_link');            // #2
    remove_action('wp_head', 'rsd_link');                    // #3
    remove_action('wp_head', 'wp_shortlink_wp_head');        // #4

    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);    // #5

    add_filter('emoji_svg_url', '__return_false');
    add_filter('the_generator', '__return_false');            // #6
    add_filter('show_admin_bar', '__return_false');            // #7
    add_filter('feed_links_show_posts_feed', '__return_false');
    add_filter('feed_links_show_comments_feed', '__return_false');

    remove_action('wp_head', 'print_emoji_detection_script', 7);  // #8
    remove_action('wp_print_styles', 'print_emoji_styles');
}

add_action('after_setup_theme', 'cubiq_setup');


//* Mi funcion //

add_action('admin_menu', 'custom_fields_video');

function custom_fields_video() {
    add_meta_box('video', 'Url del video', 'fn_video', 'post', 'normal', 'high');
}

function fn_video() {
    global $wpdb, $post;
    $value = get_post_meta($post->ID, video, true);
    echo '<label for="image_es">Video</label>
    <input type="text" name="video" id="video" value="' . htmlspecialchars($value) . '" style="width: 100px;" /> ;';
}

add_action('publish_post', 'save_video');

function save_video() {
    global $wpdb, $post;
    if (!$post_id)
        $post_id = $_POST['post_ID'];
    if (!$post_id)
        return $post;
    $video = $_POST['video'];
    update_post_meta($post_id, 'video', $video);
}

?>
