<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
//    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::get('/', 'Guest\HomeController@index')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});

Route::get('/login', function (){
    return view('auth.login');
});

Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status']], function () {
    Route::get('ajax/{for}',\App\Http\Controllers\AjaxController::class.'@get')->name('ajax');
});


/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {

	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
    Route::get('/user/activity/{slug}', 'UserController@activity')->name('user.activity');
	Route::resource('user', 'UserController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color', 'ProfileController@updateAccountColor')->name('profile.update_account_color');
	Route::post('/profile/update_image', 'ProfileController@updateImage')->name('profile.update_image');


	/** MENU **/
	Route::resource('menu', 'MenuController');
	Route::get('/get_menus', 'MenuController@getMenus')->name('menu.get_menus');
	Route::get('/reorder_menus', 'MenuController@reorderMenus')->name('menu.reorder_menus');

    /** SUBMENU **/
	Route::resource('submenu', 'SubmenuController');

    /** PORT **/
    Route::resource('port', 'PortController');

    /** Mill **/
    Route::resource('mill', 'MillController');

//    /** Origin **/
//    Route::resource('origin', 'OriginController');

    /** Trader **/
    Route::resource('trader', 'TraderController');

    /** Consignee **/
    Route::resource('consignee', 'ConsigneeController');

    /** Vessel **/
    Route::resource('vessel', 'VesselController');

    /** Sugar Liens **/
    Route::resource('sugar_liens', 'SugarLiensController');

    /** Shipping Permit **/
    Route::resource('shipping_permits', 'ShippingPermitController');
    Route::post('/shipping_permits/{slug}/{type}/change_status', 'ShippingPermitController@changeStatus')->name('shipping_permits.change_status');
    Route::get('/shipping_permit_reports', 'ShippingPermitController@reports')->name('shipping_permits.reports');
    Route::get('/shipping_permit_report_generate', 'ShippingPermitController@report_generate')->name('shipping_permits.report_generate');

    /** Official Reciepts **/
    Route::resource('official_reciepts', 'OfficialRecieptsController');
    Route::get('/official_reciepts_reports', 'OfficialRecieptsController@reports')->name('official_reciepts.reports');
    Route::get('/official_reciepts_report_generate', 'OfficialRecieptsController@report_generate')->name('official_reciepts.report_generate');



});

/** HOME **/
Route::get('dashboard/home', 'HomeController@index')->name('dashboard.home')->middleware('check.user_status');

/** Testing **/
Route::get('/dashboard/test', function(){

//	return dd(Illuminate\Support\Str::random(16),Illuminate\Support\Str::random(11));
	//dd(number_format(null));
	//dd(9>=9);

});

//Route::get('/printables/index', [\App\Http\Controllers\printController::class, 'index']);
//Route::get('/printables/print/{id}', 'printController@print')->name('printables.print');

Route::get('/printables/index/{slug}', 'printController@index')->name('printables.index');
Route::get('/shipping_permit/print/{slug}', 'ShippingPermitController@print')->name('shipping_permit.print');
Route::get('/official_reciepts/print/{slug}', 'OfficialRecieptsController@print')->name('official_reciepts.print');
Route::get('users/export/', [\App\Http\Controllers\ShippingPermitController::class, 'export']);

Route::post('/store-data', [VolumeController::class, 'store'])->name('storeData');

Route::get('/phpinfo', function(){
    phpinfo();
//    laravel_cloud();
});

/** Guest **/
Route::get('imported-commodities', 'Guest\GuestController@importedCommodities')->name('imported-commodities.index');