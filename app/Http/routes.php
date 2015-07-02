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

Route::get('/home', function(){
    if(Auth::check()){
        $name = Auth::user()->name;
        return redirect('users/myProfile');
    }else {
        return view('home');
    }
}); 

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::model('users', 'User');
//Route::get('users', array('as' => 'users.route', 'uses' => 'User\UserController@index'));
Route::get('users/index', 'User\UserController@index');
Route::get('users/myProfile', 'User\UserController@showMyProfile');
Route::get('users/{username}', 'User\UserController@profile');
//Route::resource('users', 'User\UserController');

Route::bind('users', function($value, $route) {
    return App\User::whereSlug($value)->get();
});
