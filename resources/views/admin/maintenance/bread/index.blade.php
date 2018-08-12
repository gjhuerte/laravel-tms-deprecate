@extends('admin.maintenance.layout')

@section('maintenance-body')
<div class="row p-3" style="background-color: white;">
	<div class="col-sm-12 my-1">
		<h1>Maintenance: {{ $path['titles']['index'] }}</h1>
	</div>
	<div class="col-sm-12 my-1">
		<a class="btn btn-outline-success" href="{{ url( $path['create'] ) }}">Create</a>
	</div>
	<div class="col-sm-12 my-1">
		@include('notification.alert')
		<table class="table table-hover table-bordered table-condensed" id="maintenance-table">
			<thead>
			@foreach( $columns as $key => $value )
				@if( $value['select'] )
				<td>{{ ucfirst($key) }}</td>
				@endif
			@endforeach
				<td></td>
			</thead>
			<tbody>
			@foreach( $data as $datum )
				<tr>
				@foreach( $columns as $key => $value )
					@if( $value['select'] )
					<td>{{ $datum->$key }}</td>
					@endif
				@endforeach
					<td>
						<a class="btn btn-secondary" href="{{ url( $path['edit']['prefix'] . '/' .$datum->id . '/' . $path['edit']['suffix'] ) }}">
							Update
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('scripts-include')
<script type="text/javascript">
$(document).ready(function() {
		var table = $('#vehiclesTable').DataTable( {
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
      ajax: "{{ url('vehicle') }}",
      columns: [
          { data: "brand" },
          { data: "model" },
          { data: "year_made" },
          { data: "size" },
          { data: "transmission" },
          { data: function(callback){
            return `
              <a href="{{ url("vehicle") }}` + '/' + callback.id + `" class="btn btn-secondary">View</a>
              <a href="{{ url("vehicle") }}` + '/' + callback.id + `/edit" class="btn btn-warning">Edit</a>
              <button type="button" data-id='` + callback.id + `"' class="btn-remove btn btn-danger">Remove</button>
            `
          } },
      ],
    } );

	 	$("div.toolbar").html(`
 			<a type="button" id="new" href="{{ url('vehicle/create') }}"  class="btn btn-primary btn-sm">
        <span class="glyphicon glyphicon-plus"></span>  Create
      </a>
		`);

    $('#vehiclesTable').on('click', '.btn-remove', function(){
				id = $(this).data('id');
        var $this = $(this);
        var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> Loading...';
        if ($(this).html() !== loadingText) {
          $this.data('original-text', $(this).html());
          $this.html(loadingText);
        }

        swal({
          title: "Are you sure?",
          text: "This vehicle will be removed?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'delete',
              url: '{{ url("vehicle") }}' + "/" + id,
              data: {
                'id': id
              },
              dataType: 'json',
              success: function(response){
                swal('Operation Successful','vehicle removed','success')
              },
              error: function(){
                swal('Operation Unsuccessful','Error occurred while deleting a record','error')
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
        });
    });
} );
</script>
@endsection