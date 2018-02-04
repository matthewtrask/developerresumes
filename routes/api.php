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

Route::post('/signup', ['uses' => 'Api\EmailController@create']);

Route::post('/register', ['uses' => 'Api\Auth\RegisterController@create']);

Route::get('/resumes', ['uses' => 'Api\ResumeController@index'])->name('getResumes');
Route::get('/resumes/{id}/download', 'Api\ResumeController@downloadResume')->name('downloadResume');
Route::get('/resumes/{id}', 'Api\ResumeController@getResume')->name('viewResume');

Route::middleware('auth:api')->post('/feedback', ['uses' => 'Api\FeedbackController@create']);
Route::middleware('auth:api')->get('/user', ['uses' => 'Api\UsersController@fetch']);
Route::middleware('auth:api')->post('/profile', ['uses' => 'Api\ProfileController@create']);
Route::middleware('auth:api')->put('/profile', ['uses' => 'Api\ProfileController@edit']);
Route::middleware('auth:api')->post('/resumes/upload', ['uses' => 'Api\ResumeController@upload'])->name('uploadResume');
Route::middleware('auth:api')->delete('/resumes/{id}', ['uses' => 'Api\ResumeController@delete'])->name('deleteResume');

