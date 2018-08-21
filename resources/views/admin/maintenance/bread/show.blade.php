@extends('admin.maintenance.app')

@section('maintenance-body')
@include('notification.alert')
<div class="row p-3" style="background-color: white;">
	<div class="col-sm-12 my-1">
		<h1 class="display-4">Edit: {{ $variable->title }}</h1>
	</div>
	<div class="col-sm-12">
		<ul class="breadcrumb">
			<li class="breadcrumb-item">Maintenance</li>
			<li class="breadcrumb-item">
				<a href="{{ url("$variable->baseUrl") }}">Category</a>
			</li>
			<li class="breadcrumb-item">{{ $model->id }}</li>
			<li class="breadcrumb-item active">Edit</li>
		</ul>
	</div>
	<div class="col-sm-12 my-1">
		@include('notification.alert')
		@foreach( $variable->columns as $key => $args )
            @if($args->isSelectable)
			<div class="form-group">
				@php $name = $args->dataTableName @endphp
				<strong> {{ ucfirst($args->name) }} </strong> : {{ $model->$name }}
			</div>
            @endif
		@endforeach
		<div class="form-group float-right">
			<a href="{{ url("$variable->baseUrl") }}" class="btn btn-light">
				<i class="fas fa-arrow-left"></i> Back
			</a>
			<input type="submit" name="button" value="Update" class="btn btn-primary" />
		</div>
	</div>
</div>
@endsection 