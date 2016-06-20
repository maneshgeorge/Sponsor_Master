<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 11-06-2016
 * Time: 12:54 PM
 */

Route::get('/', function () {
    return view('api_welcome');
});

Route::get('login', [ 'as' => 'login', 'uses' => 'LoginController@login' ]);
Route::get('get-events', [ 'as' => 'get_events', 'uses' => 'DataController@getEvents' ]);
Route::get('get-companies', [ 'as' => 'get_companies', 'uses' => 'DataController@getCompanies' ]);
Route::get('get-partners', [ 'as' => 'get_partners', 'uses' => 'DataController@getPartners' ]);
Route::get('get-employees', [ 'as' => 'get_partners', 'uses' => 'DataController@getEmployees' ]);