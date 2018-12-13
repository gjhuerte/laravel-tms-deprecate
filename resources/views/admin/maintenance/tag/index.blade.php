@extends('admin.maintenance.app')

@section('maintenance-body')
<div class="row">
    <div class="col-sm-12 my-1">
        <h1 class="display-4">{{ __('Maintenance') }}: {{ __('Tag') }}</h1>
	  </div>
    <div class="col-sm-12 my-1">
		    @include('notification.alert')
        <table 
            class="table table-hover table-bordered table-condensed" 
            id="maintenance-table"
            data-ajax-url="{{ url('tag') }}"
            data-base-url="{{ url('tag') }}"
            data-create-url="{{ route('tag.create') }}"
        >
            <thead>
                <td>{{ __('ID') }}</td>
                <td>{{ __('Name') }}</td>
                <td>{{ __('Description') }}</td>
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
        var baseUrl = table.data('base-url'); 
        var createUrl = table.data('create-url');

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
                { "data": "id" },
                { "data": "name" },
                { "data": "description" },
                { "data": "created_at" },
                { "data": "updated_at" },
                { data: function(callback) {
                    return buttonsForDatatables.displayAll(callback);
                } },
            ],
        });

        // appends a create button on the data table
        $("div.toolbar").html(
            $('<a />', {
                'id': 'new',
                'href': createUrl,
                class: "btn btn-primary",
                text: 'Create'
            }).prepend(
                $('<i />', { class: 'fas fa-plus', 'aria-hidden': 'true' })
            ),
        );

        // Function for showing what kind of buttons to be displayed on the 
        // application. The options can be added depending on what kind of 
        // buttons are needed by the user
        buttonsForDatatables = {
            displayAll: function (callback) {
                var viewUrl = baseUrl + '/' + callback.id;
                var editUrl = baseUrl + '/' + callback.id + '/edit';
                var removeUrl  = baseUrl + '/' + callback.id;

                return 
                    buttonsForDatatables.view(viewUrl) + 
                    buttonsForDatatables.edit(editUrl) + 
                    buttonsForDatatables.remove(removeUrl);
            },

            // Button for viewing a certain resource
            // This will redirect to the page of the
            // Specific resource
            view: function(url) {
                return `
                    <a 
                        href="` + url + `" 
                        class="btn btn-outline-secondary my-1" >
                        <i class="fas fa-folder" aria-hidden="true"></i> View
                    </a>
                `;
            },

            // Button for updating a certain resource
            // This will redirect to the form page where
            // the certain resource can be updated
            edit: function(url) {
                return `
                    <a 
                        href="` + url + `" 
                        class="btn btn-outline-warning my-1" >
                        <i class="fas fa-pen" aria-hidden="true"></i> Edit
                    </a>
                `
            },
            
            // Button for removing the resource from the system
            // This will trigger the remove function
            remove: function(url) {
                return `
                    <button 
                        type="button" data-remove-url="` + url + `" 
                        class="btn-remove btn btn-outline-danger my-1" >
                        <i class="fas fa-trash" aria-hidden="true"></i> Remove
                    </button>
                `
            }
        };

        table.on('click', '.btn-remove', function() {
            var $this = $(this);
            var removeUrl = $this.data('remove-url');
            var loadingText = $('<i />', { class: 'fas fa-circle-o-notch fa-spin', 'aria-hidden': 'true' }).append(' Loading...');
            
            // Sets the button to loading when the
            // function is triggered
            if ($this.html() !== loadingText) {
                $this.data('original-text', $this.html());
                $this.html(loadingText);
            }
            
            // Verify whether the user really wants to perform
            // the action 
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
                        url: removeUrl,
                        dataType: 'json',
                        success: function(response) {
                            notification.success();
                        },
                        error: function() {
                            notification.error();
                        },
                        complete: function(){
                            $this.html($this.data('original-text'));
                            table.ajax.reload();
                        }
                    });
                } else {
                    $this.html($this.data('original-text'));
                    notification.cancelled();
                }
            })
        });
    } );
</script>
@endsection
