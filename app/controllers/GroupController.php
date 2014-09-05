<?php

class GroupController extends BaseController {

	public function createGroup() {
		$userID = Auth::user()->_id; // current logged on user

		if ( Request::ajax() ) {

			$g_id = time().rand(10,99);
			$g_name = preg_replace('/\s+/', ' ', trim(Input::get('txtname')));

			// Insert to Groups
			DB::collection('groups')->insert(
					array(
						'_id'			=> $g_id,
						'name'			=> $g_name,
						'description'	=> trim(Input::get('txtdesc')),
						'dateCreated'	=> new MongoDate(),
						'createdBy'		=> $userID
						)
					);

			// Insert to Users
			DB::collection('users')
					->where('_id', $userID)
					->push('group',
							array(
								'id' 		 	=> $g_id,
								'group_name' 	=> $g_name,
								'date_joined'	=> new MongoDate()
								// 'description'	=>
							));

			return URL::route('group-get', $g_id);
		}
	}

	public function getGroup($id) {

		$grp = Group::find($id);
		$usr = User::find( Auth::user()->_id );

		$isMember = false;

		if ( $grp->count() ) {
			if ( isset( $usr->group_joined ) ) {
				foreach ($usr->group_joined as $v ) {
					// Check if group exist then post for group is enabled, else,
					// you have to join
					if ( $id == $v ) $isMember = true;
				}
			}

			// button disabled
			$isDisabled 	= '';
			$isDisabledTxt 	= 'Join Group';

			if ( isset($grp->pending_member) ) {
				foreach ($grp->pending_member as $v) {
					if ( $v == Auth::user()->_id ) {
						$isDisabled 	= 'disabled';
						$isDisabledTxt 	= 'Awaiting confirmation';
					}
				}
			}


			/*
			| Loop Group Request
			*/
			$memberRequest = [];
			if ( isset($grp->pending_member) ) {
				foreach ($grp->pending_member as $v) {
					if ( $v !== Auth::user()->_id ) {
						$memberRequest[] = User::find( $v );
					}
				}
			}

			return View::make('groups.main')
							->with('groupDtl',	 $grp)
							->with('usr',		 $usr)
							->with('groupExist', $isMember)		// check if already a member

							// Group
							->with('isDisabled', 	$isDisabled)
							->with('isDisabledTxt', $isDisabledTxt)

							->with('memberRequest', $memberRequest);
		}
	}


	/*
		---- Join Group
	*/
	public function joinGroup() {
		if ( Request::ajax() ) {

			$grp = Group::find( Input::get('g_id') );

			if ( isset($grp->pending_member) ) {
				foreach ( $grp->pending_member as $v ) {
					if ( $v == Auth::user()->_id ) {
						return Response::json(array('msg' => 'Awaiting confirmation'));						
					}
				}
				Group::where('_id', Input::get('g_id'))
						->push('pending_member', Auth::user()->_id, true);
				return Response::json(array('msg' => 'Awaiting confirmation'));
			}

			Group::where('_id', Input::get('g_id'))
					->push('pending_member', Auth::user()->_id, true);
			return Response::json(array('msg' => 'Awaiting confirmation'));
		}
	}


	/*
	| Group Request
	*/
	public function groupRequest () {

		$uid = Input::get('userId');
		$gid = Input::get('grpId');

		$grp = Group::find( $gid );

		if ( isset( $grp->pending_member ) ) {
			foreach ($grp->pending_member as $v) {
				if ( $v === $uid ) {
					Group::where('_id',$gid)->pull('pending_member',$uid);	// unset
					User::where('_id',$uid)->push('group_joined',$gid);		// set
				}
			}
		}

	}



}