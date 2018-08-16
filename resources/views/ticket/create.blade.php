@extends('layouts.app')

@section('content')
<div class="container p-4 mt-3" style="background-color: white;">
	<div class="row">
		<div class="col-sm-12 my-1">
			<h1 class="display-4">Ticket: Create</h1>
		</div>
		<div class="col-sm-12">
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ url('ticket') }}">Ticket</a>
				</li>
				<li class="breadcrumb-item active">Create</li>
			</ul>
		</div>
		<div class="col-sm-12 my-1">
			@include('notification.alert')
			<form method="post" action="">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				@include('ticket.form')
				<div class="form-group float-right">
					<a href="{{ url('ticket') }}" class="btn btn-light">
						<i class="fas fa-arrow-left"></i> Back
					</a>
					<input type="submit" name="button" value="Save" class="btn btn-primary" />
				</div>
			</form>
		</div>
	</div>
</div>
@endsection