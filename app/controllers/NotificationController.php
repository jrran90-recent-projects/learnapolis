<?php

class NotificationController extends BaseController {
	
	// public function notification() {

	// 	$usr = User::find(Auth::user()->_id);

	// 	foreach ($usr->group_joined as $v) {
	// 		$grp = Group::find($v);

	// 		if ( isset($grp->pending_member) ) {
	// 			foreach ($grp->pending_member as $v2) {
	// 				$usr2 = User::find($v2);
	// 				$noti_msg = '<strong>'.$usr2->firstname.' '.$usr2->lastname
	// 							.'</strong> would like to join <strong>'.$grp->name.'</strong>';
	// 				echo '<li><a href="',URL::route('group-get', $v),'">',$noti_msg,'</a></li>';
	// 			}
	// 		}
	// 	}

	// }


	// // Count Notifications
	// public function count_noti () {
	// 	$usr = User::find(Auth::user()->_id);
	// 	$count = 0;

	// 	foreach ($usr->group_joined as $v) {
	// 		$grp = Group::find($v);
	// 		if ( isset($grp->pending_member) ) {
	// 			foreach ($grp->pending_member as $v) {
	// 				$count++;
	// 			}
	// 		}
			
	// 	}
	// 	return ($count!=0)?$count:'';
	// }



	// ------------------------------

	// try to use a controller here
	public function notification() {
		return 'm';
	}





}