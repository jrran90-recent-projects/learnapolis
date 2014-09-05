<div class="col-md-4">


	@if (Route::currentRouteName() == 'dashboard')

		<div class="panel panel-default">
			<div class="panel-body">
				<a href="{{ URL::to('user',Auth::user()->_id) }}">
				<img src="{{ ($user->image)?URL::asset('uploaded_file/users/50x50/').'/'.$user->image:URL::asset('img/default-user.png') }}"
					 style="margin-right:8px; width:50px; height: 50px"
					 class="pull-left">
				</a>
				<div class="pull-left" style="width:170px">
					<a href="{{ URL::to('user',Auth::user()->_id) }}" style="color:#d7983e"><strong>{{ Auth::user()->firstname,' ',Auth::user()->lastname }}</strong></a><br>
					<!-- Teacher -->
				</div>
			</div>
		</div>


		<div class="list-group" id="groupJoined">
			<p class="list-group-item"><strong>Group</strong>
				<a href="#btnActionGroup" class="pull-right" data-toggle="modal">
					<span class="fa fa-plus-square"></span>
					<small>Add group</small>
				</a>
			</p>

			@if ( is_array($group) )
				@foreach ( $group as $groups )
					<a href="{{ URL::route('group-get', $groups["_id"] ) }}" class="list-group-item">
						<strong>{{ $groups['name'] }}</strong>
						<p class="list-group-item-text"><small>{{ $groups['description'] }}</small></p>
					</a>						
				@endforeach
			@endif

			<!-- <a href="#" class="list-group-item"><small>Show All</small></a> -->
		</div>

		<div class="modal fade" id="btnActionGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<form role="form" id="frmCreateGroup" class="form-horizontal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Create Group</h4>
						</div>

						<div class="modal-body">
							<div class="form-group">
								<div class="col-md-3">Group Name</div>
								<div class="col-md-8">
									<input type="text" name="txtname" class="form-control input-sm" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-3">Description</div>
								<div class="col-md-8">
									<textarea class="form-control input-sm" name="txtdesc" required></textarea>
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
					</div>
				</div>
			</form>
		</div>

<!-- 		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">People Connected</h3>
			</div>

			<div class="panel-body">
				<a href="profile.php?'.$k["userid"].'" data-toggle="tooltip" title="'.$q_u["firstname"].' '.$q_u["lastname"].'">
					<img src="../uploaded_file/user/'.$q_u["image"].'" style="width:40px; height:40px" alt="">
				</a>
			</div>
		</div> -->

		<script src="{{ URL::asset('js/js.group.js') }}"></script>
		<script src="{{ URL::asset('js/js.posts.js') }}"></script>

	@endif



	@if ( Route::currentRouteName() == 'group-get' )

		<div class="panel panel-default">
			<div class="panel-body">
				<img src="{{ URL::asset('img/default-user.png') }}" style="margin-right:8px; width:50px; height: 50px" class="pull-left">
				<div class="pull-left" style="width:170px">
					<strong>{{ $groupDtl->name }}</strong><br>
					Group
				</div>
			</div>
		</div>


		{{-- Group Request --}}
		@if ( $groupDtl->createdBy === Auth::user()->_id )
			@if ( count($memberRequest) != 0 )
				<div class="panel panel-default" id="GroupPanel">
					<div class="panel-heading">
						<h3 class="panel-title">Group Request</h3>
					</div>
					<div class="panel-body">
						<ul class="list-unstyled">
							@foreach ( $memberRequest as $userRequest )
								<li id="user-{{ $userRequest['_id'] }}">
									<a href="#" style="color:#f63;font-weight:bold">{{ $userRequest["firstname"],' ',$userRequest["lastname"] }}</a>
									<div>
										<a href="#" class="btn btn-xs btn-success btnAccept">Accept Request</a>
										<!-- <a href="#" class="btn btn-xs btn-default btnDecline">Decline</a> -->
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			@endif
		@endif

		<script src="{{ URL::asset('js/js.group.js') }}"></script>
		<script src="{{ URL::asset('js/js.groupPost	.js') }}"></script>

	@endif	


	@if ( Route::currentRouteName() == 'messages' )
		<div class="panel panel-default" id="contListFriends">
			<div class="panel-heading">Friends <input type="text" name="s" style="outline:0;margin-left:15px" placeholder="Search a friend.." autocomplete="off"></div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<li>
						<a href="#" data-msg={"uid":"'.$v2.'","t_id":"'.$v["_id"].'"}>
							<strong>'.$q_messageUser["firstname"].' '.$q_messageUser["lastname"].'</strong>
						</a>
					</li>
					<!-- <li><small>No message in inbox yet!</small></li>'; -->

				</ul>
			</div>
		</div>
	@endif

</div>