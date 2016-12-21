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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', [
    'uses' => 'AClubController@index',
    'as' => 'dashboard'
    ]);

Route::get('/AClub', [
    'uses' => 'AClubController@getTable',
    'as' => 'AClub'
    ]);

Route::get('/CAT', [
    'uses' => 'CATController@getTable',
    'as' => 'CAT'
    ]);

Route::get('/CAT/{id}', [
    'uses' => 'CATController@clientDetail',
    'as' => 'CAT.detail'
    ]);

Route::get('/MRG', [
    'uses' => 'MRGController@getTable',
    'as' => 'MRG'
    ]);

Route::get('/MRG/{id}', [
    'uses' => 'MRGController@clientDetail',
    'as' => 'MRG.detail'
    ]);

Route::post('/MRG/insert', [
    'uses' => 'MRGController@addClient',
    'as' => 'MRG.insert'
    ]);

Route::post('/MRG/import', [
    'uses' => 'MRGController@importExcel',
    'as' => 'MRG.import'
    ]);