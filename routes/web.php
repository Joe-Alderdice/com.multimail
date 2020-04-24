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
    return view('welcome');
});

Auth::routes();

//Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('email/create')->group(function () {
        Route::get('/', 'EmailController@index')->name('emailIndex');
        Route::post('/list/create', 'EmailController@listCreate')->name('listCreate');
        Route::get('/import', 'EmailController@import')->name('import');
        Route::post('/import/file', 'EmailController@importfile')->name('importFile');
        Route::get('/template', 'EmailController@template')->name('template');
        Route::post('/template/store', 'EmailController@templateStore')->name('templateStore');
        Route::get('/template/preview', 'EmailController@templatePreview')->name('templatePreview');
        Route::post('/send', 'EmailController@send')->name('sendEmail');
        Route::view('/success', 'email.successful');
    });
});
