@extends('layouts.app')

@section('content')

	@include('notification.alert')

	<div class="row p-3" style="background-color: white;">
		<div class="col-sm-12 my-1">
			<h1 class="display-4">Category: {{ $category->name }}</h1>
		</div>
		
		<div class="col-sm-12">
			<ul class="breadcrumb">
				<li class="breadcrumb-item">Maintenance</li>
				<li class="breadcrumb-item">
					<a href="">Category</a>
				</li>
				<li class="breadcrumb-item">{{ $category->id }}</li>
				<li class="breadcrumb-item active">Edit</li>
			</ul>
		</div>

		<div class="col-sm-12 my-1">
			@include('notification.alert')

			<div class="form-group">
				<strong> </strong> : 
			</div>
			
			<div class="form-group float-right">
				<a href="" class="btn btn-light">
					<i class="fas fa-arrow-left"></i> Back
				</a>
				<input type="submit" name="button" value="Update" class="btn btn-primary" />
			</div>
		</div>
	</div>
@endsection 
