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
    $url = "https://api.github.com/users/wordpress";
    $response = wp_remote_get(esc_url_raw($url));
    //parsed from json objects
    $display_body = json_decode(wp_remote_retrieve_body($response), true);
    //print_r($display_body);
 	foreach($display_body as $key=>$value){
		echo $key . ":" . $value . "</br>";
	}
}
add_shortcode('http-call', 'call_the_api');




