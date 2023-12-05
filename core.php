 <?php
/*
Plugin Name:  CSS JS & File Uploader
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: css js file uploader
Author: مصطفی نیاکان
Version: 1.0.0
License: GPLv2 or later
Author URI: http://develop-wp.local
*/

defined('ABSPATH') || exit;
define('CJF_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CJF_PLUGIN_URL', plugin_dir_url(__FILE__));
const CJF_PLUGIN_INC = CJF_PLUGIN_DIR . '_inc/';
const CJF_PLUGIN_VIEW = CJF_PLUGIN_DIR . 'view/';
const CJF_PLUGIN_ASSETS_URL = CJF_PLUGIN_URL . 'assets/';
//echo plugins_url();
function wpcjf_register_styles()
{
//    STYLE REGISTER
    // wp_register_style('main-style',CJF_PLUGIN_ASSETS_URL .'css/main-style.css','','1.0.0');
    wp_register_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css', '', '5.2.0');
    wp_register_style('main-style', plugins_url('css-jss-fileUploder/assets/css/main-style.css'), '1.0.0');
    wp_enqueue_style('bootstrap-5');
    wp_enqueue_style('main-style');

//    JS REGISTER
    if (is_admin()) {
        wp_register_script('dashboard-js', CJF_PLUGIN_ASSETS_URL . 'js/dashboard-js.js', ['jquery'], '1.0.0', '');
        wp_enqueue_script('dashboard-js');
    } else {
        wp_register_script('main-js', CJF_PLUGIN_ASSETS_URL . 'js/main-js.js', ['jquery'], '1.0.0', '');
        wp_enqueue_script('main-js');
    }
    wp_register_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js', '', '5.2.0', '');
    wp_enqueue_script('bootstrap-5-js');
}

add_action('wp_enqueue_scripts', 'wpcjf_register_styles');
add_action('admin_enqueue_scripts', 'wpcjf_register_styles');

if(is_admin()){
    include CJF_PLUGIN_INC.'admin/menus.php';


}

