<?php

class PostController extends BaseController {

	public function getPost() {

		$loggedUser = User::find( Auth::id() );
		
		if ( Auth::id() ) {
			$post_que = Post::where('post_type','default')
							->where('user_id', Auth::id())
							->orderBy('date_posted','desc');
		}

		// use advance WHERE method in laravel
		if ( isset($loggedUser->connections) ) {
			foreach ($loggedUser->connections as $connections) {

				list($uid,$status) = explode("-~", $connections);

				// problem is it only allows two participants.. hmmm
				if ( $status !== "p" ) {
					$post_que = Post::where('user_id',$uid)
									->orWhere(function($query) {
										$query->where('user_id',Auth::id())
											  ->where('post_type','default');
									})
									->orderBy('date_posted','desc');
				}
			}
		}


		$pst = $post_que->get(); // query for post

		foreach ($pst as $post) {

			$usr = User::find( $post->user_id );

			$file_attached = '<br>
								<a href="'.URL::to('download', $post->attached_file).'"
								   class="downloadFile"
								   style="color:#fb4;cursor:pointer">'.$post->attached_file.'</a>';

			$usr_profile = URL::route('user-profile', $post->user_id);

			$countComment = (count($post->comments) > 1) ? count($post->comments).' Comments' : count($post->comments).' Comment';

			$usr_img = ( isset($usr->image) ) ? 'naa' : 'wala';

			// Show thumbnail
			if ( isset($usr->image) ) {
				$thumbnail = '<img src="'.URL::asset('uploaded_file/users/50x50').'/'.$usr->image.'">';
			} else {
				$thumbnail = '<span class="fa fa-user fa-3x"></span>';
			}


			if ( isset ($usr) ) {
				echo
					'<div class="contCustomParent post" id="post-',$post->_id,'">
						<div class="contCustom" style="overflow:hidden">
							<a href="#" class="pull-left',((!isset($usr->image))?' user-img':''),'" style="margin-right:10px">
								',$thumbnail,'
							</a>
							<div class="rightPost pull-left">
								<a href="',URL::route('user-profile', $usr->_id),'" style="font-size:18px;display:block">
									<strong>',$usr->firstname,' ',$usr->lastname,'</strong>
								</a>',

								$post->description,$file_attached

								,'<ul class="list-inline post-option">
									<li><a href="#" class="linkComment">',$countComment,'</a></li>
									<!--<li><a href="#">Share</a></li>-->
									<li><small>',date('M d, Y', $post->date_posted->sec),'</small></li>
								</ul>

								<div class="post-comment hide">
									<form class="frm_cmt">
										<input type="text" name="txtcmt" class="form-control input-sm"
											   placeholder="Post a comment">
									</form>
									<ul class="lst_cmt list-unstyled"></ul>
								</div>
							</div>
						</div>
					</div>';
			}
		}

	}

	public function doPost() {

		if (Input::hasFile('uploadedFile')) {

			$allowed 	= array('png','jpg','gif','doc','docx');
			$max_size 	= 2000 * 1024;

			$path = public_path(). '/uploaded_file/'; // upload directory
			$file = Input::file('uploadedFile');

			$ext  = $file->guessClientExtension();
			$size = $file->getClientSize();
			$name = $file->getClientOriginalName();

			// $fileName = str_random(20) . '.' . $ext;

			// if ( in_array($ext, $allowed) && $size < $max_size ) {

				if ( $file->move($path, $name) ) {
					DB::collection('posts')->insert(
						array(
							'_id'			=> time().rand(100,999),
							'user_id'		=> Auth::user()->_id,
							'description'	=> Input::get('txt'),
							'attached_file' => $name,
							'date_posted'	=> new MongoDate(),
							'post_type'		=> 'default'
							)
						);
					exit;
				}

			// }

		}

		// If no file were attached
		DB::collection('posts')->insert(
				array(
					'_id'			=> time().rand(100,999),
					'user_id'		=> Auth::user()->_id,
					'description'	=> Input::get('txt'),
					'date_posted'	=> new MongoDate(),
					'post_type'		=> 'default'
					)
				);

	}


