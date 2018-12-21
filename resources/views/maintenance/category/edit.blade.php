@extends('layouts.app')

@section('content')
<div class="row p-3" style="background-color: white;">
	<div class="col-sm-12 my-1">
		<h1 class="display-4">Category</h1>
	</div>
	
	<div class="col-sm-12">
		<ul class="breadcrumb">
			<li class="breadcrumb-item">Maintenance</li>
			<li class="breadcrumb-item">
				<a href="{{ route('category.index') }}">Category</a>
			</li>
			<li class="breadcrumb-item active">Create</li>
		</ul>
	</div>

	<div class="col-sm-12 my-1">

		@include('notification.alert')

		<form method="post" action="">

		<form method="post" action="{{ route('category.update', $category->id) }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="hidden" name="_method" value="PUT" />
			@include('maintenance.bread.form')
			
			<div class="form-group float-right">
				<a href="{{ route('category.index') }}" class="btn btn-light">
					<i class="fas fa-arrow-left"></i> Back
				</a>

				<input type="submit" name="button" value="Save" class="btn btn-primary" />
			</div>
		</form>
	</div>
</div>
@endsection
