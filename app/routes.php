<?php

/*
Note:
- Separate route for registration/login from dashboard
*/

// Main Page
Route::get('/', 		function () { return View::make('index'); });
Route::get('login',		function () { return View::make('login'); });
Route::get('register',	function () { return View::make('register'); });


// Register
Route::post('register-post', array(
		'as'	=> 'register-post',
		'uses'	=> 'HomeController@doRegister'
	));


// Unauthenticated Group
Route::group(array( 'before' => 'guest' ), function () {
	// CSRF Protection
	Route::group(array( 'before' => 'csrf' ), function () {
		Route::post('login-post', array(
				'as'	=> 'login-post',
				'uses'	=> 'HomeController@doLogin'
			));
	});

	// Account Verification
	Route::get('activate/{code}', [
		'as'	=> 'account-activate',
		'uses'	=> 'HomeController@getActivate'
		]);

	// Forgot Password
	Route::post('/account/forgot-password', ['uses' => 'HomeController@doForgotPassword']);
	Route::get('/account/recover/{hash}',	['uses' => 'HomeController@getRecover',
											 'as'	=> 'account-recover']);
});




// Notification



// Authenticated Group
Route::group(array( 'before' => 'auth' ), function () {
	Route::get('logout', 	array( 'uses' => 'HomeController@doLogout' ));

	// Search
	Route::get('search/{query}', 		['uses' => 'HomeController@search']);
	Route::get('search-group/{query}',	['uses' => 'HomeController@searchGroup']);



	// ------------- Subject for removal --------------------------------
	// // Notifications
	// Route::group( array('prefix'=>'header'), function(){
	// 	Route::get('notifications',	['uses' => 'NotificationController@notification']);
	// 	Route::get('count_noti',	['uses' => 'NotificationController@count_noti']);
	// });
	// ------------------------------------------------------------------

	// User Group
	Route::get('user/notification', ['uses' => 'AccountController@notification']);
	Route::get('user/count_noti',	['uses' => 'AccountController@count_noti']);

	Route::get('user/', 	['uses' => 'AccountController@dashboard',		// Dashboard
					 	 	 'as'	=> 'dashboard']);
	Route::get('user/{id}',	['uses' => 'AccountController@userProfile',		// Profile
							 'as'	=> 'user-profile']);

	// Connection Request
	Route::post('/user-add',			['uses' => 'AccountController@addUser']);
	Route::post('user/accept-request',	['uses' => 'AccountController@acceptRequest']);

	Route::post('/user-remove',			['uses' => 'AccountController@removeUser']);



	Route::post('/user/upload', 	['uses' => 'AccountController@uploadImage']);
	Route::post('/user/basic_info',	['uses' => 'AccountController@doBasicInfo']);
	Route::post('/user/email',		['uses' => 'AccountController@doEmail']);
	Route::post('/user/password',	['uses' => 'AccountController@doPassword']);
	Route::post('/user/change-password', 	['uses' => 'AccountController@changePassword']);
	Route::post('/user/education',			['uses' => 'AccountController@doEducation']);





	// Groups
	Route::post('group-post',	[ 'uses' => 'GroupController@createGroup' ]);
	Route::get('group/{id}',	[
		'as'	=> 'group-get',
		'uses'	=> 'GroupController@getGroup'
		]);
	Route::post('group-join',		['uses' => 'GroupController@joinGroup' ]);
	Route::post('group-request',	['uses' => 'GroupController@groupRequest']);

	// Posts
	Route::get('post-get',		['uses' => 'PostController@getPost']);
	Route::post('post-add',		['uses' => 'PostController@doPost']);
	// Comments
	Route::post('comment-post',	['uses' => 'PostController@doComment']);
	Route::get('comment-get',	['uses' => 'PostController@getComment']);
	// Download
	Route::get('/download/{file}',	['uses' => 'PostController@getDownload']);

	// Group Posts
	Route::get('group-post-get',	['uses' => 'PostController@getGroupPost']);
	Route::post('group-post-add',	['uses' => 'PostController@doGroupPost']);


});