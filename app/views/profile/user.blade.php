@extends('layouts.main')

@section('title') Profile @stop

@section('content')


<div class="container container-960 mainProfile">

	<div class="row">
		<div class="col-md-3">
			<form id="frmuploadImg" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
				  action="{{ URL::to('user/upload') }}">

				<div class="fileinput fileinput-new" data-provides="fileinput" style="position:relative">
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height:200px; margin-bottom:5px; overflow:hidden">
						<img src="{{ URL::asset('uploaded_file/users/'),'/',$user->image }}" style="width:200px;height:200px">
					</div>

					@if ( Auth::id() === $user->_id )
					<div style="position:absolute; bottom:5px; left:5px">
						<span class="btn btn-default fileinput-button btn-sm pull-left" style="margin-right:5px">
							<i class="glyphicon glyphicon-picture"></i>
							<span class="upl_file">Upload Image</span>
							<input type="file" name="upl_file">
						</span>
						<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
					@endif

				</div>
			</form>

			@if ( Auth::id() !== $user->_id )
				{{ $loggedUser[0] }}
				@if ( !$loggedUser[1] )
				<button type="button" id="{{ $status[2] }}" class="btn {{ $status[0] }}" style="width:200px">{{ $status[1] }}</button>
				@endif
			@endif


			<div id="wrapConnect"></div>
		</div>

		<div class="col-md-8" id="container_profile">
			<fieldset>
				<legend><strong><em>Basic Information</em></strong></legend>

				{{-- Copy the style of Facebook :) --}}
				<form class="form-horizontal" role="form" id="frmBasicInformation">
					<div class="fullNameContainer">
						<div class="form-group firstNameContainer">
							<label class="col-sm-2 control-label">Full Name</label>
							<div class="col-sm-8">
								<span class="pull-left" style="margin-top:7px">{{ $user->firstname,' ',$user->lastname }}</span>
								@if ( Auth::user()->_id === $user->_id )<a href="#" class="pull-left" style="margin-top:10px;font-size:12px;margin-left:10px">Edit</a>@endif
								<input type="text" class="form-control hide input-sm"
									   name="txtFirstName" value="{{ $user->firstname }}">
							</div>
						</div>
						@if ( Auth::user()->_id === $user->_id )
						<div class="form-group hide lastNameContainer">
							<label class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control input-sm"
									   name="txtLastName" value="{{ $user->lastname }}">
							</div>
						</div>
						<div class="form-group hide btnSaveContainer">
							<div class="col-sm-8 col-sm-offset-2">
								<button type="button" value="Save Changes"
										class="btn btn-sm btn-success btnSave">Save Changes</button>
								<button type="button" class="btn btn-sm btnCancel">Cancel</button>
							</div>
						</div>
						@endif
					</div>

					{{-- Email Container --}}
					<div class="emailContainer">
						<div class="form-group">
							<label class="col-sm-2 control-label">E - Mail</label>
							<div class="col-sm-8">
								<span class="pull-left" style="margin-top:7px">{{ $user->email }}</span>
								@if ( Auth::user()->_id === $user->_id )<a href="#" class="pull-left" style="margin-top:10px;font-size:12px;margin-left:10px">Edit</a>@endif
								<input type="email" class="form-control input-sm hide"
									   name="txtEmail" value="{{ $user->email }}">
							</div>
						</div>
						@if ( Auth::user()->_id === $user->_id )
						<div class="form-group hide btnSaveContainer">
							<div class="col-sm-8 col-sm-offset-2">
								<button type="button" value="Save Changes"
										class="btn btn-sm btn-success btnSave">Save Changes</button>
								<button type="button" class="btn btn-sm btnCancel">Cancel</button>
							</div>
						</div>
						@endif
					</div>

					@if ( Auth::user()->_id === $user->_id )
					<div class="passwordContainer">
						<div class="form-group">
							<label class="col-sm-2 control-label">Password</label>
							<div class="col-sm-6">
								<a href="#" class="pull-left" style="margin-top:10px;font-size:12px;margin-left:10px">Change Password</a>
								<input type="password" class="form-control input-sm hide"
									   name="txtcurPass" placeholder="Type Password and hit <enter>">
							</div>
						</div>
						<div class="reTypePasswordContainer hide">
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
									<input type="password" class="form-control input-sm"
										   name="txtnewPass" placeholder="New Password">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
									<input type="password" class="form-control input-sm"
										   name="txtreTypePass" placeholder="Re-type new password">
								</div>
							</div>
							<div class="form-group btnSaveContainer">
								<div class="col-sm-8 col-sm-offset-2">
									<button type="button" value="Save Changes"
											class="btn btn-sm btn-success btnSave">Save Changes</button>
									<button type="button" class="btn btn-sm btnCancel">Cancel</button>
								</div>
							</div>
						</div>
					</div>
					@endif
				</form>

			</fieldset>




			{{-- Education Container --}}
			<fieldset>
				<legend><strong>Education</strong>
					@if ( Auth::user()->_id === $user->_id )<a href="#modal_education" data-toggle="modal" class="pull-right" title="Edit Education"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a>@endif
				</legend>

				<div id="educationContainer">

					@if ( isset($user->education) )
						@foreach ( $user->education as $education )
							<div class="container" style="margin-bottom:15px">
								<div class="row">
									<div class="col-md-5"><label>University Attended</label></div>
									<div class="col-md-7">{{ $education["university"] }}</div>
								</div>
								<div class="row">							
									<div class="col-md-5"><label>Degree</label></div>
									<div class="col-md-7">{{ $education["degree"] }}</div>
								</div>
								<div class="row">
									<div class="col-md-5"><label>Field of Study</label></div>
									<div class="col-md-7">{{ $education["fieldOfStudy"] }}</div>
								</div>
							</div>
						@endforeach
					@endif

					@if ( Auth::user()->_id === $user->_id )<a href="#modal_education" data-toggle="modal">Click here to add education</a>@endif
				</div>
			</fieldset>
		</div>

	</div>

