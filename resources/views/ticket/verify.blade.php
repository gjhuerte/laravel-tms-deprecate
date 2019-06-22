@extends('layouts.client')

@section('content')
<div class="container p-4 mt-3" style="background-color: white;">
	<div class="row">
		<div class="col-sm-12 my-1">
			<h1 class="display-4">Ticket: Verify</h1>
		</div>

		<div class="col-sm-12">
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ url('/') }}">Home</a>
				</li>

				<li class="breadcrumb-item">
					<a href="{{ url('ticket') }}">Ticket</a>
				</li>

				<li class="breadcrumb-item">
					<a href="{{ route('ticket.show', [ $ticket->id ]) }}">
						{{ $ticket->code }}
					</a>
				</li>
				
				<li class="breadcrumb-item active">Verify</li>
			</ul>
		</div>

		<div class="col-sm-12 my-1">
			@include('notification.alert')

			<form id="ticket-creation-form"
				method="post"
				action="{{ route('ticket.verify', [ $ticket->id ]) }}"
				class="form-horizontal">
				<div class="row">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />

					<div class="col-12 mb-3">
					    <div class="card bg-light rounded-0">
					        <div class="card-header">
					            {{ __('Target Ticket') }}
					        </div>

					        <div class="card-body p-0">
					            <ul class="list-unstyled border-light p-3">
					                <li class="border-bottom pb-3"> 
					                    <strong>Code: </strong> {{ $ticket->code }}
					                </li>
					                <li class="border-bottom py-3"> 
					                    <strong>Title: </strong> {{ $ticket->title }}
					                </li>
					                <li class="border-bottom py-3"> 
					                    <strong>Author: </strong> {{ $ticket->author->full_name }}
					                </li>
					                <li class="border-bottom py-3"> 
					                    <strong>Created At: </strong> {{ $ticket->created_at }}
					                </li>
					                <li class="pt-3"> 
					                    <strong>Current Status: </strong> 

					                    <span class="badge badge-info text-uppercase">
					                        {{ $ticket->status }}
					                    </span>
					                </li>
					            </ul>
					        </div>
					    </div> 
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="details">Details</label>

							<wysiwyg-textarea
								v-bind:element-name="'details'"
								v-bind:element-id="'details'"
								v-bind:element-style="'height: 350px'">
							</wysiwyg-textarea>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row float-right">
						<a href="{{ url('ticket') }}" class="btn btn-light">
							<i class="fas fa-arrow-left"></i> Back
						</a>

						<button-loading
							element-type="submit"
							element-id="submit-button"
							element-class="btn btn-primary"
							default-text="Save">
						</button-loading>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection