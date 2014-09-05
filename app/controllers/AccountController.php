<?php

class AccountController extends BaseController {

	public function dashboard() {
		$grp = DB::collection('groups')->where('createdBy', Auth::user()->_id )->get();

		$usr = User::find(Auth::user()->_id);

		return View::make('dashboard.main')
					->with('group', $grp)
					->with('user',	$usr);
	}

	// User Profile
	public function userProfile($id) {
		$user = User::where('_id','=',$id);

		if ( $user->count() ) {
			$user = $user->first();

			$statusCSS 	= 'btn-success';
			$statusMsg 	= 'Add Connection';
			$btnID 		= 'addConnection';

			if ( isset( $user->connections ) ) {
				foreach ($user->connections as $conn) {
					if ( $conn === Auth::id().'-~p' ) {
						$statusCSS 	= 'disabled';
						$statusMsg 	= 'Connection Request';
						$btnID 		= '';
					}
					if ( $conn === Auth::id().'-~a' ) {
						$statusCSS 	= 'btn-danger';
						$statusMsg 	= 'Remove Connection';
						$btnID 		= 'removeConnection';
					}
				}
			}

			// Currently Logged User
			$loggedUser = User::find( Auth::id() );

			$btnContent = '';		// action button
			$btnBoolean = false;

			if ( isset($loggedUser->connections) ) {				
				foreach ($loggedUser->connections as $connections) {
					if ( $connections === $id.'-~p' ) {
						$btnContent = '<div id="ProfileActionContainer">
										<a href="#" class="btn btn-success btnAccept">Accept Request</a>
								 	   <a href="#" class="btn btn-default btnDecline">Decline</a>
								 	   </div>';
						$btnBoolean = true;
					}
				}
			}

			return View::make('profile.user')
						->with('user', $user)
						->with('status', array($statusCSS,$statusMsg,$btnID))
						->with('loggedUser', array($btnContent,$btnBoolean));
		}
		return App::abort(404);
	}


	// Notification
	public function notification () {
		$user = User::find( Auth::id() );

		if ( isset( $user->connections ) ) {
			foreach ($user->connections as $connections) {
				list($id,$status) = explode("-~",$connections);
				if ( $status === "p" ) {
					$user2 = User::find($id); // the requesting user
					echo
						'<li>
							<a href="',URL::route('user-profile',$user2->id),'">
								<strong>',$user2->firstname,' ',$user2->lastname,'</strong> wants to connect with you.</a>
						</li>';
				}
			}
		}
	}
	public function count_noti() {
		$user = User::find(Auth::id());

		if ( isset( $user->connections ) ) {
			foreach ($user->connections as $connections) {
				list($id,$status) = explode("-~",$connections);
				echo ( $status === "p" ) ? count($id) : '';
			}
		}
	}


	/*
	| ----------------
	| Connection Request
	| -------------------------------------------------
	*/
	public function addUser() {
		// Embedded Documents -- still have problem in pulliing
		// as of now just concatenate two data
		User::where('_id',Input::get("id"))->push('connections', array( Auth::id().'-~p' ));
	}
	public function acceptRequest() {
		// change the status if accepted of the current logged user
		$uid = Input::get("uid");

		// Update
		User::where('_id',Auth::id())->pull('connections', $uid.'-~p');
		User::where('_id',Auth::id())->push('connections', array($uid.'-~a'), true);

		User::where('_id',$uid)->push('connections', array(Auth::id().'-~a'), true);
	}
	public function removeUser() {
		$uid = Input::get("id");
		User::where('_id',Auth::id())->pull('connections', $uid.'-~a');
		User::where('_id',$uid)->pull('connections', Auth::id().'-~a');
	}



	public function uploadImage() {
		$userId = Auth::user()->_id;

		$img = Input::file("upl_file");
		$filename = str_random(20).'.'.$img->getClientOriginalExtension();

		// File Image Success
		if ( Image::make($img->getRealPath())->fit(200)->save( public_path('uploaded_file/users/').$filename ) ) {
			Image::make($img->getRealPath())->fit(50)
							->save( public_path('uploaded_file/users/50x50/').$filename );

			$data = array('image'=>$filename);
			User::where('_id',$userId)->update($data, array('upsert'=> true)); // save image from DB
			return Redirect::route('user-profile', $userId);
		}
	}

	public function doBasicInfo() {
		$userId = Auth::user()->_id;

		// Update
		User::where('_id', $userId)
				->update(array(
						'firstname'	=> Input::get('fName'),
						'lastname'	=> Input::get('lName')
					));
	}

	public function doEmail() {
		$userId = Auth::user()->_id;
		User::where('_id', $userId)->update(array('email'=>Input::get('email')));
	}

	public function doPassword() {
		$usr = User::find( Auth::user()->_id );

		if ( Hash::check( Input::get('p'), $usr->password ) ) {
			return Response::json(array('st'=>'ok'));
		}
	}
	public function changePassword() {
		$password = Input::get('p');

		$usr = User::find(Auth::user()->_id);
		$usr->password = Hash::make( $password );
		$usr->save();
	}

	// Education
	public function doEducation() {

		// minimize this
		if ( Input::has("txtothers") ) {
			User::where('_id', Auth::user()->_id)
				->push('education', array(
						'university'	=> Input::get("txtuniv"),
						'degree'		=> Input::get("txtothers"),
						'fieldOfStudy'	=> Input::get("txtc")
					));
		} else {
			User::where('_id', Auth::user()->_id)
				->push('education', array(
						'university'	=> Input::get("txtuniv"),
						'degree'		=> Input::get("cb_degree"),
						'fieldOfStudy'	=> Input::get("txtc")
					));
		}
	}



}