	/*
	| Comments
	*/
	public function doComment() {
		DB::collection('posts')
				->where('_id',Input::get("pid"))
				->push('comments',
					array(
						'by'		=> Auth::user()->_id,
						'comment'	=> Input::get("cmnt"),
						'date'		=> new MongoDate()
						));
	}
	public function getComment() {
		$pst = Post::find(Input::get("pid"));

		if ( isset( $pst->comments ) ) {
			foreach ($pst->comments as $v_comments) {
				$usr = User::find($v_comments["by"]);
				echo
					'<li>
						<a href="',URL::route('user-profile', $usr->_id),'"><strong>',$usr->firstname,' ',$usr->lastname,'</strong></a> <span>',date('M d Y', $v_comments["date"]->sec),'</span>
						<p>',$v_comments["comment"],'</p>
					</li>';
			}
		}
	}

	// Download
	public function getDownload($filename) {
		$file = public_path().'/uploaded_file/'.$filename;

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));

		readfile($file);
	}



	/*
		=====================================
			Group Post
		=====================================
	*/
	public function doGroupPost() {

		if (Input::hasFile('uploadedFile')) {

			$allowed 	= array('png','jpg','gif','doc','docx');
			$max_size 	= 2000 * 1024;

			$path = public_path(). '/uploaded_file/group/'; // upload directory
			$file = Input::file('uploadedFile');

			$ext  = $file->guessClientExtension();
			$size = $file->getClientSize();
			$name = $file->getClientOriginalName();

			// $fileName = str_random(20) . '.' . $ext;

			if ( $file->move($path, $name) ) {
				DB::collection('posts')->insert(
					array(
						'_id'			=> time().rand(100,999),
						'user_id'		=> Auth::user()->_id,
						'description'	=> Input::get('txt'),
						'attached_file' => $name,
						'date_posted'	=> new MongoDate(),
						'post_type'		=> 'group',
						'group_id'		=> Input::get('gid')
						)
					);
				exit;
			}

		}

		// If no file were attached
		DB::collection('posts')->insert(
				array(
					'_id'			=> time().rand(100,999),
					'user_id'		=> Auth::user()->_id,
					'description'	=> Input::get('txt'),
					'date_posted'	=> new MongoDate(),
					'post_type'		=> 'group',
					'group_id'		=> Input::get('gid')
					)
				);
	}

	public function getGroupPost() {

		$pst = Post::where('group_id', Input::get('gid'))
					->orderBy('date_posted','desc')
					->get();

		foreach ($pst as $groupPost) {
			$usr = User::find( $groupPost->user_id );

			$file_attached = '<br>
								<a href="'.URL::to('download', $groupPost->attached_file).'"
								   class="downloadFile"
								   style="color:#fb4;cursor:pointer">'.$groupPost->attached_file.'</a>';								

			$usr_profile = URL::route('user-profile', $groupPost->user_id);

			$countComment = (count($groupPost->comments) > 1) ? count($groupPost->comments).' Comments' : count($groupPost->comments).' Comment';

			$usr_img = ( isset($usr->image) ) ? 'naa' : 'wala';

			// Show thumbnail
			if ( isset($usr->image) ) {
				$thumbnail = '<img src="'.URL::asset('uploaded_file/users/50x50').'/'.$usr->image.'">';
			} else {
				$thumbnail = '<span class="fa fa-user fa-3x"></span>';
			}

			if ( isset ($usr) ) {
				echo '<div class="contCustomParent post" id="post-',$groupPost->_id,'">
							<div class="contCustom" style="overflow:hidden">
								<a href="#" class="pull-left',((!isset($usr->image))?' user-img':''),'" style="margin-right:10px">
									',$thumbnail,'
								</a>
								<div class="rightPost pull-left">
									<a href="#" style="font-size:18px;display:block">
										<strong>',$usr->firstname,' ',$usr->lastname,'</strong>
									</a>',

									$groupPost->description,$file_attached

									,'<ul class="list-inline post-option">
										<li><a href="#" class="linkComment">',$countComment,'</a></li>
										<li><a href="#">Share</a></li>
										<li>',date('M d, Y', $groupPost->date_posted->sec),'</li>
									</ul>

									<div class="post-comment hide">
										<form class="frm_cmt">
											<input type="text" name="txtcmt" class="form-control input-sm"
												   placeholder="Post a comment">
										</form>
										<ul class="lst_cmt list-unstyled"></ul>
									</div>
								</div>
							</div>
						</div>';

				}
		}

	}

}