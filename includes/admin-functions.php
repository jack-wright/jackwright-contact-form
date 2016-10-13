<?php

function jackwright_create_table() {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'jackwright_messages';

    $sql = "CREATE TABLE $table_name (
        message_id int(9) NOT NULL AUTO_INCREMENT,
        name_vchr varchar(255) NOT NULL,
        email_vchr varchar(100) NOT NULL,
        tel_vchr varchar(20),
        message_vchr varchar(1000) NOT NULL,
        page_vchr varchar(255),
        timestamp_ts timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
       PRIMARY KEY  (message_id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function jackwright_menu() {
    $iconurl = plugin_dir_url( __FILE__ ) . '../assets/img/dashboard-icon.svg';
    add_menu_page('jackwright contact form settings', 'JW Contact form', 'administrator', 'jackwright-contactform-settings', 'jackwright_settings_page', $iconurl);
}

function jackwright_settings() {
}

function jackwright_settings_page() { 
global $wpdb;?>
  <div class="wrap">
<h2>The Jack Wright Contact Form Plugin</h2>
<p><i>The catchiest plug in name on the market</i></p>
<hr>
<h2>Adding the plugin to your page/pages</h2>
<p>To add the plugin to a page, just insert the shortcode below and away you go:</p>
<div class="shortcode-box">
    <p class="shortcode-text">[jackwright_contact_form]</p>
</div>
<hr>
<h2>Take a look at your messages</h2>
<p><i>From here you can copy to clipboard, download as csv, xls, or pdf, and also print off your message table</i></p>
    <table id="example" class="display responsive no-wrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Message</th>
                <th>Page</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php 
           // $query = $wpdb->get_results("SELECT * FROM $table_name;");
            foreach( $wpdb->get_results("SELECT * FROM wp_jackwright_messages;") as $row) {
                echo '<tr>';
                echo '<td>'.$row->message_id.'</td>';
                echo '<td>'.$row->name_vchr.'</td>';
                echo '<td>'.$row->email_vchr.'</td>';
                echo '<td>'.$row->tel_vchr.'</td>';
                echo '<td>'.$row->message_vchr.'</td>';
                echo '<td>'.$row->page_vchr.'</td>';
                echo '<td>'.$row->timestamp_ts.'</td>';
                echo '</tr>' ;  
            }

        ?>
            
        </tbody>
    </table>
</div>
<?php }