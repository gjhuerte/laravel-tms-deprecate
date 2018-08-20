@extends('layouts.app')

@section('content')
<div class="container p-4 mt-4" style="background-color: white;">
	<h1 class="display-4">Tickets</h1>
	<table 
		class="table table-striped table-condensed table-bordered table-hover"  
		width="100%" 
		cellspacing="0"
		id="tickets-table" 
		style="background-color: white;">
		<thead>
			<tr>
                <th style="font-weight: normal">{{ $ticket->title }}</th>
                <th style="font-weight: normal">{{ $ticket->author_fullname }}</th>
			</tr>
			<tr>
                <th style="font-weight: normal">{{ $ticket->details }}</th>
                <th style="font-weight: normal">{{ $ticket->parsed_created_at }}</th>
			</tr>
			<tr>
                <th style="font-weight: normal">{{ $ticket->additional_info }}</th>
                <th></th>
			</tr>
			<tr>
				<th>Date</th>
				<th>Details</th>
				<th>Author</th>
				<th class="no-sort"></th>
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
			{ data: function(callback){
				return `
				  <a 
				    href="#` + '/' + callback.id + `" 
				    class="btn btn-outline-secondary" >
				    <i class="fas fa-folder" aria-hidden="true"></i> View</a>
				  <a 
				    href="#` + '/' + callback.id + `/edit" 
				    class="btn btn-outline-warning" >
				    <i class="fas fa-pen" aria-hidden="true"></i> Edit</a>
				`
			} },
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