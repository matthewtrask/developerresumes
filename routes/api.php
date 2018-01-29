<?php

use Illuminate\Http\Request;

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

Route::post('/register', ['uses' => 'Api\Auth\RegisterController@create']);

Route::get('/resumes', ['uses' => 'Api\ResumeController@index'])->name('getResumes');
Route::get('/resumes/{id}/download', 'Api\ResumeController@downloadResume')->name('downloadResume');
Route::get('/resumes/{id}', 'Api\ResumeController@getResume')->name('viewResume');
Route::post('/resumes', 'Api\ResumeController@upload')->name('uploadResume');
Route::delete('/resumes/{id}', 'Api\ResumeController@delete')->name('deleteResume');

Route::middleware('auth:api')->post('/feedback', ['uses' => 'Api\FeedbackController@create']);
Route::middleware('auth:api')->get('/user', ['uses' => 'Api\UsersController@fetch']);