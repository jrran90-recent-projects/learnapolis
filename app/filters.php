<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});



/*
Create IoC container for this,
leave this for now, since it's beta
*/
// View::composer('layouts.header', function($view)
// {
// 	/*
// 	All notification should be included
// 	> messages, gropus, post
// 	*/
// 	// $test = 'awr';

// 	// $usr = User::find(Auth::user()->_id);

// 	// foreach ($usr->group_joined as $v) {

// 	// 	$grp = Group::find($v);

// 	// 	if ( isset($grp->member) ) {
// 	// 		foreach ($grp->member as $v_member) {

// 	// 			if ( $v_member['status'] === 'pending' ) {

// 	// 				// Query User for Data
// 	// 				$usr2 = User::find($v_member['uid']);

// 	// 				$noti_msg = '<strong>'.$usr2->firstname.' '.$usr2->lastname
// 	// 							.'</strong> would like to join <strong>'.$grp->name.'</strong>';

// 	// 				$test = '<li><a href="'.URL::route('group-get', $v).'">'.$noti_msg.'</a></li>';
// 	// 			}

// 	// 		}
// 	// 	}

// 	// }


// 		// 	foreach ($usr->group_joined as $v) {

// 		// 	$grp = Group::find($v);

// 		// 	if ( isset($grp->member) ) {
// 		// 		foreach ($grp->member as $v_member) {

// 		// 			if ( $v_member['status'] === 'pending' ) {

// 		// 				// Query User for Data
// 		// 				$usr2 = User::find($v_member['uid']);

// 		// 				$noti_msg = '<strong>'.$usr2->firstname.' '.$usr2->lastname
// 		// 							.'</strong> would like to join <strong>'.$grp->name.'</strong>';

// 		// 				echo '<li><a href="',URL::route('group-get', $v),'">',$noti_msg,'</a></li>';
// 		// 			}

// 		// 		}
// 		// 	}
			
// 		// }

// 	$view->with('noti_count', Group::count());

// });