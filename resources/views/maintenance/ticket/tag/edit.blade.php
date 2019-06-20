@extends('layouts.client')

@section('content')
    <div class="container offset-sm-3 col-sm-6 mt-5">
		<div class="row p-3">
			<div class="col-sm-12 my-1">
				<h1 class="display-4">Edit Ticket Tag</h1>
			</div>
			
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item">Maintenance</li>
					<li class="breadcrumb-item">
						<a href="{{ route('ticket.tag.index') }}">Ticket Tag</a>
					</li>
					<li class="breadcrumb-item">{{ $tag->name }}</li>
					<li class="breadcrumb-item active">Edit</li>
				</ul>
			</div>
		
			<div class="col-sm-12 my-1">
		
				@include('notification.alert')
		
				<form method="post" action="{{ route('ticket.tag.update', $tag->id) }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="_method" value="PUT" />
					@include('maintenance.ticket.tag.partials.form')
					
					<div class="form-group float-right">
						<a href="{{ route('ticket.tag.index') }}" class="btn btn-light">
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
