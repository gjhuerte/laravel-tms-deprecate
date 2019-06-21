@extends('layouts.client')

@section('content')

    <div class="container offset-sm-3 col-sm-6 mt-5">
		<div class="row p-3">
			<div class="col-sm-12 my-1">
				<h1 class="display-4">
					{{ __('Create Organization') }}
				</h1>
			</div>
			
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item">Maintenance</li>
					<li class="breadcrumb-item">
						<a href="{{ route('organization.index') }}">Organization</a>
					</li>
					<li class="breadcrumb-item active">Create</li>
				</ul>
			</div>

			<div class="col-sm-12 my-1">

				@include('notification.alert')

				<form method="post" action="{{ route('organization.store') }}">

					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					@include('maintenance.user.organization.partials.form')
					
					<div class="form-group float-right">
						<a href="{{ route('organization.index') }}" class="btn btn-light">
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
