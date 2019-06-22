@extends('layouts.client')

@section('content')
	<div class="container p-4 mt-3">
		<div class="row card card-body">
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

				<form id="ticket-creation-form"
					method="post" 
					data-tags="{{ $tags_string }}"
					action="{{ route('ticket.store') }}"
					class="form-horizontal">
					<div class="row">
						<input 
							type="hidden" 
							name="_token" 
							value="{{ csrf_token() }}" />

						@include('ticket.partials.form')
					</div>

					<div class="form-group float-right">
						<a 
							href="{{ url('ticket') }}" 
							class="btn btn-light">
							<i class="fas fa-arrow-left"></i> 
							Back
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
