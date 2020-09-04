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

Route::get('/', function () {
    return view('welcome');
});



/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';

Route::post('/register',[
    'as' => 'register',
    'uses' => 'RegisterController@registerParticipant'
]);

Route::get('/thankyou',[
    'as' => 'thankyou',
    'uses' => 'RegisterController@thankYou'
]);

Route::get('/prizes',[
    'as' => 'prizes',
    'uses' => 'HomeController@prizes'
]);

Route::get('/rules',[
    'as' => 'rules',
    'uses' => 'HomeController@rules'
]);

Route::get('/winners',[
    'as' => 'winners',
    'uses' => 'HomeController@winners'
]);

Route::get('/exportp',[
    'as' => 'exportp',
    'uses' => 'ExportController@exportp'
]);