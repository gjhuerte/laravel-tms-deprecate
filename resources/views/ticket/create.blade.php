@extends('layouts.app')

@section('styles-include')
<link rel="stylesheet" href="{{ asset('css/richtext.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap2.css') }}">
@endsection

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
			<form method="post" action="{{ url('ticket') }}">
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

@section('scripts-include')
<script type="text/javascript" src="{{ asset('js/jquery.richtext.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/standalone/selectize.min.js') }}"></script>
<script type="text/javascript">
	$('#details').richText({
		bold: true,
		italic: true,
		underline: true,
		leftAlign: true,
		centerAlign: true,
		rightAlign: true,
		ol: true,
		ul: true,
		heading: true,
		fonts: true,
		fontList: [
			"Arial", 
			"Arial Black", 
			"Comic Sans MS", 
			"Courier New", 
			"Geneva", 
			"Georgia", 
			"Helvetica", 
			"Impact", 
			"Lucida Console", 
			"Tahoma", 
			"Times New Roman",
			"Verdana"
		],
		fontColor: true,
		fontSize: true,
		imageUpload: true,
		fileUpload: false,
		urls: true,
		table: true,
		removeStyles: true,
		code: true,
		colors: [],
		fileHTML: '',
		imageHTML: '',
		translations: {
			'title': 'Title',
			'white': 'White',
			'black': 'Black',
			'brown': 'Brown',
			'beige': 'Beige',
			'darkBlue': 'Dark Blue',
			'blue': 'Blue',
			'lightBlue': 'Light Blue',
			'darkRed': 'Dark Red',
			'red': 'Red',
			'darkGreen': 'Dark Green',
			'green': 'Green',
			'purple': 'Purple',
			'darkTurquois': 'Dark Turquois',
			'turquois': 'Turquois',
			'darkOrange': 'Dark Orange',
			'orange': 'Orange',
			'yellow': 'Yellow',
			'imageURL': 'Image URL',
			'fileURL': 'File URL',
			'linkText': 'Link text',
			'url': 'URL',
			'size': 'Size',
			'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsive</a>',
			'text': 'Text',
			'openIn': 'Open in',
			'sameTab': 'Same tab',
			'newTab': 'New tab',
			'align': 'Align',
			'left': 'Left',
			'center': 'Center',
			'right': 'Right',
			'rows': 'Rows',
			'columns': 'Columns',
			'add': 'Add',
			'pleaseEnterURL': 'Please enter an URL',
			'videoURLnotSupported': 'Video URL not supported',
			'pleaseSelectImage': 'Please select an image',
			'pleaseSelectFile': 'Please select a file',
			'bold': 'Bold',
			'italic': 'Italic',
			'underline': 'Underline',
			'alignLeft': 'Align left',
			'alignCenter': 'Align centered',
			'alignRight': 'Align right',
			'addOrderedList': 'Add ordered list',
			'addUnorderedList': 'Add unordered list',
			'addHeading': 'Add Heading/title',
			'addFont': 'Add font',
			'addFontColor': 'Add font color',
			'addFontSize' : 'Add font size',
			'addImage': 'Add image',
			'addVideo': 'Add video',
			'addFile': 'Add file',
			'addURL': 'Add URL',
			'addTable': 'Add table',
			'removeStyles': 'Remove styles',
			'code': 'Show HTML code',
			'undo': 'Undo',
			'redo': 'Redo',
			'close': 'Close'
		},

		useSingleQuotes: false,
		height: 0,
		heightPercentage: 0,
		id: "",
		class: "",
		useParagraph: false,
	});
	
	$('#tags').selectize({
		delimiter: ',',
		persist: false,
		valueField: 'name',
		labelField: 'name',
		options: [
			@foreach($tags as $tag)
			{ name: "{{ $tag }}" },
			@endforeach
		],
		create: function(input) {
			return {
				name: input
			}
		}
	});
</script>
@endsection