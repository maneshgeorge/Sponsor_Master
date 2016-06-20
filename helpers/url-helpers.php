<?php

function main_domain(){
    return 'http://' . env('DOMAIN_NAME');
}

function app_domain(){

    return 'http://' . env('APP_DOMAIN_NAME');

}

/**
 * Sample Input:
 * $url = http://www.google.com
 *
 * strip_protocol_from_url($url)
 *
 * Expected Output:
 * www.google.com
 *
 * @param $url
 * @return string
 */
function  strip_protocol_from_url($url)
{
    if(preg_match('/http/is', $url, $matches))
    {
        $url= str_replace('http://', '', $url);
        $url= str_replace('https://', '', $url);
        $url= str_replace('/','', $url);
    }

    return $url;
}

/**
 * sample input:
 * $url = www.google.com
 *
 * add_protocol_to_url( $url )

 * Expected Output:
 * http://www.google.com
 *
 * @param $url
 * @return string
 */
function add_protocol_to_url( $url )
{
    if( preg_match('/http/is', $url, $matches))
    {
        return $url;
    }

    return 'http://'.$url;
}


/**
 * Sample Input:
 * $url = www.google.com
 *
 * strip_www_from_url($url)
 *
 * Expected Output:
 * google.com
 *
 * @param $url
 * @return string
 */
function strip_www_from_url($url)
{
    return str_replace('www.', '', $url);
}

/**
 * Sample Input:
 * $url = google.com
 *
 * check_www_on_url($url)
 *
 * Expected Output
 * 0
 *
 * @param $url
 * @return int
 */
function check_www_on_url($url)
{
    $www_type = 1;
    $pos=strpos($url, "www.");
    if($pos===false)
        $www_type=0;

    return $www_type;
}

function get_in_url($url)
{
    $url = strip_www_from_url( $url );
    $url= str_replace('http://', '', $url);
    $url= str_replace('https://', '', $url);

    $pos = strpos($url, '/');

    if(is_bool($pos))
        return '';

    return substr($url, $pos + 1 );

}