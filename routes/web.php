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

Route::get('/newMember', [
    'uses' => 'MockupController@index',
    'as' => 'mockup',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/insert', [
    'uses' => 'MockupController@addClient',
    'as' => 'insert',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/adduser', [
	'as' => 'adduser',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
	function(){
		return view('auth/register');
	},
	]);

Route::get('/addclient', [
    'uses' => 'MockupController@getClientInfo',
    'as' => 'getClient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

/* to be uncommented
Route::get('/register',
	function(){
		return redirect()->route('adduser');
	}
	);
*/

Route::get('/home', [
	'uses' => 'HomeController@index',
	'as' => 'home',
	]);

Route::get('/view', [
    'uses' => 'HomeController@masterTable',
    'as' => 'view',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/master/import', [
    'uses' => 'HomeController@importExcel',
    'middleware' => ['auth', 'roles'],
    'as' => 'master.import',
    'roles' => ['0']
    ]);

Route::get('/dashboard', [
    'uses' => 'Auth\LoginController@index',
    'as' => 'dashboard',
	'middleware' => 'auth'
    ]);


Route::get('/AShop', [
    'uses' => 'HomeController@indexAShop',
    'as' => 'ashop',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::get('/GreenDashboard', [
    'uses' => 'HomeController@indexGreen',
    'as' => 'Green.dashboard',
    'middleware' => ['auth', 'green'],
    ]);

Route::get('list', [
	'uses' => 'RolelistController@index',
	'as' => 'rolelist',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
	]);

Route::post('roleAssign', [
	'uses' => 'RolelistController@postAssignRoles',
	'as' => 'admin.assign',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
	]);

Route::get('/sales', [
	'uses' => 'SalesController@getTable',
	'as' => 'sales',
	'middleware' => ['auth', 'roles'],
	'roles' => ['5'],
	]);

Route::get('/report/{type}/{id}', [
    'uses' => 'SalesController@reportDetail',
    'as' => 'report.detail',
	'middleware' => ['auth', 'roles'],
	'roles' => ['5'],
    ]);

Route::post('/report/green', [
    'uses' => 'SalesController@addGreenReport',
    'as' => 'report.green',
	'middleware' => ['auth', 'green'],	
    ]);

Route::post('/report/grow', [
    'uses' => 'SalesController@addGrowReport',
    'as' => 'report.grow',
	'middleware' => ['auth', 'roles'],
	'roles' => ['5'],
    ]);

Route::post('/report/redclub', [
    'uses' => 'SalesController@addRedclubReport',
    'as' => 'report.redclub',
	'middleware' => ['auth', 'roles'],
	'roles' => ['5'],
    ]);

Route::get('/updatePassword', [
	'uses' => 'PassController@getForm',
	'as' => 'updatepass',
	'middleware' => ['auth'],
	]);

Route::post('/insertPassword', [
	'uses' => 'PassController@updatePass',
	'as' => 'insertpass',
	'middleware' => ['auth'],
	]);

// DETAIL PC ROUTES
Route::get('/member/{id}', [
    'uses' => 'DetailController@allPCDetail',
    'as' => 'detail',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/member/edit', [
    'uses' => 'DetailController@editClient',
    'as' => 'detail.edit',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);
Route::delete('/member/deleteclient/{id}', [
    'uses' => 'DetailController@deleteClient',
    'as' => 'detail.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
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
    'as' => 'CAT.detail',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '3'],
    ]);

Route::post('/CAT/insert', [
    'uses' => 'CATController@addClient',
    'as' => 'CAT.insert',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '3'],
    ]);

Route::post('/CAT/import', [
    'uses' => 'CATController@importExcel',
    'as' => 'CAT.import',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
    ]);

Route::post('/CAT/edit', [
    'uses' => 'CATController@editClient',
    'as' => 'CAT.edit',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '3'],
    ]);

Route::post('/CAT/inserttrans', [
    'uses' => 'CATController@addTrans',
    'as' => 'CAT.inserttrans',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '3'],
    ]);

Route::delete('/CAT/deleteclient/{id}', [
    'uses' => 'CATController@deleteClient',
    'as' => 'CAT.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '3'],
    ]);

//route delete masih ngaco
Route::get('/CAT/trans/{id}', [
    'uses' => 'CATController@detailTrans',
    'as' => 'CAT.transdetail',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '3'],
    ]);

