<?php
/*
Plugin Name: WP HTTP CALL
Plugin URI: https://shamskhan.xyz
Description: simple plugin that retrieves data from a remote API endpoint
Author: Shams Khan
Version: 1.0.0
Author URI: https://shamskhan.xyz
*/

//Define wp-config.php 
//define( 'WP_DEBUG', true );
//define( 'WP_DEBUG_DISPLAY', false);
//define( 'WP_DEBUG_LOG', '/home3/karatekid/test.lismorekarate.com/logs/debug.' . 'date(Y-m-d)' . '.log' );

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
    $response = wp_remote_get(esc_url_raw($url), $argument);
	error_log($response, true);
    if(is_wp_error($url)){
        echo 'An internal error has occured';
		echo $response->get_error_message();
        return;
    } 
    $code = wp_remote_retrieve_response_code($response);
    if( 200 !== $code){
        echo 'An https error has occured';		
        return;
    }
    //parsed from json objects
    $data = json_decode(wp_remote_retrieve_body($response), true);
    echo '<div>';
    foreach($data as $product){
        echo '<b>' . $product['title'] . '</b>';
        echo '<p>' . $product['price'] . '</p>';
    }
    echo '</div>';

 }
add_shortcode('http-call', 'call_the_api');




