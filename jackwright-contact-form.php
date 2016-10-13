<?php
/**
 * Plugin Name: Jack Wright Contact Form
 * Plugin URI: http://jt-wright.co.uk
 * Description: A simple contact form plugin for wordpress. View
 * Version: 1.0.0
 * Author: Jack Wright
 * Author URI: http://jt-wright.co.uk
 * License: GPL2
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

require_once (plugin_dir_path( __FILE__ ) .'includes/admin-functions.php');
require_once (plugin_dir_path( __FILE__ ) .'includes/post-functions.php');

//define constants
$table_name = $wpdb->prefix . 'jackwright_messages';

add_action( 'admin_enqueue_scripts', 'jackwright_adminscripts' );
add_action( 'wp_enqueue_scripts', 'jackwright_scripts' );
register_activation_hook( __FILE__, 'jackwright_create_table' );
add_shortcode( 'jackwright_contact_form', 'jackwright_shortcode' );
add_action('admin_menu', 'jackwright_menu');
add_action( 'admin_init', 'jackwright_settings' );

//add scripts to the admin page
function jackwright_adminscripts() {
    wp_enqueue_style( 'admin-style', plugin_dir_url( __FILE__ ) . 'assets/css/admin-style.css'); 
    wp_enqueue_style( 'datatables-style', '//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css' );
    wp_enqueue_style( 'datatables-buttons', '//cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css' );
     wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery 
    wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"), false);
    wp_enqueue_script('jquery');
    wp_register_script('datatables', ("//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"), false);
    wp_enqueue_script('datatables');
    wp_register_script('datatables-buttons-js', ("//cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"), false);
    wp_enqueue_script('datatables-buttons-js');
    wp_register_script('datatables-flash', ("//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"), false);
    wp_enqueue_script('datatables-flash');
    wp_register_script('datatables-jszip', ("//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"), false);
    wp_enqueue_script('datatables-jszip');
    wp_register_script('datatables-pdf', ("//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"), false);
    wp_enqueue_script('datatables-pdf');
    wp_register_script('datatables-buttons-vfs', ("//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"), false);
    wp_enqueue_script('datatables-buttons-vfs');
    wp_register_script('datatables-html5', ("//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"), false);
    wp_enqueue_script('datatables-html5');
    wp_register_script('datatables-print', ("//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"), false);
    wp_enqueue_script('datatables-print');
    wp_register_script('app', plugins_url('assets/js/app.js', __FILE__)); 
    wp_enqueue_script('app');   
}
//add scripts to the page that the plugin is called
function jackwright_scripts(){
    wp_enqueue_style( 'plugin-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css');
    wp_enqueue_style( 'sweet-alert-css', '//cdn.jsdelivr.net/sweetalert2/5.2.1/sweetalert2.min.css' );
    wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery 
    wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"), false);
    wp_enqueue_script('jquery');
     wp_register_script('sweet-alert-js', ("//cdn.jsdelivr.net/sweetalert2/5.2.1/sweetalert2.min.js"), false);
    wp_enqueue_script('sweet-alert-js');  
}
function html_form_code() {

        echo '<div class="form-container">';
        echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post" id="jwright-contactform">';                            
        echo '<p>';
        echo '<label>Your Name (required) </label> <br />';
        echo '<input id="jw-name" required type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo '<label>Your Email (required) </label> <br />';
        echo '<input id="jw-email" required type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo '<label>Your Number </label> <br />';
        echo '<input id="jw-tel" type="tel" name="cf-tel"  value="' . ( isset( $_POST["cf-tel"] ) ? esc_attr( $_POST["cf-tel"] ) : '' ) . '" size="40" />';
        echo '</p>';
        echo '<p>';
        echo '<label>Your Message (required) </label> <br />';
        echo '<textarea id="jw-message" required rows="10" cols="35" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
        echo '</p>';
        echo '<p><input id="cf-submit" type="submit" name="cf-submitted" value="Send"/></p>';
        echo '</form>';
    echo '</div>';
}
function jackwright_shortcode() {
    ob_start();
    form_submission();
    html_form_code();
    return ob_get_clean();
}








