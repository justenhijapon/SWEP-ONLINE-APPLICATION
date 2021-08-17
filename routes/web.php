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

	Route::resource('submenu', 'SubmenuController');

	/** SEMINARS **/
	Route::get('/seminar/view_attendance_sheet/{slug}', 'SeminarController@viewAttendanceSheet')->name('seminar.view_attendance_sheet');
	Route::get('/seminar/view_seminar/{slug}', 'SeminarController@viewSeminar')->name('seminar.view_seminar_details');

	Route::get('/seminar/download_attendance_sheet/{slug}', 'SeminarController@downloadAttendanceSheet')->name('seminar.download_attendance_sheet');

	Route::resource('seminar', 'SeminarController');
	

	/** SEMINAR PARTICIPANTS **/
	Route::get('/seminar/participant/{slug}', 'SeminarController@participant')->name('seminar.participant');
	Route::post('/seminar/participant/store/{slug}', 'SeminarController@participantStore')->name('seminar.participant_store');
	Route::put('/seminar/participant/update/{slug}', 'SeminarController@participantUpdate')->name('seminar.participant_update');
	Route::delete('/seminar/participant/destroy/{slug}', 'SeminarController@participantDestroy')->name('seminar.participant_destroy');
	Route::get('/seminar/participant/{slug}/edit', 'SeminarController@participantEdit')->name('seminar.participant_edit');


	/** SEMINAR SPEAKERS **/
	Route::get('/seminar/speaker/{slug}', 'SeminarController@speaker')->name('seminar.speaker');
	Route::post('/seminar/speaker/store/{slug}', 'SeminarController@speakerStore')->name('seminar.speaker_store');
	Route::put('/seminar/speaker/update/{slug}/{spkr_slug}', 'SeminarController@speakerUpdate')->name('seminar.speaker_update');
	Route::delete('/seminar/speaker/destroy/{slug}', 'SeminarController@speakerDestroy')->name('seminar.speaker_destroy');


	/** BLOCK FARM **/

	Route::get('/block_farm/reports', 'BlockFarmController@reports')->name('block_farm.reports');
	Route::get('/block_farm/report_generate', 'BlockFarmController@report_generate')->name('block_farm.report_generate');

	Route::resource('block_farm','BlockFarmController');
	Route::resource('bf_member','BFMemberController');


	/** SCHOLARS **/
	Route::get('/scholars/report_generate', 'ScholarsController@report_generate')->name('scholars.report_generate');
	Route::get('/scholars/reports', 'ScholarsController@reports')->name('scholars.reports');
	Route::resource('scholars','ScholarsController');
	Route::resource('mill_district', 'MillDistrictController');

    /** COMMITTEE MEMBERS **/
	Route::resource('committee_members', 'CommitteeMembersController');

    /** PLAN AND BUDGET **/
    Route::get('/projects/reports','ProjectsController@reports')->name('projects.reports');
    Route::get('/projects/report_generate','ProjectsController@report_generate')->name('projects.report_generate');
    Route::resource('projects','ProjectsController');

    /** OTHER ACTIVITIES **/
    Route::resource('other_activities','OtherActivitiesController');

    /** OFFICE ACTIVITIES **/
	Route::resource('office_activities', 'OfficeActivitiesController');


});

/** HOME **/
Route::get('dashboard/home', 'HomeController@index')->name('dashboard.home')->middleware('check.user_status');

/** Testing **/
Route::get('/dashboard/test', function(){

	return dd(Illuminate\Support\Str::random(16));
	
	//dd(number_format(null));

	//dd(9>=9);

});

