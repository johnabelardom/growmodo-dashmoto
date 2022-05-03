<?php
/**
* Plugin Name: Login / Signup Plugin (Dashmoto)
* Plugin URI: https://growmodo.dev/plugins/login-signup
* Description: Login and Signup Form system specifically made for Dashmoto with the integration of WooCommerce
* Version: 1.0
* Author: Growmodo
* Author URI: http://growmodo.dev/
**/

define('__LS_WC_FILE__', __FILE__);

// Login Form Shortcode
add_shortcode( 'ls_wc_login_form', 'ls_wc_login_form__function' );
    
function ls_wc_login_form__function() {
    if ( is_admin() ) return;
    if ( is_user_logged_in() ) return;
    ob_start();

    require_once "public/templates/assets.php";
    require "public/templates/login.php";

    return ob_get_clean();
}

// Login Ajax
add_action('wp_ajax_nopriv_ls_wc_login', 'ls_wc_login');

function ls_wc_login() {
    /* Automatically log in the user and redirect the user to the home page */
    $creds = array(
        "user_login" => $username,
        "user_password" => $password,
        "remember" => true
    );

    $signon = wp_signon($creds); 

    if ($signon) {
        $ajax_handler->add_response_data( 'redirect_url', get_home_url() );
    }

    wp_die(); // this is required to terminate immediately and return a proper response
}


// Signup Form Shortcode
add_shortcode( 'ls_wc_register_form', 'ls_wc_register_form__function' );
    
function ls_wc_register_form__function() {
    if ( is_admin() ) return;
    if ( is_user_logged_in() ) return;
    ob_start();

    require_once "public/templates/assets.php";
    require "public/templates/register.php";

    return ob_get_clean();
}

// Signup Ajax
add_action( 'wp_ajax_nopriv_ls_wc_register', 'ls_wc_register' );

function ls_wc_register() {
    if (! $_SERVER['REQUEST_METHOD'] == 'POST') {
        wp_send_json_error([
            'message' => 'Method not Allowed',
        ], 405);
        wp_die(); return;
    }
    
    $defaults = array(
        'username' => '',
        'email' => '',
        'password' => '',
    );
    $args = wp_parse_args( $_REQUEST, $defaults );

    if (! check_required_args($_REQUEST, array_keys($defaults))) {
        wp_send_json_error([
            'message' => 'Missing required parameters.',
        ], 400);
        wp_die(); return;
    }

    $user = wp_create_user($args['username'], $args['password'], $args['email']); 

    if (is_wp_error($user)){ 
        // $ajax_handler->add_error_message("Failed to create new user: ".$user->get_error_message()); 
        // $ajax_handler->is_success = false;
        // return;

        wp_send_json_error([
            'message' =>  $user->get_error_message(),
        ], 400);
        wp_die(); return;
    } else {
        wp_send_json_success([
            'message' => 'Account successfully created!',
        ], 200);
        wp_die(); return;
    }

    // Assign Primary field value in the created user profile
    // $first_name   =$form_data["First Name"]; 
    // $last_name    =$form_data["Last Name"];
    // wp_update_user(array("ID"=>$user,"first_name"=>$first_name,"last_name"=>$last_name)); 

    // Assign Additional added field value in the created user profile
    // $user_phone   =$form_data["First Name"]; 
    // $user_bio     =$form_data["Last Name"];
    // update_user_meta($user, 'user_phone', $user_phone);    
    // update_user_meta($user, 'user_bio', $user_bio); 

    
}

function check_required_args($haystack, $needles) {
    foreach ($needles as $n => $needle) {
        if (empty($haystack[$needle])) {
            return false;
        }
    }

    return true;
}