@extends('layouts.client')

@section('content')

    <div class="container offset-sm-3 col-sm-6 mt-5">
		<div class="row p-3">
			<div class="col-sm-12 my-1">
				<h1 class="display-4">
					{{ __('Create Level') }}
				</h1>
			</div>
			
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item">Maintenance</li>
					<li class="breadcrumb-item">
						<a href="{{ route('level.index') }}">Level</a>
					</li>
					<li class="breadcrumb-item active">Create</li>
				</ul>
			</div>

			<div class="col-sm-12 my-1">

				@include('notification.alert')

				<form method="post" action="{{ route('level.store') }}">

					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					@include('maintenance.level.partials.form')
					
					<div class="form-group float-right">
						<a href="{{ route('level.index') }}" class="btn btn-light">
							<i class="fas fa-arrow-left"></i> Back
						</a>

						<input type="submit" name="button" value="Save" class="btn btn-primary" />
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
