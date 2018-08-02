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


Auth::routes();//登录注册

Route::get('/','ThreadsController@index'); //首页

Route::get('/threads', 'ThreadsController@index')->name('threads'); //话题列表

Route::get('/threads/{thread}','ThreadsController@show')->name('threads.show');//话题详情

Route::post('/threads/{thread}/replies','RepliesController@store')->name('replies.store'); //发表回复