Route::get('/CAT/deletetrans/{id1}/{id2}', [
    'uses' => 'CATController@deleteTrans',
    'as' => 'CAT/trans.deletetrans',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '3'],
    ]);

Route::post('/CAT/filter', [
    'uses' => 'CATController@getFilteredAndSortedTable',
    'as' => 'CAT.filter',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '3'],
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
    'as' => 'MRG.detail',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '2'],
    ]);

Route::post('/MRG/insert', [
    'uses' => 'MRGController@addClient',
    'as' => 'MRG.insert',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '2'],
    ]);

Route::post('/MRG/import', [
    'uses' => 'MRGController@importExcel',
    'as' => 'MRG.import',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
    ]);

Route::get('/MRGtrans/edit/{id}', [
    'uses' => 'MRGController@updateTrans',
    'as' => 'MRGtrans.edit',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '2'],
    ]);

Route::post('/MRG/edit', [
    'uses' => 'MRGController@editClient',
    'as' => 'MRG.edit',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '2'],
    ]);

Route::post('/MRG/inserttrans', [
    'uses' => 'MRGController@addTrans',
    'as' => 'MRG.inserttrans',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '2'],
    ]);

Route::get('/MRGexport', [
    'uses' => 'MRGController@exportExcel',
    'as' => 'MRG.export',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '2'],
    ]);

Route::delete('/MRG/deleteclient/{id}', [
    'uses' => 'MRGController@deleteClient',
    'as' => 'MRG.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '2'],
    ]);

Route::get('/MRG/{id}/{account}', [
    'uses' => 'MRGController@clientDetailAccount',
    'as' => 'MRG.account',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '2'],
    ]);

Route::delete('/MRG/deletetrans/{id}', [
    'uses' => 'MRGController@deleteTrans',
    'as' => 'MRG.deletetrans',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '2'],
    ]);

Route::post('/MRG/edittrans', [
    'uses' => 'MRGController@editTrans',
    'as' => 'MRG.edittrans',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '2'],
    ]);

Route::post('/MRG/filter', [
    'uses' => 'MRGController@getFilteredAndSortedTable',
    'as' => 'MRG.filter',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '2'],
    ]);

//UOB ROUTES
Route::get('/UOB', [
    'uses' => 'UOBController@getTable',
    'as' => 'UOB',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '4'],
    ]);

Route::get('/UOB/{id}', [
    'uses' => 'UOBController@clientDetail',
    'as' => 'UOB.detail',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '4'],
    ]);

Route::post('/UOB/insert', [
    'uses' => 'UOBController@addClient',
    'as' => 'UOB.insert',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '4'],
    ]);

Route::post('/UOB/import', [
    'uses' => 'UOBController@importExcel',
    'as' => 'UOB.import',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
    ]);

Route::post('/UOB/edit', [
    'uses' => 'UOBController@editClient',
    'as' => 'UOB.edit',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '4'],
    ]);

Route::delete('/UOB/deleteclient/{id}', [
    'uses' => 'UOBController@deleteClient',
    'as' => 'UOB.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '4'],
    ]);

Route::post('/UOB/inserttrans', [
    'uses' => 'UOBController@addTrans',
    'as' => 'UOB.inserttrans',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '4'],
    ]);

Route::post('/UOB/filter', [
    'uses' => 'UOBController@getFilteredAndSortedTable',
    'as' => 'UOB.filter',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '4'],
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
    'as' => 'AClub.detail',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1'],
    ]);

