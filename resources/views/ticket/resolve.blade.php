@extends('layouts.client')

@section('styles-include')
<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap2.css') }}">
@endsection

@section('content')
<div class="container p-4 mt-3" style="background-color: white;">
	<div class="row">
		<div class="col-sm-12 my-1">
			<h1 class="display-4">Ticket: Create Solution</h1>
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
				
				<li class="breadcrumb-item active">Create Solution</li>
			</ul>
		</div>

		<div class="col-sm-12 my-1">
			@include('notification.alert')

			<form id="ticket-creation-form"
				method="post"
				action="{{ route('ticket.resolve', [ $ticket->id ]) }}"
				class="form-horizontal">
				<div class="row">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					
                    <div class="col-sm-12">
						<div class="alert alert-info">
							<h5 class="alert-heading">TARGET TICKET</h5>
							
							<ul class="list-unstyled mt-3">
								<li>
									<strong>Code: </strong> {{ $ticket->code }}
								</li>
								<li class="mt-1">
									<strong>Title: </strong> {{ $ticket->title }}
								</li>
							</ul>
						</div>
					</div>

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
							<label for="details">Details</label>
							<div name="details" id="details" style="height: 350px"></div>
							<input type="hidden" id="details-form-field" name="details" />
						</div>
					</div>
					
					<div class="col-sm-12">
						<div class="form-group">
							<label for="contact">Contact Information</label>
							<input 
								value="{{ old('contact') }}"
								class="form-control"
								name="contact"
								id="contact"
								placeholder="Enter Contact Information..."
							/>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label for="tags">Tags</label>
							<input
								type="text"
								name="tags"
								id="tags"
								placeholder="Enter tags here separated by comma"
								value="{{ old('tags') }}"
							>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row float-left">
						<div class="col-sm-12">
							<div class="form-group">
								<input
									type="checkbox"
									name="is_resolved"
									id="is_resolved"
									value="{{ old('is_resolved') }}"
								>
								
								<label for="is_resolved">Set as resolved</label>
							</div>
						</div>
					</div>

					<div class="row float-right">
						<a href="{{ url('ticket') }}" class="btn btn-light">
							<i class="fas fa-arrow-left"></i> Back
						</a>
						
						<input type="submit" name="button" value="Save" class="btn btn-primary" />
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
	var detailsValue = $('#details').val();
	var quill = new Quill('#details', {
		placeholder: 'Compose an epic ticket details...',
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
		$('#details-form-field').val(quill.getText());

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
