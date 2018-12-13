@extends('admin.maintenance.app')

@section('maintenance-body')
<div class="row">
    <div class="col-sm-12 my-1">
        <h1 class="display-4">Maintenance: {{ $variable->title }}</h1>
	  </div>
    <div class="col-sm-12 my-1">
		    @include('notification.alert')
        <table 
            class="table table-hover table-bordered table-condensed" 
            id="maintenance-table"
            data-ajax-url="{{ url(ajaxUrl) }}"
        >
            <thead>
                @foreach( $variable->columns as $key => $args )
                    @if($args->isSelectable)
                        <td>{{ ucfirst($args->name) }}</td>
                    @endif
                @endforeach
                <td></td>
            </thead>
        </table>
	  </div>
</div>
@endsection

@section('scripts-include')
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#maintenance-table');
        var tableAjaxUrl = table.data('ajax-url');  

        var dataTable = table.DataTable( {
            select: {
                style: 'single'
            },
            language: {
                searchPlaceholder: "Search..."
            },
            columnDefs:[
                { 
                    targets: 'no-sort', 
                    orderable: false 
                },
            ],
            "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "processing": true,
            serverSide: true,
            ajax: tableAjaxUrl,
            columns: [
              @foreach( $variable->columns as $key => $args )
                @if($args->isSelectable)
                { data: "{{ $args->dataTableName }}" },
                @endif
              @endforeach
              { data: function(callback) {
                return `
                  <a 
                    href="{{ url("$variable->baseUrl") }}` + '/' + callback.id + `" 
                    class="btn btn-outline-secondary my-1" >
                    <i class="fas fa-folder" aria-hidden="true"></i> View</a>
                  <a 
                    href="{{ url("$variable->baseUrl") }}` + '/' + callback.id + `/edit" 
                    class="btn btn-outline-warning my-1" >
                    <i class="fas fa-pen" aria-hidden="true"></i> Edit</a>
                  @if(isset($variable->isRemovable) && $variable->isRemovable)
                  <button 
                    type="button" data-id="` + callback.id + `" 
                    class="btn-remove btn btn-outline-danger my-1" >
                    <i class="fas fa-trash" aria-hidden="true"></i> Remove</button>
                  @endif
                `
              } },
          ],
        } );

        $("div.toolbar").html(`
          <a 
            id="new" 
            href="{{ url("$variable->createUrl") }}"  
            class="btn btn-primary">
            <i class="fas fa-plus" aria-hidden="true"></i> Create
          </a>
        `);

        @if(isset($variable->isRemovable) && $variable->isRemovable)
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
                  url: '{{ url("$variable->baseUrl") }}' + "/" + id,
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
        @endif
    } );
</script>
@endsection
