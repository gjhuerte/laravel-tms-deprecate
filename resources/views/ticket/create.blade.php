@extends('layouts.client')

@section('content')
	<div class="container p-4 mt-3">
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

						<input 
							type="submit" 
							name="button" 
							value="Save" 
							class="btn btn-primary" />
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
			$('#details-form-field').val(quill.getText());
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
			var splittedTags = tags.split(',');
			return splittedTags.map(function (tag) {
				return {
					'name': tag
				};
			});
		}
	</script>
@endsection
