@extends('layouts.client')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 my-1">
                <h1 class="display-4">{{ __('Organizations List') }}</h1>
            </div>
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Maintenance</li>
                    <li class="breadcrumb-item">Ticket</li>
                    <li class="breadcrumb-item">Organization</li>
                </ul>
            </div>
            <div class="col-sm-12 my-1">
                @include('notification.alert')
    
                <table 
                    class="table table-hover table-bordered table-condensed" 
                    id="maintenance-table"
                    data-base-url="{{ route('organization.index') }}"
                    data-ajax-url="{{ route('api.organization.index') }}"
                    data-api-token="{{ Auth::user()->api_token }}"
                    data-create-url="{{ route('organization.create') }}"
                    data-api-remove-url="{{ route('api.organization.destroy') }}"
                    data-confirmation-title="Are you sure?"
                    data-show-view-button="true"
                    data-show-edit-button="true"
                    data-show-remove-button="true"
                    data-confirmation-message="You won't be able to revert this!">
                    <thead>
                        <td>{{ __('ID') }}</td>
                        <td>{{ __('Name') }}</td>
                        <td>{{ __('Abbreviation') }}</td>
                        <td>{{ __('Created At') }}</td>
                        <td>{{ __('Updated At') }}</td>
                        <td></td>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts-include')
    <script type="text/javascript" src="{{ asset('js/datatables-custom-addons.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#maintenance-table');
            var tableAjaxUrl = table.data('ajax-url');
            var baseUrl = table.data('base-url'); 
            var createUrl = table.data('create-url');
            var apiToken = table.data('api-token');
            var apiRemoveUrl = table.data('api-remove-url');
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
                ajax: {
                    url: tableAjaxUrl,
                    type: 'get',
                    dataType: 'JSON',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader("X-CSRF-TOKEN", apiToken);
                        xhr.setRequestHeader("Authorization", 'Bearer ' + apiToken);
                    },
                },
                columns: [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "abbreviation" },
                    { "data": "created_at" },
                    { "data": "updated_at" },
                    { data: function(callback) {
                        var buttons = buttonsForDatatables.displayAll({
                            'baseUrl': baseUrl,
                            'callback': callback,
                            'remove': {
                                url: apiRemoveUrl + '/' + callback.id,
                                authorization: apiToken,
                            },

                        });

                        return buttons || '';
                    } },
                ],
            });

            // appends a create button on the data table
            $("div.toolbar").html(buttonsForDatatables.create(createUrl));

            // Triggers the function when the button has been clicked
            table.on('click', '.btn-remove', function() {
                buttonsForDatatables.removeEventListener( $(this), dataTable, confirmationTitle, confirmationMessage );
            });
        } );
    </script>
@endsection
