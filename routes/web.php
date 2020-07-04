<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::redirect('/', '/polls');

Auth::routes();

Route::resource('comments', 'CommentController')->only(['store', 'update', 'destroy']);
Route::resource('polls', 'PollController');
Route::resource('users', 'UserController')->except(['create', 'store']);
Route::patch('/users/{user}/settings', 'UserController@updateSettings')->name('users.settings.update');
Route::resource('votes', 'VoteController')->only(['store', 'update', 'destroy']);
Route::get('/notifications', 'Notifications')->middleware('auth')->name('notifications');
Route::resource('conversations', 'ConversationController');
Route::resource('messages', 'MessageController');
