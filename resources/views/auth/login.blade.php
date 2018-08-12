@extends('layouts.app')

@section('content')
<div class="offset-md-4 col-md-4 mt-5 pt-5">
	<div class="card">
		<div class="card-header">
			<strong> Ticketing Management System </strong>
		</div>
		<div class="card-body">
			@include('notification.alert')
			<form method="post" action="{{ url('login') }}" class="form-horizontal">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="form-group">
					<label 
						for="username"> Username
					</label>
					<input 
						type="username" 
						name="username" 
						value="{{ old('username') }}" 
						id="username"
						class="form-control"
						placeholder="Enter username here..." />
				</div>
				<div class="form-group">
					<label 
						for="password"> Password
					</label>
					<input 
						type="password" 
						name="password" 
						value="{{ old('password') }}" 
						id="password"
						class="form-control"
						placeholder="Enter password here..." />
				</div>
				<div class="form-group">
					<button 
						type="submit" 
						id="submit-button" 
						class="btn btn-primary btn-block"> Submit
					</button>
				</div>
				<div class="col-sm-12 text-center">
					<a 
						href="{{ url('password/reset') }}"
						id="forgot-password"
						class="text-primary"> Forgot Password?
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection