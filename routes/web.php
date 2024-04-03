<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});




/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {

	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
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

    /** Origin **/
    Route::resource('origin', 'OriginController');

    /** Trader **/
    Route::resource('trader', 'TraderController');

    /** Consignee **/
    Route::resource('consignee', 'ConsigneeController');

    /** Shipping Permit **/
    Route::resource('shipping_permits', 'ShippingPermitController');
    Route::post('/shipping_permits/{slug}/{type}/change_status', 'ShippingPermitController@changeStatus')->name('shipping_permits.change_status');



});

/** HOME **/
Route::get('dashboard/home', 'HomeController@index')->name('dashboard.home')->middleware('check.user_status');

/** Testing **/
Route::get('/dashboard/test', function(){

	return dd(Illuminate\Support\Str::random(16),Illuminate\Support\Str::random(11));
	//dd(number_format(null));

	//dd(9>=9);

});




