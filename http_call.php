<?php
/*
Plugin Name: WP HTTP CALL
Plugin URI: https://shamskhan.xyz
Description: simple plugin that retrieves data from a remote API endpoint
Author: Shams Khan
Version: 1.0.0
Author URI: https://shamskhan.xyz
*/

// Exit if accessed directly
if( !defined('ABSPATH'))
{
    exit; 
}

function call_the_api(){
    //calling the api
    $url = "https://fakestoreapi.com/products";
    $argument = array(
        'method' => 'GET',
        'timeout' => 120
    );
    $response = wp_remote_get(esc_url_raw($url, $argument));
    if(is_wp_error($response)){
        echo 'An internal error has occured';
        return;
    }
    //parsed from json objects
    $data = json_decode(wp_remote_retrieve_body($response), true);

    $code = wp_remote_retrieve_response_code($data);

    if( 200 !== wp_remote_retrieve_response_code($code)){
        echo 'An https error has occured';
        return;
    }

    echo '<div>';
    foreach($data as $product){
        echo '<h3>' . $product->title . '</h3>';
        echo '<p>' . $product->price . '</p>';
    }
    echo '</div>';
 	
}
add_shortcode('http-call', 'call_the_api');




