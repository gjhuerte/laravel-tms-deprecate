@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12 my-1">
        <h1 class="display-4">{{ __('Maintenance') }}: {{ __('Category') }}</h1>
	  </div>
    <div class="col-sm-12 my-1">
        @include('notification.alert')

        <table 
            class="table table-hover table-bordered table-condensed" 
            id="maintenance-table"
            data-ajax-url="{{ route('category.index') }}"
            data-confirmation-title="Are you sure?"
            data-show-view-button="true"
            data-show-edit-button="true"
            data-show-remove-button="true"
            data-confirmation-message="You won't be able to revert this!">

            <thead>
                <td>{{ __('ID') }}</td>
                <td>{{ __('Name') }}</td>
                <td>{{ __('Description') }}</td>
                <td>{{ __('Created At') }}</td>
                <td>{{ __('Updated At') }}</td>
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
        var showViewButton = table.data('show-view-button');
        var showEditButton = table.data('show-edit-button');
        var showRemoveButton = table.data('show-remove-button');
        var confirmationTitle = table.data('confirmation-title');
        var confirmationMessage = table.data('confirmation-message');

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
                    console.log(buttonsForDatatables.displayAll(callback))
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
        
        // Triggers the function when the button has been clicked
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

            // Create a confirmation alert before processing the data sent 
            // by the user to the server
            notification.alert.confirmation(confirmationTitle, confirmationMessage, function(result) {
            
                // Triggers when the user clicks the confirm button
                if (result.value) {

                    // use the method delete of the ajax to create
                    // a http header with the delete method using ajax
                    ajax.delete(removeUrl, function() {
                        $this.html($this.data('original-text'));
                        table.ajax.reload();
                    });
                } 

                // Triggers when the user click another button
                // in the form    
                else {
                    $this.html($this.data('original-text'));
                    notification.cancelled();
                }
            });
        });
    } );
</script>
@endsection
