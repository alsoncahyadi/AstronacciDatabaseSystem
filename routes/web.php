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

/* Roles
0 : superadmin, all privileges
1 : A-Club
2 : MRG
3 : CAT
4 : UOB
5 : Sales
*/

Route::get('/', 'Auth\LoginController@index')->middleware('auth');

Auth::routes();

Route::get('/adduser', [
	'as' => 'adduser',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
	function(){ 
		return view('auth/register');
	},
	]);
/* to be uncommented
Route::get('/register',
	function(){ 
		return redirect()->route('adduser');
	}
	);
*/
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
    'uses' => 'HomeController@index2',
    'as' => 'dashboard2',
	'middleware' => 'ashop',
    ]);
		
Route::get('list', [
	'uses' => 'RolelistController@index',
	'as' => 'rolelist',
	'middleware' => 'ashop' /*['auth', 'roles']*/ ,
	'roles' => ['0'],
	]);
	
Route::post('roleAssign', [
	'uses' => 'RolelistController@postAssignRoles',
	'as' => 'admin.assign',
	]);

// CAT ROUTES
Route::get('/CAT', [
    'uses' => 'CATController@getTable',
    'as' => 'CAT',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '3'],
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

Route::post('/CAT/edit', [
    'uses' => 'CATController@editClient',
    'as' => 'CAT.edit'
    ]);

// MRG ROUTES
Route::get('/MRG', [
    'uses' => 'MRGController@getTable',
    'as' => 'MRG',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '2'],
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

Route::post('/MRG/edit', [
    'uses' => 'MRGController@editClient',
    'as' => 'MRG.edit'
    ]);

Route::get('/MRGexport', [
    'uses' => 'MRGController@exportExcel',
    'as' => 'MRG.export'
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

Route::post('/UOB/edit', [
    'uses' => 'UOBController@editClient',
    'as' => 'UOB.edit'
    ]);

//A-CLUB ROUTES
Route::get('/AClub', [
    'uses' => 'AClubController@getTable',
    'as' => 'AClub',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1'],
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

Route::post('/AClub/edit', [
    'uses' => 'AClubController@editClient',
    'as' => 'AClub.edit'
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

Route::post('/green/edit', [
    'uses' => 'GreenController@editClient',
    'as' => 'green.edit'
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

Route::post('/RedClub/edit', [
    'uses' => 'RedClubController@editClient',
    'as' => 'RedClub.edit'
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

Route::post('/grow/edit', [
    'uses' => 'GrowController@editClient',
    'as' => 'grow.edit'
    ]);