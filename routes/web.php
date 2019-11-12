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


	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');


	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');


	/** MENU **/
	Route::resource('menu', 'MenuController');


	/** SEMINARS **/
	Route::resource('seminar', 'SeminarController');


	/** SEMINAR PARTICIPANTS **/
	Route::get('/seminar/participant/{slug}', 'SeminarController@participant')->name('seminar.participant');
	Route::post('/seminar/participant/store/{slug}', 'SeminarController@participantStore')->name('seminar.participant_store');
	Route::put('/seminar/participant/update/{slug}/{emp_trng_slug}', 'SeminarController@participantUpdate')->name('seminar.participant_update');
	Route::delete('/seminar/participant/destroy/{slug}', 'SeminarController@participantDestroy')->name('seminar.participant_destroy');
	Route::get('/seminar/participant/print/{slug}', 'SeminarController@participantPrint')->name('seminar.participant_print');

	
});






/** Testing **/
Route::get('/dashboard/test', function(){

	//return dd(Illuminate\Support\Str::random(16));
	
	//dd(number_format(null));

	//dd(9>=9);

});

