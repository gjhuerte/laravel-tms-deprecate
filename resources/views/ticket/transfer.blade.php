@extends('layouts.client')

@section('styles-include')
<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap2.css') }}">
@endsection

@section('content')
<div class="container p-4 mt-3" style="background-color: white;">
	<div class="row">
		<div class="col-sm-12 my-1">
			<h1 class="display-4">Ticket: Transfer</h1>
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
				
				<li class="breadcrumb-item active">Transfer</li>
			</ul>
		</div>

		<div class="col-sm-12 my-1">
			@include('notification.alert')

			<form id="ticket-creation-form"
				method="post"
				action="{{ route('ticket.close', [ $ticket->id ]) }}"
				class="form-horizontal">
				<div class="row">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />

					@include('ticket.partials.list_ticket')

                    <div class="col-sm-12">
						<div class="form-group">
							<label for="title">Title</label>
							<input 
								value="{{ old('title') }}"
								class="form-control"
								name="title"
								id="title"
								placeholder="Enter title..."
							/>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="reason">Reason</label>
							<div name="reason" id="reason" style="height: 350px"></div>
							<input type="hidden" id="reason-form-field" name="reason" />
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
							<label for="contact">Target User</label>
							<select 
								value="{{ old('transfer_to') }}"
								class="form-control"
								name="transfer_to"
								id="transfer_to"
							>
								<option>{{ __('Select a user') }}</option>

								@if(isset($users) && count((array) $users) > 0)
									@foreach($users as $user)
										<option value="{{ $user->id }}">
											{{ $user->full_name }}
										</option>
									@endforeach
								@endif
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row float-right">
						<a href="{{ url('ticket') }}" class="btn btn-light mr-1">
							<i class="fas fa-arrow-left"></i> Back
						</a>

						<input type="submit" name="button" value="Process" class="btn btn-primary" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts-include')
<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<script type="text/javascript" src="{{ asset('js/standalone/selectize.min.js') }}"></script>
<!-- Initialize Quill editor -->
<script type="text/javascript">
	var form = $('#ticket-creation-form');
	var tags = form.data('tags');
	var detailsValue = $('#reason').val();
	var quill = new Quill('#reason', {
		placeholder: 'Compose a reason for transferring a ticket...',
		theme: 'snow',
	});

	quill.setText(detailsValue);
	$('#tags').selectize({
		delimiter: ',',
		persist: false,
		valueField: 'name',
		labelField: 'name',
		options: getTagsAsOption(),
		create: true,
	});

	// On form submit, assign the details to 
	// the equivalent hidden field
	form.on('submit', function(e) {
		$('#reason-form-field').val(quill.getText());

		return true;
	});

	// Fetch all the tags and format them to 
	// quill value
	function getTagsAsOption()  {
		return typeof tags !== 'undefined' && 
				tags.split(',').length > 0 ? tags.split(',').map(function (tag) {
			return {
				'name': tag
			};
		}) : {};
	}
</script>
@endsection
