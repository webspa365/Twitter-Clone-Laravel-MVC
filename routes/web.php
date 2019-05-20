<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// auth
Auth::routes();
Route::get('/', function () {return view('auth/auth', ['form' => '']);});
Route::get('/signUp', function () {return view('auth/auth', ['form' => 'signUp']);});
Route::get('/logIn', function () {return view('auth/auth', ['form' => 'logIn']);});
Route::get('/logout', function() {
  Auth::logout();
  return view('auth/auth', ['form' => '']);
});

// navigations
//Route::get('/home', function() {return view('home/home');});
Route::get('/home', 'TimelineController@get_timeline');
Route::get('/moments', function() {return view('moments');});
Route::get('/notifications', function() {return view('notifications');});
Route::get('/messages', function() {return view('messages');});

// UserController
Route::resource('users', 'UserController');

// profile
//Route::get('/profile', function() {return view('profile/profile');});
Route::get('/profile/tweets/{un}', 'ProfileController@get_tweets');
Route::get('/profile/following/{un}', 'ProfileController@get_following');
Route::get('/profile/followers/{un}', 'ProfileController@get_followers');
Route::get('/profile/likes/{un}', 'ProfileController@get_likes');
Route::get('/profile/edit/{un}', function() {return view('profile/editProfile');});
Route::post('/profile/edit/{un}', 'UserController@update');

// TweetController
Route::resource('tweets', 'TweetController');

// LikeController
Route::resource('likes', 'LikeController');

// RetweetController
Route::resource('retweets', 'RetweetController');

// RelationshipController
Route::resource('relationships', 'RelationshipController');

// ReplyController
Route::resource('replies', 'ReplyController');
Route::get('replies', 'ReplyController@replies');
