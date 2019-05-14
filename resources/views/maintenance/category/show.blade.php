@extends('layouts.client')

@section('content')

    <div class="container offset-sm-3 col-sm-6 mt-5">

		<div class="row p-3" style="background-color: white;">
			<div class="col-sm-12 my-1">
				<h1 class="display-4">Category: {{ $category->name }}</h1>
			</div>
			
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item">Maintenance</li>
					<li class="breadcrumb-item">
						<a href="{{ route('category.index') }}">Category</a>
					</li>
					<li class="breadcrumb-item active">{{ $category->name }}</li>
				</ul>
			</div>

			<div class="col-sm-12 my-1">
				@include('notification.alert')

				<div class="form-group">
					<strong>Name</strong> <pre>{{ $category->name }}</pre>
				</div>

				<div class="form-group">
					<strong>Description</strong>
					<pre>{{ $category->description ?? 'Not Set' }}</pre>
				</div>

				<div class="form-group">
					<strong>Created At</strong>
					<pre>{{ $category->created_at ?? 'Not Set' }}</pre>
				</div>

				<div class="form-group">
					<strong>Updated At</strong>
					<pre>{{ $category->updated_at ?? 'Not Set' }}</pre>
				</div>
			</div>
		</div>
	</div>
@endsection 
