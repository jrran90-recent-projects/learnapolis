@extends('template.tpl_logReg')

@section('title') Login @stop

@section('content')

	<div id="wrap_login">
		<header><a href="{{ URL::to('/') }}"><img src="{{ URL::asset('img/logo.png') }}" alt="learnapolis"></a></header>

		{{ Session::get('message') }}
		
		<div class="wrap-content">
			<form role="form" method="POST" action="{{ URL::route('login-post') }}" autocomplete="off">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control"
						   name="email"{{ (Input::old('email'))?' value="'.Input::old('email').'"':'' }}
						   required autofocus>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password">
				</div>

				<div class="form-group">
					<ul class="list-unstyled">
						<li><a href="#m_fp" data-toggle="modal">Forgot password?</a></li>
						<li><a href="{{ URL::to('register') }}">Create Free Account</a></li>
					</ul>
					<button type="submit" class="btn btn-primary">Log In</button>
				</div>

				{{ Form::token() }}
			</form>
		</div>

	</div>


	{{-- Modal [Forgot Password]--}}
	<div class="modal fade" id="m_fp" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" style="width:500px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Reset your password?</h4>
				</div>
				<div class="modal-body">
					<p>Enter email address below and we'll send you instructions on how to reset your password.</p>
					<form id="frm_fp">
						<div class="input-group">
							<input type="email" class="form-control" placeholder="Enter your Email Address" name="email">
							<div class="input-group-btn"><button type="submit" class="btn btn-success">Reset Password</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<strong>Having problem?</strong> Check out our <a href="#">help center</a>.
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script src="{{ URL::asset('js/js.forgotPassword.js') }}"></script>

@stop