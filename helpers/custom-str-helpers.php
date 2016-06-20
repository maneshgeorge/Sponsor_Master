<?php
/**
 * Created by PhpStorm.
 * User: Sameer
 * Date: 22-05-2015
 * Time: 13:59
 */
//Given below are some useful string helper functions that I've developed for common string operations I've had to deal with

/**
 * Extracts the string before the last mention of the character you specify. E.g. str_before_last(",","My,name,is,John") will return "My,name,is"
 * @param $character
 * @param $string
 * @return string
 */
function str_before_last($character,$string){
    return substr($string, 0, strrpos($string, "$character"));
}

/**
 * Extracts the string after the last mention of the character you specify. E.g. str_after_last(",","My,name,is,John") will return "John"
 * @param $character
 * @param $string
 * @return string
 */
function str_after_last($character,$string){
    return substr($string, strrpos($string, "$character")+1, strlen($string) );
}

/**
 * Extracts the string before the first mention of the character you specify. E.g. str_before_first(",","My,name,is,John") will return "My"
 * @param $character
 * @param $string
 * @return string
 */
function str_before_first($character,$string){
    return substr($string, 0, strpos($string, "$character"));
}

/**
 * Extracts the string after the first mention of the character you specify. E.g. str_after_first(",","My,name,is,John") will return "name,is,John"
 * @param $character
 * @param $string
 * @return string
 */
function str_after_first($character,$string){
    return substr($string, strpos($string, "$character")+1, strlen($string) );
}

/**
 * @param $strtotime_value
 * @return string
 */
function custom_date_format_with_month_day_year_using_strtotime_value( $strtotime_value )
{
    if( empty($strtotime_value) )
    {
        return '-';
    }

    return date("M d, Y", $strtotime_value);
}

/**
 * @param $strtotime_value
 * @return string
 */
function custom_date_format_with_year_month_day_using_strtotime_value( $strtotime_value )
{
    if( empty($strtotime_value) )
    {
        return '-';
    }

    return date("Y-m-d", $strtotime_value);
}

/**
 * @param $date
 * @return string
 */
function custom_date_format_with_month_day_year( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("M d, Y", strtotime($date) );
}

/**
 * @param $date
 * @return string
 */
function custom_date_format_with_day_month_year( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("d M, Y", strtotime($date) );
}

/**
 * @param $date
 * @return string
 */
function custom_date_format_with_month_day_year_hour_minute_second( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("M d, Y H:i:s", strtotime($date) );
}

/**
 * @param $date
 * @return bool|string
 */
function custom_date_format_with_day_month_year_hour_minute_second( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("d-m-Y H:i:s", strtotime($date) );
}

function custom_date_format_with_day_month_year_hour_minute_second_comma_separated( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("d M, Y H:i:s", strtotime($date) );
}

/**
 * @param $date
 * @return bool|string
 */
function custom_date_format_with_month_day_year_hour_minute_second_in_letter( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("M-d-Y || H:i:s", strtotime($date) );
}

/**
 * @param $date
 * @param $duration
 * @return string
 */
function custom_change_in_date_format_with_month_day_year( $date, $duration )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("M d, Y", strtotime($duration, strtotime($date)));
}


/**
 * @param $date
 * @return string
 */
function custom_date_format_with_year_month_day( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return date("Y-m-d", strtotime($date) );
}

/**
 * @param $date
 * @return bool|string
 */
function custom_date_format_with_year_month_day_for_baf( $date )
{
    if( empty($date) || $date == "0000-00-00 00:00:00")
    {
        return '-';
    }

    return [ date('Y', strtotime($date) ),
        date('m', strtotime($date) ),
        date('d', strtotime($date) )
            ];
}

/**
 * @return bool|string
 */
function custom_date_format_with_year_month_day_plus_twenty_for_hours()
{
    return date("Y-m-d H:i:s", strtotime('+24 hours'));
}

/**
 * @param $date
 * @return bool|string
 */
function custom_date_format_with_year_month_day_hour_min_sec($date)
{
    if(is_int($date))
        return date("Y-m-d H:i:s", $date);

    return date("Y-m-d H:i:s", strtotime($date));
}

/**
 * @param $no_of_days
 * @return string
 */
function convert_days_into_years( $no_of_days )
{
    if( empty($no_of_days))
    {
        return '';
    }
    return $no_of_days / 365 ;
}

/**
 * @param $no_of_days
 * @return string
 */
function convert_days_into_years_months_and_days( $no_of_days )
{
    if( empty($no_of_days))
    {
        return '';
    }

    $no_of_years = intval( $no_of_days / 365) ;
    $remaining_no_of_days = $no_of_days % 365 ;
    $no_of_months = intval( $remaining_no_of_days / 30) ;
    $no_of_days = $remaining_no_of_days % 30 ;

    $final_statement = '';
    if( $no_of_years > 0)
    {
        $final_statement.= $no_of_years. ' Yr(s) ';
    }

    if( $no_of_months > 0)
    {
        $final_statement.= $no_of_months. ' month(s) ';
    }

    if( $no_of_days > 0)
    {
        $final_statement.= $no_of_days. ' day(s)';
    }

    return $final_statement;
}

function get_day_of_date($date)
{
    $timestamp = strtotime($date);
    $day = intval(date('d', $timestamp));
    return $day;
}

function get_month_of_date($date)
{
    $timestamp = strtotime($date);
    $month = intval(date('m', $timestamp));
    return $month;
}