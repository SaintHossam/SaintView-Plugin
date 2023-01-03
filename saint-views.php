<?php
// Include Files
require_once (plugin_dir_path(__FILE__) .'inc/views-count-posts.php');
require_once (plugin_dir_path(__FILE__) .'inc/widget-popular-posts.php');
require_once (plugin_dir_path(__FILE__) . 'admin/admin.php');

/**
* Plugin Name:       Saint Views
* Plugin URI:        https://saintplugins.com/saint-views
* Description:       This [plugin] was created by Hossam Hamdy to view the number of views on contents and view image in [post_type].
* Version:           1.0
* Requires at least: 6.1.1
* Requires PHP:      7.2
* Author:            Hossam Hamdy
* Author URI:        https://github.com/sainthossam
* Text Domain:       saint-views
* License:           GPL v2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Update URI:        https://example.com/my-plugin/
*/


// منع اي مستخدم من ان يصل الى الأشياء التي توجد داخل المكتبة من خلال المتصفح
// Exit if accessed directly if (!defined('ABSPATH')) exit;


//if (!defined('ABSPATH')) exit;

if (!defined('ABSPATH')) {
    die("Nothing here to you!");
}


define("ASSETS_DIR", plugin_dir_url(__FILE__). 'assets');


function enqueue_files() {
    wp_enqueue_style('saint_views_css', ASSETS_DIR . '/css/saint-views.css');
	wp_enqueue_script('saint_views_js', ASSETS_DIR . '/js/saint-views.js', array('jquery') ,1,true);
}
add_action('wp_enqueue_scripts', 'enqueue_files');







