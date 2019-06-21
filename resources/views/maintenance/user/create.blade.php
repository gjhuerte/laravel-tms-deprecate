@extends('layouts.client')

@section('content')

    <div class="container offset-sm-3 col-sm-6 mt-5">
		<div class="row p-3">
			<div class="col-sm-12 my-1">
				<h1 class="display-4">Create User</h1>
			</div>
			
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item">Maintenance</li>
					<li class="breadcrumb-item">
						<a href="{{ route('user.index') }}">User</a>
					</li>
					<li class="breadcrumb-item active">Create</li>
				</ul>
			</div>

			<div class="col-sm-12 my-1">

				@include('notification.alert')

				<form method="post" action="{{ route('user.store') }}">

					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					@include('maintenance.user.partials.form')

					<div class="form-group">
						<label for="username">
							Username
						</label>
							
						<input 
							type="text"
							id="username"
							name="username"
							class="form-control"
							placeholder="e.g. john_doe123"
							value="{{ $user->username ?? old('username') }}"
							max=50
							required
						/>
					</div>

					<div class="form-group">
						<label for="password">
							Password
						</label>
							
						<input 
							type="password"
							id="password"
							name="password"
							class="form-control"
							required
						/>
					</div>
					
					<div class="form-group float-right">
						<a href="{{ route('user.index') }}" class="btn btn-light">
							<i class="fas fa-arrow-left"></i> Back
						</a>

						<button-loading
							element-type="submit"
							element-id="submit-button"
							element-class="btn btn-primary"
							default-text="Save">
						</button-loading>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
