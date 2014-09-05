<?php

class HomeController extends BaseController {

	public function doLogin() {

		$validator = Validator::make(Input::all(),
			array(
				'email'		=> 'required',
				'password'	=> 'required'
				));

		if ( $validator->fails() ) {
			// Redirect to homepage
			return Redirect::to('login')
					->withErrors($validator)
					->withInput();
		} else {
			// Attempt user to sign in
			$auth = Auth::attempt(
						array(
							'email'		=> Input::get('email'),
							'password'	=> Input::get('password'),
							'active'	=> 1
						));

			if ( $auth ) {
				// Redirect to the intended page
				return Redirect::intended('user');
			} else {
				return Redirect::to('login')
					->with('message','<div class="alert alert-danger">Username/Password incorrect!</div>');
			}
		}
		return Redirect::to('login')
			->with('message','there was a problem signing in!');
	}

	public function doLogout() {
		Auth::logout();
		return Redirect::to('login');
	}


	// Registration
	public function doRegister() {
		$validator = Validator::make(Input::all(),
			array(
				'email'		=> 'required | email | unique:users', // must be unique in the users collection
				'firstname'	=> 'required',
				'lastname'	=> 'required',
				'password'	=> 'required | min:6 | max:12',
				'cb_tos'	=> 'required'
				));

		if ( $validator->fails() ) {
			// Redirect to Registration Page
			return Redirect::to('register')
						->withErrors($validator)
						->withInput();
		} else {

			// Create Hash Code
			$hash = md5( rand(0,1000) );

			$users = DB::collection('users')->insert(
						array(
							'email' 	=> Input::get('email'),
							'firstname'	=> ucwords(Input::get('firstname')),
							'lastname'	=> ucwords(Input::get('lastname')),
							'password'	=> Hash::make(Input::get('password')),
							'hash'		=> $hash,
							'active'	=> 0
							)
						);

			// Send an e-mail
			$data = array(
							'link'		=> URL::route('account-activate', $hash ),
							'firstname'	=> Input::get('firstname')
						);

			Mail::send('emails.auth.welcome',$data, function ($message) {
				$message->to( Input::get('email') )
						->subject('Sign-up Verification | Learnapolis');
			});

			if ( $users ) {
				return Redirect::to('login')
							->with('message','<div class="alert alert-success">A <strong>verification email</strong> was sent to your email address and is awaiting for confirmation!</div>');
			}

		}
	}

	public function getActivate($code) {
		$user = User::where('hash','=',$code)
					->where('active','=',0);

		if ( $user->count() ) {
			$user = $user->first();

			// Update user to active state
			$user->active = 1;
			$user->hash   = '';

			if ( $user->save() ) {
				return Redirect::to('login')
					->with('message', '<div class="alert alert-success">Account Activated! You can now sign in!</div>');
			}
		}
		return Redirect::to('login')
					->with('message', '<div class="alert alert-danger">We could not activate your account. Try again later!</div>');
	}

	// Forgot Password
	public function doForgotPassword() {
		$user = User::where('email','=',Input::get('email'));

		if ( $user->count() ) {
			$user = $user->first();

			// Generate new hash_code and password
			$hash = md5( rand(0,1000) );
			$pass = str_random(10);

			User::where('_id', $user->_id)
					->update(
						array(
							'hash'		=> $hash,
							'pass_tmp'	=> Hash::make( $pass )
						),
						array('upsert'=>true));

			// Send an e-mail
			$data = array(
							'link'		=> URL::route('account-recover',$hash),
							'firstname'	=> $user->firstname,
							'password'	=> $pass
						);
			Mail::send('emails.auth.forgot',$data, function ($message) use ($user) {
				$message->to( $user->email, $user->firstname )->subject( 'Your new password' );
			});
			return "We have sent you a new password by email.";
		}

	}

	public function getRecover($hash) {
		$user = User::where('hash','=',$hash)
					->where('pass_tmp','!=','');

		if ( $user->count() ) {
			$user = $user->first();

			$user->password = $user->pass_tmp;
			$user->pass_tmp = '';
			$user->hash 	= '';

			if ( $user->save() ) {
				return Redirect::to('login')
								->with('message','<div class="alert alert-success">Your Account has been recovered and you can sign in with your new password.</div>');
			}
		}
		return Redirect::to('login')
						->with('message','<div class="alert alert-danger">Could not recover your account.</div>');
	}



	public function search($query) {
		$s = User::where('firstname','like','%'.$query.'%')
						->orWhere('lastname','like','%'.$query.'%')
						->get();
		if ( $s->count() ) return $s;
	}
	public function searchGroup($query) {
		return Group::where('name','like','%'.$query.'%')->get();
	}

}