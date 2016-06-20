<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
The following code was done only because CodeShip does not allow Apache configuration and so our app subdomain files need to load as if they're part of the front-end. In CodeShip, the path will be 127.0.0.1:8000/add-campaign instead of app.mondovo.org/add-campaign
 */

// Api Routes
Route::group(['domain' => env('API_DOMAIN_NAME'), 'name'=>'Api', 'namespace' => 'Api'], function()
{
    require "Routes/api.routes.php";
});

Route::group(['domain' => env('APP_DOMAIN_NAME'), 'name'=>'App', 'namespace' => 'App'], function()
{
    require "Routes/app.main.routes.php";
});