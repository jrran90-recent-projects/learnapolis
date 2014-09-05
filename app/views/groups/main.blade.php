@extends('layouts.main')

@section('title') Dashboard @stop

@section('content')

	@include('layouts.sidebar')

		<div class="col-md-8">

			@if ( $groupExist )

				<div class="contCustomParent">
					<div class="contCustom">
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#tab_postNotes" role="tab" data-toggle="tab"><span class="fa fa-edit"></span> Post Notes</a></li>
							<!-- <li><a href="#tab_assignment" role="tab" data-toggle="tab"><span class="fa fa-check-circle"></span> Assignment</a></li>
							<li><a href="#tab_quiz" role="tab" data-toggle="tab"><span class="fa fa-question-circle"></span> Quiz</a></li>
							<li><a href="#tab_survey" role="tab" data-toggle="tab"><span class="fa fa-tasks"></span> Survey</a></li> -->
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tab_postNotes">
								<form role="form" id="frmUpdateStatus" method="POST" action="{{ URL::to('group-post-add') }}" enctype="multipart/form-data">
									<textarea class="form-control" rows="1" placeholder="Share something.."
											  name="txt"></textarea>
									<div class="hide action">
										<ul class="list-inline pull-left" style="margin-top:5px">
											<li>
												<span class="btn btn-success fileinput-button btn-sm">
													<i class="glyphicon glyphicon-link"></i>
													<span class="upl_file">Attach file</span>
													<input type="file" name="uploadedFile" multiple>
												</span>										
											</li>
											<!-- <li><a href="#" title="Link"><span class="fa fa-link fa-lg"></span> Link</a></li> -->
										</ul>
										<input type="submit" class="form-control" value="Share">
									</div>
								</form>
								<div id="progress" class="progress hide" style="height:3px; width:70%; margin-bottom:5px">
									<div class="progress-bar progress-bar-success"></div>
								</div>
							</div>
							<div class="tab-pane fade" id="tab_assignment">
								assignment
							</div>
							<div class="tab-pane fade" id="tab_quiz">
								quiz
							</div>
							<div class="tab-pane fade" id="tab_survey">
								survey
							</div>
						</div>
					</div>
				</div>

				<div class="contCustomParent">
					<div class="contCustom">
						<ul class="nav nav-pills" role="tablist">
							<li class="active"><a href="#tab_opt1" role="tab" data-toggle="tab">Latest Posts</a></li>
							<!-- <li><a href="#tab_opt2" role="tab" data-toggle="tab">Assignments</a></li>
							<li><a href="#tab_opt3" role="tab" data-toggle="tab">Quizzes</a></li>
							<li><a href="#tab_opt4" role="tab" data-toggle="tab">Surveys</a></li> -->
						</ul>
					</div>
				</div>

				<div class="tab-content" id="post_tab_option">
					<div class="tab-pane fade active in" id="tab_opt1"></div>
					<div class="tab-pane fade" id="tab_opt2">
						Assignments
					</div>
					<div class="tab-pane fade" id="tab_opt3">
						Quizzes
					</div>
					<div class="tab-pane fade" id="tab_opt4">
						Surveys
					</div>
				</div>

			@else

				<div class="panel panel-default">
					<div class="panel-heading">
						Info
						<ul class="list-inline pull-right">
							<li><a href="#" class="btn btn-xs btn-default {{ $isDisabled }}" id="btnJoinGroup">{{ $isDisabledTxt }}</a></li>
							<!-- <li><a href="#" class="btn btn-xs btn-default">Create Group</a></li> -->
						</ul>
					</div>
					<div class="panel-body">
						<strong>Description</strong><br>
						<p>{{ $groupDtl->description }}</p>
					</div>
				</div>

			@endif

		</div>

		<script src="{{ URL::asset('js/js.dashboard.js') }}"></script>

@stop