@extends('layouts.app')

@section('content')
<div class="container p-4 mt-4" style="background-color: white;">
	<h1 class="display-4">Ticket: {{ $ticket->id }}</h1>
	<table 
		class="table table-striped table-condensed table-bordered table-hover"  
		width="100%" 
		cellspacing="0"
		id="tickets-table" 
		style="background-color: white;">
		<thead>
			<tr>
                <th colspan=2 style="font-weight: normal"><strong>Title: </strong>{{ $ticket->title }}</th>
                <th colspan=2 style="font-weight: normal"><strong>Author: </strong>{{ $ticket->author_fullname }}</th>
			</tr>
			<tr>
                <th colspan=2 style="font-weight: normal"><strong>Details: </strong>{{ $ticket->details }}</th>
                <th colspan=2 style="font-weight: normal"><strong>Created At: </strong>{{ $ticket->parsed_created_at }}</th>
			</tr>
			<tr>
                <th colspan=2 style="font-weight: normal"><strong>Remarks: </strong>{{ $ticket->additional_info }}</th>
                <th colspan=2></th>
			</tr>
			<tr>
				<th>Date</th>
				<th>Details</th>
				<th>Author</th>
				<th>Author</th>
			</tr>
		</thead>
	</table>
</div>
@endsection

@section('scripts-include')
<script type="text/javascript">
$(document).ready(function() {
	var table = $('#tickets-table').DataTable( {
        select: {
          style: 'single'
        },
        language: {
            searchPlaceholder: "Search..."
        },
        columnDefs:[
        { targets: 'no-sort', orderable: false },
        ],
        "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
		"processing": true,
		serverSide: true,
		ajax: "{{ url('ticket/' . $ticket->id) }}",
		columns: [
			{ data: 'parsed_created_at'},
			{ data: 'details'},
			{ data: 'author_fullname'},
		],
    } );

 	$("div.toolbar").html(`
		<a 
			id="new" 
			href="{{ url('ticket/create') }}"  
			class="btn btn-primary">
			<i class="fas fa-plus" aria-hidden="true"></i> Create
		</a>
	`);
} );
</script>
@endsection