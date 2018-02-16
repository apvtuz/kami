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

Route::get('/', function () {
    return view('landing')->with('header','Home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'HomeController@index');
Route::get('/profile', 'ProfileController@index');
Route::get('/posts', 'PostsController@index');
Route::get('/post/create',      'PostsController@create');
Route::get('/post/{id}/edit',   'PostsController@edit');
Route::get('/post/{id}/publish',   'PostsController@publish');
Route::get('/post/{id}/people',   'PostsController@people');
Route::get('/preference',   'PreferenceController@index');
Route::get('/profile_page/{id}',   'HomeController@profile_page');
Route::get('/projects',   'PostsController@projects');
Route::get('/favorites',  'HomeController@favorite');
Route::get('/post/{id}/view',  'HomeController@view');
Route::get('/post/{id}/slots',   'PostsController@slots');
Route::post('/profile', 'ProfileController@update_user');
Route::post('/post/create',     'PostsController@onCreate');
Route::post('/post/{id}/edit',  'PostsController@onEdit');
Route::post('/post/delete','PostsController@delete');
Route::post('/post/record','PostsController@record');
Route::post('/post/{id}/people',   'PostsController@people_change');
Route::post('/preference',   'PreferenceController@update_user');
Route::post('/post/favorite',  'PostsController@favorite');
Route::post('/post/add_age',  'PostsController@add_age');
Route::post('/post/get_slots',  'PostsController@get_slots');
Route::post('/post/remove_slot',  'PostsController@remove_slot');
Route::post('/post/remove_all_slots',  'PostsController@remove_all_slots');
Route::post('/post/show_slots',  'PostsController@show_slots');
Route::post('/post/select_slot',  'PostsController@select_slot');
Route::post('/post/change_slot',  'PostsController@change_slot');


