<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', function() {
    return Redirect::guest('login');
});

Route::any('home', array('before' => 'auth', 'as' => 'home', function() {
    return View::make('home');
}));

Route::get('login', array('as' => 'login', 'uses' => 'UserController@getLogin'));
Route::post('login', array('before' => 'auth.validate', 'uses' => 'UserController@login'));

Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));

Route::model('job', 'Job');
Route::model('user', 'User');

Route::resource('job', 'JobController');
Route::resource('user', 'UserController');
