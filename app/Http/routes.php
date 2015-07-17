<?php
use App\Tag;
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
        return view('pages.home');
    }
}); 

//Management page
Route::get('/manage', function(){
    if(Auth::user()->hasRole('Manager')){
        $tags = Tag::all();    
        return view('pages.manage', compact('tags'));
    } else {
        return view('pages.home')->with('alert', 'You do not have permission to manage these pages.');
    }
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// User routes...
Route::model('users', 'User');
Route::get('users', array('as' => 'users.route', 'uses' => 'User\UserController@index'));
Route::get('users/index/sort', 'User\UserController@indexSort');

Route::get('users/myProfile', 'User\UserController@showMyProfile');
Route::get('users/{id}/edit', 'User\UserController@edit');
Route::get('users/{id}', 'User\UserController@showProfile');
Route::patch('users/{id}/update', array('as' => 'users.update', 'uses' =>'User\UserController@update'));

Route::resource('ratings/{id}/create', 'Rating\RatingController@create');
Route::resource('ratings/store', 'Rating\RatingController@store');


/*Route::bind('users', function($value, $route) {
    return App\User::whereSlug($value)->get();
});*/

// jobs
Route::model('jobs', 'Job');
Route::resource('jobs', 'Job\JobController', ['only'=> ['index','create','store']]);
Route::get('jobs/{id}/edit', 'Job\JobController@edit');
Route::delete('jobs/{id}', 'Job\JobController@destroy');
Route::patch('jobs/{id}/update', array('as' => 'jobs.update', 'uses' =>'Job\JobController@update'));

Route::get('jobs/{id}', 'Job\JobController@show');

Route::resource('bids/{id}/create', 'Bid\BidController@create');
Route::resource('bids/{bidid}-{userid}-{jobid}/edit', 'Bid\BidController@edit');
Route::resource('bids/store', 'Bid\BidController@store');

/*Route::bind('jobs', function($value, $route) {
    return App\Job::whereSlug($value)->get();
});*/

//tags
Route::model('tags', 'Tag');
Route::delete('tags/{tag}', 'Tag\TagController@destroy', ['only'=>['create','store','destroy']]);
Route::resource('tags', 'Tag\TagController');

//messages
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'Message\MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'Message\MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'Message\MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'Message\MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'Message\MessagesController@update']);
});



