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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index', ['messageSchedule' => 'Taylor'])->name('home');
Route::get('/getStatistic', 'HomeController@getStatistic')->name('table-statistic');
Route::post('/createEMilQueue', 'MessageController@createMailQueue')->name('create-mail-queue')->middleware('auth');
