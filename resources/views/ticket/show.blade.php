@extends('layouts.app')

@section('content')
<div class="container p-4 mt-4" style="background-color: white;">
	<h1 class="display-4 my-3">{{ $ticket->title }}</h1>
	<table 
		class="table table-striped table-condensed table-bordered table-hover"  
		width="100%" 
		cellspacing="0"
		id="tickets-table" 
		style="background-color: white;">
		<thead>
			<tr>
                <th colspan=2 style="font-weight: normal"><strong>ID: </strong>{{ $ticket->id }}</th>
                <th colspan=2 style="font-weight: normal"><strong>Title: </strong>{{ $ticket->title }}</th>
			</tr>
			<tr>
                <th colspan=2 style="font-weight: normal"><strong>Created At: </strong>{{ $ticket->parsed_created_at }}</th>
                <th colspan=2 style="font-weight: normal"><strong>Author: </strong>{{ $ticket->author_fullname }}</th>
			</tr>
			<tr>
                <th colspan=4 style="font-weight: normal"><strong>Details: </strong>{{ $ticket->details }}</th>
			</tr>
			<tr>
                <th colspan=4 style="font-weight: normal"><strong>Remarks: </strong>{{ $ticket->additional_info }}</th>
			</tr>
			<tr>
				<th>Date</th>
				<th>Details</th>
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
			href="{{ url("ticket/$ticket->id/add-action") }}"  
			class="btn btn-success">
			<i class="fas fa-edit" aria-hidden="true"></i> Add resolution
		</a>
		<a 
			id="new" 
			href="{{ url("ticket/$ticket->id/transfer") }}"  
			class="btn btn-primary">
			<i class="fas fa-share" aria-hidden="true"></i> Transfer
		</a>
		<a 
			id="new" 
			href="{{ url("ticket/$ticket->id/close") }}"  
			class="btn btn-danger">
			<i class="fas fa-door-closed" aria-hidden="true"></i> Close ticket
		</a>
		<a 
			id="new" 
			href="{{ url("ticket/$ticket->id/reopen") }}"  
			class="btn btn-secondary">
			<i class="fas fa-door-open" aria-hidden="true"></i> Reopen ticket
		</a>
	`);
} );
</script>
@endsection