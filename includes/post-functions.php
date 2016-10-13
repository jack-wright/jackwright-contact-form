<?php

function form_submission() {
        
        global $wpdb;
        // if the submit button is clicked, send the email
        if ( isset( $_POST['cf-submitted'] ) ) {

        $post = get_page_by_path($slug, OBJECT, $type);
        $page = get_permalink($post->ID);

        // sanitize form values
        $name    = sanitize_text_field( $_POST["cf-name"] );
        $email   = sanitize_email( $_POST["cf-email"] );
        if(isset($_POST["cf-tel"])){
            $tel = sanitize_text_field( $_POST["cf-tel"] );
        } else {
            $tel = 'N/A';
        }
           $message = esc_textarea( $_POST["cf-message"] );

        // get the blog administrator's email address
        $to = get_option( 'admin_email' );
        $headers = "From: $name <$email>" . "\r\n";
        //Set a subject for the email that comes through
        $subject = 'Message from the website';
        
        // If email has been process for sending, display a success message
        if ( wp_mail( $to, $subject, $message, $headers ) ) {
            wp_deregister_script( 'jquery' ); // deregisters the  current jQuery so that we are queueing the scripts in the right order
            wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"), false);
            wp_enqueue_script('jquery');
           wp_register_script('custom-alert', ("//digitalvibrancy.com/wp-content/plugins/jackwright-contact-form-master/assets/js/alerts.js?ver=4.6.1"),false);
            wp_enqueue_script('custom-alert');
        } else {
            echo 'An unexpected error occurred';
        }

        //Insert the message into the database
        $wpdb->insert('wp_jackwright_messages', array(
            'name_vchr' =>$name,
            'tel_vchr' => $tel,
            'email_vchr' => $email,
            'message_vchr' => $message,
            'page_vchr' => $page,
            'timestamp_ts' => $now
        ));

       
    }
}
