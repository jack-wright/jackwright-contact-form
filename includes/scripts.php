<?php

//add scripts to the admin page
function jackwright_adminscripts() {
    wp_enqueue_style( 'admin-style', plugin_dir_url( __FILE__ ) . 'assets/css/admin-style.css'); 
}
//add scripts to the page that the plugin is called
function jackwright_scripts(){
    wp_enqueue_style( 'plugin-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css');
}