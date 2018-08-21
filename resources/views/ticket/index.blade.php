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
			<tr rowspan="1">
				<th colspan="5">
					<div class="form-inline">
						Category:
						<select 
							id="ticket-category"
							name="ticket-category"
							class="form-control mx-2">
							@if(isset($categories))
								@foreach($categories as $category)
								<option value="{{ $category->name }}">{{ $category->name }}</option>
								@endforeach
							@endif		
						</select>
						Status:
						<select 
							id="ticket-status"
							name="ticket-status"
							class="form-control mx-2">
							@if(isset($status))
								@foreach($status as $status)
								<option value="{{ $status }}">{{ $status }}</option>		
								@endforeach
							@endif
						</select>
						Level:
						<select 
							id="ticket-priority"
							name="ticket-priority"
							class="form-control mx-2">
							@if(isset($levels))
								@foreach($levels as $level)
								<option value="{{ $level->name }}">{{ $level->name }}</option>
								@endforeach
							@endif			
						</select>
					</div>
				</th>
			</tr>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Assigned</th>
				<th>Status</th>
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
		ajax: "{{ url('ticket') }}",
		columns: [
			{ data: 'id'},
			{ data: 'title'},
			{ data: 'assigned_personnel'},
			{ data: 'status'},
			{ data: function(callback){
				return `
				  <a 
				    href="{{ url('ticket') }}/` + callback.id + `" 
				    class="btn btn-outline-secondary" >
				    <i class="fas fa-folder" aria-hidden="true"></i> View</a>
				  <a 
				    href="{{ url('ticket') }}/` + callback.id + `/edit" 
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

    $('#maintenance-table').on('click', '.btn-remove', function(){
		id = $(this).data('id');
        var $this = $(this);
        var loadingText = '<i class="fas fa-circle-o-notch fa-spin"></i> Loading...';
        if ($(this).html() !== loadingText) {
          $this.data('original-text', $(this).html());
          $this.html(loadingText);
        }
        swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'delete',
              url: '#' + "/" + id,
              data: {
                'id': id
              },
              dataType: 'json',
              success: function(response){
                swal('Operation Successful','Item removed successfully','success')
              },
              error: function(){
                swal('Operation Unsuccessful','Error occurred while removing an item','error')
              },
              complete: function(){
                $this.html($this.data('original-text'));
                table.ajax.reload();
              }
            });
          } else {
            $this.html($this.data('original-text'));
            swal("Cancelled", "Operation Cancelled", "error");
          }
        })
    });
} );
</script>
@endsection