<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('App\Http\Controllers\Api')->group(function() {
    Route::name('hackerspaces.')->group(function() {
        Route::resource('hackerspaces', 'HackerspaceController');
    });

    Route::name('users.')->group(function() {
        Route::resource('users', 'UserController');
    });

    Route::name('events.')->group(function() {
        Route::resource('events', 'EventController');
    });

    Route::name('projects.')->group(function() {
        Route::resource('projects', 'ProjectController');
    });

    Route::name('blog_posts.')->group(function() {
        Route::resource('blog-posts', 'BlogPostController');
    });

    Route::name('press_mentions.')->group(function() {
        Route::resource('press-mentions', 'PressMentionController');
    });
});
