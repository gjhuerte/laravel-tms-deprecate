@extends('admin.maintenance.app')

@section('maintenance-body')
<div class="row p-3">
	<div class="col-sm-12 my-1">
		<h1 class="display-4">Edit: {{ $variable->title }}</h1>
	</div>
	<div class="col-sm-12">
		<ul class="breadcrumb">
			<li class="breadcrumb-item">Maintenance</li>
			<li class="breadcrumb-item">
				<a href="{{ url("$variable->baseUrl") }}">{{ $variable->title }}</a>
			</li>
			<li class="breadcrumb-item">{{ $model->id }}</li>
			<li class="breadcrumb-item active">Edit</li>
		</ul>
	</div>
	<div class="col-sm-12 my-1">
		@include('notification.alert')
		<form method="post" action="{{ url("$variable->formBasePath/$model->id") }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="hidden" name="_method" value="PUT" />
			@include('admin.maintenance.bread.form')
			<div class="form-group float-right">
				<a href="{{ url("$variable->baseUrl") }}" class="btn btn-light">
					<i class="fas fa-arrow-left"></i> Back
				</a>
				
				<input type="submit" name="button" value="Update" class="btn btn-primary" />
			</div>
		</form>
	</div>
</div>
@endsection
