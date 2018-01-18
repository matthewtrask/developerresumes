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


Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/resume/{id}/download', 'ResumeController@downloadResume')->name('downloadResume');
Route::get('/resume/{id}', 'ResumeController@getResume')->name('viewResume');
Route::post('/resume', 'ResumeController@upload')->name('uploadResume');