</div>




<div class="modal fade" id="modal_education" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        	<h4 class="modal-title" id="myModalLabel">Education</h4>
      		</div>

      		<form class="form-horizontal" role="form" id="frm_pro_educ">
	      		<div class="modal-body">

	      			<div class="form-group">
						<label class="col-sm-3 control-label">University</label>
						<div class="col-sm-8">
							<input type="text" name="txtuniv" class="form-control">
						</div>
					</div>

	      			<div class="form-group">
						<label class="col-sm-3 control-label">Degree</label>
						<div class="col-sm-8">
							<select name="cb_degree" class="form-control">
								<option value="">---</option>
								<option value="High School">High School</option>
								<option value="Associate's Degree">Associate's Degree</option>
								<option value="Bachelors Degree">Bachelors Degree</option>
								<option value="Master's Degree">Master's Degree</option>
								<option value="Master of Business Administration (M.B.A.)">Master of Business Administration (M.B.A.)</option>
								<option value="Juris Doctor(J.D.)">Juris Doctor(J.D.)</option>
								<option value="Doctor of Medicine (M.D.)">Doctor of Medicine (M.D.)</option>
								<option value="Doctor of Philosophy (Ph.D.)">Doctor of Philosophy (Ph.D.)</option>
								<option value="Engineer's Degree">Engineer's Degree</option>
								<option value="Other">Other</option>
							</select>
						</div>
					</div>

	      			<div class="form-group hide">
						<label class="col-sm-3 control-label">Others</label>
						<div class="col-sm-8"><input name="txtothers" class="form-control"></div>
					</div>					


	      			<div class="form-group hide">
						<label class="col-sm-3 control-label">Field of Study</label>
						<div class="col-sm-8"><input type="text" name="txtc" class="form-control"></div>
					</div>			

	      		</div>

	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-primary btnSubmit btnSave">Save</button>
	        		<!-- <button type="button" class="btn btn-default btnSubmit btnSaveAnother">Save and Add another</button> -->
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>

			</form>


    	</div>
  	</div>
</div>

<script src="{{ URL::asset('js/js.profile.js') }}"></script>

@stop