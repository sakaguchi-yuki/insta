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

Route::post('/upload', 'PostController@upload')->name('upload');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/post', 'PostController@index');
Route::post('user', 'User\UserController@updateUser');
Route::get('github', 'Github\GithubController@top');
Route::post('github/issue', 'Github\GithubController@createIssue');
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/index', 'IndexController@index');
Route::get('/profile', 'ProfileController@index');
