<?php

use App\Http\Controllers\HomeController;

//Route::get('/', function () {return view('welcome');});

Auth::routes();

Route::get('new-post', function () {return view('post.create');})->middleware('auth');
Route::post('create-post', 'PostController@create')->middleware('auth');
Route::get('list-post', 'PostController@index')->middleware('auth');
Route::get('page-post/{id}','PostController@page')->middleware('auth');
Route::get('edit-post/{id}','PostController@edit')->middleware('auth');
Route::post('edit-post/{id}','PostController@update')->middleware('auth');
Route::get('delete-post/{id}','PostController@destroy')->middleware('auth');
Route::post('create-comment/{id}','CommentController@create')->middleware('auth');
Route::get('delete-comment/{id}','CommentController@destroy')->middleware('auth');


Route::get('/',  'HomeController@index');





Route::get('/home', 'HomeController@index')->name('home');
