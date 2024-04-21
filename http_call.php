<?php
/*
Plugin Name: WP HTTP CALL
Plugin URI: https://shamskhan.xyz
Description: simple plugin that retrieves data from a remote API endpoint
Author: Shams Khan
Version: 1.0.0
Author URI: https://shamskhan.xyz
*/

if( !defined('ABSPATH'))
{
    exit; // Exit if accessed directly
}

function call_the_api(){
    //calling the api
    $url = "https://api.github.com/users/wordpress";
    $response = wp_remote_get($url);

    echo $response;

}
add_shortcode('http-call', 'call_the_api');




