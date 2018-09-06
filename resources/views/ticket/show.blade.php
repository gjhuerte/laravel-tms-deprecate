@extends('layouts.app')

@section('content')
<div class="container p-4 mt-4" style="background-color: white;">
	<h1 class="display-4 my-3">{{ $ticket->title }}</h1>
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
	    <li class="breadcrumb-item"><a href="{{ url('ticket') }}">Ticket</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $ticket->id }}</li>
	  </ol>
	</nav>
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
				<th>By</th>
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
			id="add-resolution-button" 
			href="{{ url("ticket/$ticket->id/add-action") }}"  
			class="btn btn-success">
			<i class="fas fa-edit" aria-hidden="true"></i> Add resolution
		</a>
		<a 
			id="transfer-button" 
			href="{{ url("ticket/$ticket->id/transfer") }}"  
			class="btn btn-primary">
			<i class="fas fa-share" aria-hidden="true"></i> Assign Staff
		</a>
		<button 
			type="button"
			id="close-button" 
			class="btn btn-danger"
			data-alert="Do you really want to close this ticket?"
			data-url="{{ url("ticket/$ticket->id/close") }}"  
			data-button-title="close">
			<i class="fas fa-door-closed" aria-hidden="true"></i> Close ticket
		</button>
		<button 
			type="button"
			id="reopen-button" 
			class="btn btn-secondary"
			data-alert="Do you really want to reopen this ticket?"
			data-url="{{ url("ticket/$ticket->id/reopen") }}"  
			data-button-title="reopen">
			<i class="fas fa-door-open" aria-hidden="true"></i> Reopen ticket
		</button>
	`);

	$('#close-button, #reopen-button').on('click', function(e) {
    var $this = $(this);
		var alertDetails = $(this).data('alert')
		var buttonTitle = $(this).data('button-title')
		var redirectUrl = $(this).data('url')
		var loadingText = '<i class="fas fa-circle-o-notch fa-spin"></i> Loading...';

		if ($(this).html() !== loadingText) {
			$this.data('original-text', $(this).html());
			$this.html(loadingText);
		}
		
		swal({
		  // title: 'Are you sure?',
			content: "input",
		  text: alertDetails,
		  // type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, ' + buttonTitle + ' it!'
		}).then((result) => {
		  if (result.value) {
			  window.location.href=redirectUrl
		  } else {
		    $this.html($this.data('original-text'));
		    swal("Cancelled", "Operation Cancelled", "error");
		  }
		})
	})
} );
</script>
@endsection