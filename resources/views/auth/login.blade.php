@extends('layouts.guest-master')
@section('content')

<section class="content">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>SHIPPING PERMIT</b></a>
		</div>
		<div>
			@if(Session::has('AUTH_AUTHENTICATED'))
				{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('AUTH_AUTHENTICATED')) !!}
			@endif

			@if(Session::has('AUTH_UNACTIVATED'))
				{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('AUTH_UNACTIVATED')) !!}
			@endif

			@if(Session::has('CHECK_UNAUTHENTICATED'))
				{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_UNAUTHENTICATED')) !!}
			@endif

			@if(Session::has('CHECK_NOT_ACTIVE'))
				{!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', Session::get('CHECK_NOT_ACTIVE')) !!}
			@endif

			@if(Session::has('PROFILE_UPDATE_USERNAME_SUCCESS'))
				{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_USERNAME_SUCCESS')) !!}
			@endif

			@if(Session::has('PROFILE_UPDATE_PASSWORD_SUCCESS'))
				{!! __html::alert('success', '<i class="icon fa fa-check"></i> Success!', Session::get('PROFILE_UPDATE_PASSWORD_SUCCESS')) !!}
			@endif
		</div>

		<div class="login-box-body" style="display: flex;">
			<!-- Form Container -->
			<div style="flex: 1;">
				<p class="login-box-msg"><b>SRA - WEB PORTAL | LOGIN</b></p>

				<form method="POST" action="{{ route('auth.login') }}">
					@csrf
					@if ($errors->has('username'))
						<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
					<div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
						<div class="input-group" style="width: 100%">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input class="form-control is-invalid" name="username" id="username" placeholder="Username" type="text" value="{{ __sanitize::html_attribute_encode(old('username')) }}" style="width: 100%;">
						</div>
					</div>
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
					<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
						<div class="input-group" style="width: 100%">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" name="password" id="password" placeholder="Password" type="password" style="width: 100%;">
						</div>
					</div>


					<br>
					<div class="row">
						<div class="col-xs-12">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
						</div>
					</div>
				</form>
			</div>
			<!-- Image Container -->
			<div class="image-container" style="flex: 1; text-align: center; padding-right: 10px;">

				<img src="{{ asset('images/sra.png') }}" alt="Login Image" style="max-width: 100%; height: auto;">
			</div>
		</div>
	</div>


</section>
@endsection
