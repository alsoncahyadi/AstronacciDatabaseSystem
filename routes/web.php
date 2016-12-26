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

// CAT ROUTES
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

// MRG ROUTES
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

//UOB ROUTES
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
	
Route::get('list', [
	'uses' => 'RolelistController@index',
	'as' => 'rolelist',
	'middleware' => 'ashop' /*['auth', 'roles']*/ ,
	'roles' => ['0'],
	]);

//A-CLUB ROUTES
Route::get('/AClub', [
    'uses' => 'AClubController@getTable',
    'as' => 'AClub'
    ]);

Route::get('/AClub/{id}', [
    'uses' => 'AClubController@clientDetail',
    'as' => 'AClub.detail'
    ]);

Route::post('/AClub/insert', [
    'uses' => 'AClubController@addClient',
    'as' => 'AClub.insert'
    ]);

Route::post('/AClub/import', [
    'uses' => 'AClubController@importExcel',
    'as' => 'AClub.import'
    ]);

//GREEN ROUTES
Route::get('/green', [
    'uses' => 'GreenController@getTable',
    'as' => 'green'
    ]);

Route::get('/green/{id}', [
    'uses' => 'GreenController@clientDetail',
    'as' => 'green.detail'
    ]);

Route::post('/green/insert', [
    'uses' => 'GreenController@addClient',
    'as' => 'green.insert'
    ]);

Route::post('/green/import', [
    'uses' => 'GreenController@importExcel',
    'as' => 'green.import'
    ]);

//Red Club Route
Route::get('/RedClub', [
    'uses' => 'RedClubController@getTable',
    'as' => 'RedClub'
    ]);

Route::get('/RedClub/{id}', [
    'uses' => 'RedClubController@clientDetail',
    'as' => 'RedClub.detail'
    ]);

Route::post('/RedClub/insert', [
    'uses' => 'RedClubController@addClient',
    'as' => 'RedClub.insert'
    ]);

Route::post('/RedClub/import', [
    'uses' => 'RedClubController@importExcel',
    'as' => 'RedClub.import'
    ]);

//Grow Route
Route::get('/grow', [
    'uses' => 'GrowController@getTable',
    'as' => 'grow'
    ]);

Route::get('/grow/{id}', [
    'uses' => 'GrowController@clientDetail',
    'as' => 'grow.detail'
    ]);

Route::post('/grow/insert', [
    'uses' => 'GrowController@addClient',
    'as' => 'grow.insert'
    ]);

Route::post('/grow/import', [
    'uses' => 'GrowController@importExcel',
    'as' => 'grow.import'
    ]);