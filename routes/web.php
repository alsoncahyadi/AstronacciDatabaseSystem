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

Route::get('/', 'Auth\LoginController@index')->middleware('auth');

/*
Route::get('/', function () {
    return view('auth/login');
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', [
    'uses' => 'Auth\LoginController@index',
    'as' => 'dashboard'
    ]);

Route::get('/dashboard1', [
    'uses' => 'Auth\LoginController@index1',
    'as' => 'dashboard1'
    ]);
	
Route::get('/dashboard2', [
    'uses' => 'Auth\LoginController@index2',
    'as' => 'dashboard2'
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

Route::post('/CAT/insert', [
    'uses' => 'CATController@addClient',
    'as' => 'CAT.insert'
    ]);

Route::post('/CAT/import', [
    'uses' => 'CATController@importExcel',
    'as' => 'CAT.import'
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

Route::get('/UOB', [
    'uses' => 'UOBController@getTable',
    'as' => 'UOB'
    ]);

Route::get('/UOB/{id}', [
    'uses' => 'UOBController@clientDetail',
    'as' => 'UOB.detail'
    ]);

Route::post('/UOB/insert', [
    'uses' => 'UOBController@addClient',
    'as' => 'UOB.insert'
    ]);

Route::post('/UOB/import', [
    'uses' => 'UOBController@importExcel',
    'as' => 'UOB.import'
    ]);