Route::get('/AClub/{id}/{member}', [
    'uses' => 'AClubController@clientDetailMember',
    'as' => 'AClub.member',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::get('/AClub/{id}/{member}/{package}', [
    'uses' => 'AClubController@clientDetailPackage',
    'as' => 'AClub.package',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::post('/AClub/insert', [
    'uses' => 'AClubController@addClient',
    'as' => 'AClub.insert',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1'],
    ]);

Route::post('/AClub/import', [
    'uses' => 'AClubController@importExcel',
    'as' => 'AClub.import',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
    ]);

Route::post('/AClub/edit', [
    'uses' => 'AClubController@editClient',
    'as' => 'AClub.edit',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1'],
    ]);

Route::post('/AClub/insertmembers', [
    'uses' => 'AClubController@addMember',
    'as' => 'AClub.insertmembers',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::post('/AClub/inserttrans', [
    'uses' => 'AClubController@addTrans',
    'as' => 'AClub.inserttrans',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1'],
    ]);

Route::delete('/AClub/deletetrans/{id}', [
    'uses' => 'AClubController@deleteTrans',
    'as' => 'AClub.deletetrans',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::delete('/AClub/deletemember/{id}', [
    'uses' => 'AClubController@deleteMember',
    'as' => 'AClub.deletemember',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::delete('/AClub/deleteclient/{id}', [
    'uses' => 'AClubController@deleteClient',
    'as' => 'AClub.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::post('/AClub/editmember', [
    'uses' => 'AClubController@editMember',
    'as' => 'AClub.editmember',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::get('/AClubmember/edit/{id}', [
    'uses' => 'AClubController@updateMember',
    'as' => 'AClubmember.edit',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::post('/AClub/edittrans', [
    'uses' => 'AClubController@editTrans',
    'as' => 'AClub.edittrans',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::get('/AClubtrans/edit/{id}', [
    'uses' => 'AClubController@updateTrans',
    'as' => 'AClubtrans.edit',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::post('/AClub/add-bonus', [
    'uses' => 'AClubController@addBonus',
    'as' => 'AClub.add-bonus',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);

Route::post('/AClub/filter', [
    'uses' => 'AClubController@getFilteredAndSortedTable',
    'as' => 'AClub.filter',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);


//GREEN ROUTES
Route::get('/Green', [
    'uses' => 'GreenController@getTable',
    'as' => 'Green',
	'middleware' => ['auth', 'green'],
    ]);

Route::get('/green/{id}', [
    'uses' => 'GreenController@clientDetail',
    'as' => 'Green.detail',
	'middleware' => ['auth', 'green'],
    ]);

Route::get('/green/{id}/{progress}', [
    'uses' => 'GreenController@clientTrans',
    'as' => 'Green.trans',
    'middleware' => ['auth', 'green'],
    ]);

Route::post('/green/insert', [
    'uses' => 'GreenController@addClient',
    'as' => 'Green.insert',
	'middleware' => ['auth', 'green'],
    ]);

Route::post('/green/inserttrans', [
    'uses' => 'GreenController@addTrans',
    'as' => 'Green.inserttrans',
    'middleware' => ['auth', 'green'],
    ]);

Route::post('/green/import', [
    'uses' => 'GreenController@importExcel',
    'as' => 'Green.import',
	'middleware' => ['auth', 'green'],
    ]);

Route::post('/green/edit', [
    'uses' => 'GreenController@editClient',
    'as' => 'Green.edit',
	'middleware' => ['auth', 'green'],
    ]);

Route::delete('/green/deletetrans/{id}', [
    'uses' => 'GreenController@deleteTrans',
    'as' => 'Green.deletetrans',
    'middleware' => ['auth', 'green'],
    ]);

Route::get('/greentrans/edit/{id}', [
    'uses' => 'GreenController@updateTrans',
    'as' => 'Greentrans.edit',
    'middleware' => ['auth', 'green'],
    ]);

Route::post('/green/edittrans', [
    'uses' => 'GreenController@editTrans',
    'as' => 'Green.edittrans',
    'middleware' => ['auth', 'green'],
    ]);

Route::delete('/green/deleteclient/{id}', [
    'uses' => 'GreenController@deleteClient',
    'as' => 'Green.deleteclient',
    'middleware' => ['auth', 'green'],
    ]);

Route::post('/green/assign', [
    'uses' => 'GreenController@assignClient',
    'as' => 'Green.assign',
	'middleware' => ['auth', 'green'],
    ]);

Route::post('/green/assign', [
    'uses' => 'GreenController@assignClient',
    'as' => 'Green.assign',
    'middleware' => ['auth', 'green'],
    ]);

Route::post('/Green/filter', [
    'uses' => 'GreenController@getFilteredAndSortedTable',
    'as' => 'Green.filter',
    'middleware' => ['auth', 'green'],
    ]);


//Red Club Route
Route::get('/RedClub', [
    'uses' => 'RedClubController@getTable',
    'as' => 'RedClub',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/RedClub/{id}', [
    'uses' => 'RedClubController@clientDetail',
    'as' => 'RedClub.detail',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/RedClub/insert', [
    'uses' => 'RedClubController@addClient',
    'as' => 'RedClub.insert',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/RedClub/import', [
    'uses' => 'RedClubController@importExcel',
    'as' => 'RedClub.import',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
    ]);

Route::post('/RedClub/edit', [
    'uses' => 'RedClubController@editClient',
    'as' => 'RedClub.edit',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::delete('/RedClub/deleteclient/{id}', [
    'uses' => 'RedClubController@deleteClient',
    'as' => 'RedClub.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/RedClub/assign', [
    'uses' => 'RedClubController@assignClient',
    'as' => 'RedClub.assign',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

//Grow Route
Route::get('/grow', [
    'uses' => 'GrowController@getTable',
    'as' => 'grow',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/grow/{id}', [
    'uses' => 'GrowController@clientDetail',
    'as' => 'grow.detail',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/grow/insert', [
    'uses' => 'GrowController@addClient',
    'as' => 'grow.insert',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/grow/import', [
    'uses' => 'GrowController@importExcel',
    'as' => 'grow.import',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0'],
    ]);

Route::post('/grow/edit', [
    'uses' => 'GrowController@editClient',
    'as' => 'grow.edit',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::delete('/grow/deleteclient/{id}', [
    'uses' => 'GrowController@deleteClient',
    'as' => 'grow.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/grow/assign', [
    'uses' => 'GrowController@assignClient',
    'as' => 'grow.assign',
	'middleware' => ['auth', 'roles'],
	'roles' => ['0', '1', '2', '3', '4'],
    ]);

//AShop Route
Route::get('/product', [
    'uses' => 'ProductController@getTable',
    'as' => 'product',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::post('/product/insert', [
    'uses' => 'ProductController@addClient',
    'as' => 'product.insert',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0'],
    ]);

Route::get('/AShopDashboards', [
    'uses' => 'HomeController@indexAShop',
    'as' => 'AShop.dashboard',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::get('/AShop/{id}', [
    'uses' => 'AshopController@clientDetail',
    'as' => 'AShop.detail',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::get('/AShop', [
    'uses' => 'AshopController@getTable',
    'as' => 'AShop',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::post('/AShop/insert', [
    'uses' => 'AshopController@addClient',
    'as' => 'AShop.insert',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::delete('/AShop/deletetrans/{id}', [
    'uses' => 'AshopController@deleteTrans',
    'as' => 'AShop.deletetrans',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::post('/AShop/inserttrans', [
    'uses' => 'AshopController@addTrans',
    'as' => 'AShop.inserttrans',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::delete('/AShop/delete/{id}', [
    'uses' => 'AshopController@deleteClient',
    'as' => 'AShop.deleteclient',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::post('/AShop/edit', [
    'uses' => 'AshopController@editClient',
    'as' => 'AShop.edit',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::get('/AShoptrans/edit/{id}', [
    'uses' => 'AshopController@updateTrans',
    'as' => 'AShoptrans.edit',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::post('/AShop/edittrans', [
    'uses' => 'AshopController@editTrans',
    'as' => 'AShop.edittrans',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::get('/AShop/{id}/{package}', [
    'uses' => 'AshopController@clientDetailTrans',
    'as' => 'AShop.trans',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::post('/AShop/filter', [
    'uses' => 'AshopController@getFilteredAndSortedTable',
    'as' => 'AShop.filter',
    'middleware' => ['auth', 'ashop'],
    ]);

Route::post('/AShop/import', [
    'uses' => 'AshopController@importExcel',
    'as' => 'AShop.import',
    'middleware' => ['auth', 'ashop', 'roles'],
    'roles' => ['0'],
    ]);


//Assignment Routes
Route::get('/assign', [
    'uses' => 'AssignmentController@getTable',
    'as' => 'assign',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/assign/green/{id}', [
    'uses' => 'AssignmentController@clientDetailGreen',
    'as' => 'assign.greendetail',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/assign/grow/{id}', [
    'uses' => 'AssignmentController@clientDetailGrow',
    'as' => 'assign.growdetail',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/assign/redclub/{id}', [
    'uses' => 'AssignmentController@clientDetailRedClub',
    'as' => 'assign.redclubdetail',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/assign/green/edit', [
    'uses' => 'AssignmentController@editClientGreen',
    'as' => 'assigngreen.edit',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/assign/grow/edit', [
    'uses' => 'AssignmentController@editClientGrow',
    'as' => 'assigngrow.edit',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::post('/assign/redclub/edit', [
    'uses' => 'AssignmentController@editClientRedClub',
    'as' => 'assignredclub.edit',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/assign/green/deleteclient/{id}', [
    'uses' => 'AssignmentController@deleteClientGreen',
    'as' => 'assigngreen.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/assign/grow/deleteclient/{id}', [
    'uses' => 'AssignmentController@deleteClientGrow',
    'as' => 'assigngrow.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/assign/redclub/deleteclient/{id}', [
    'uses' => 'AssignmentController@deleteClientRedClub',
    'as' => 'assignredclub.deleteclient',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/export/mrg', [
    'uses' => 'MRGController@exportExcel',
    'as' => 'mrgexport',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/export/cat', [
    'uses' => 'CATController@exportExcel',
    'as' => 'catexport',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/export/aclub', [
    'uses' => 'AClubController@exportExcel',
    'as' => 'aclubexport',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/template/aclub', [
    'uses' => 'AClubController@templateExcel',
    'as' => 'aclubtemplate',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/template/mrg', [
    'uses' => 'MRGController@templateExcel',
    'as' => 'mrgtemplate',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/template/uob', [
    'uses' => 'UOBController@templateExcel',
    'as' => 'uobtemplate',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/template/cat', [
    'uses' => 'CATController@templateExcel',
    'as' => 'cattemplate',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/template/green', [
    'uses' => 'GreenController@templateExcel',
    'as' => 'greentemplate',
    'middleware' => ['auth', 'green'],    
    ]);

Route::get('/template/green', [
    'uses' => 'GreenController@templateExcel',
    'as' => 'greentemplate',
    'middleware' => ['auth', 'green'],    
    ]);

Route::get('/template/ashop', [
    'uses' => 'AshopController@templateExcel',
    'as' => 'ashoptemplate',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/template/master', [
    'uses' => 'HomeController@templateExcel',
    'as' => 'mastertemplate',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/export/uob', [
    'uses' => 'UOBController@exportExcel',
    'as' => 'uobexport',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/export/master', [
    'uses' => 'HomeController@exportExcel',
    'as' => 'masterexport',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/export/ashop', [
    'uses' => 'AshopController@exportExcel',
    'as' => 'ashopexport',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1', '2', '3', '4'],
    ]);

Route::get('/export/green', [
    'uses' => 'GreenController@exportExcel',
    'as' => 'greenexport',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '4'],
    ]);

Route::post('/master/filter', [
    'uses' => 'HomeController@masterTable',
    'as' => 'master.filter',
    'middleware' => ['auth', 'roles'],
    'roles' => ['0', '1'],
    ]);