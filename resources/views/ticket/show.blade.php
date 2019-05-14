@extends('layouts.client')

@section('content')
<div class="container p-4 mt-4" style="background-color: white;">
    <h1 class="display-4 my-3">{{ $ticket->title }}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('ticket') }}">Ticket</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $ticket->id }}</li>
        </ol>
    </nav>
    
    @include('notification.alert')

    <table 
        class="table table-striped table-condensed table-bordered table-hover"  
        width="100%" 
        cellspacing="0"
        data-ajax-url="{{ route('api.ticket.activity.index', $ticket->id) }}"
        data-api-token="{{ Auth::user()->api_token }}"
        data-add-resolution-url="{{ route('ticket.resolve.form', [ $ticket->id ]) }}"
        data-assign-staff-url="{{ route('ticket.transfer.form', [ $ticket->id ]) }}"
        data-close-ticket-url="{{ route('ticket.close.form', [ $ticket->id ]) }}"
        data-reopen-ticket-url="{{ route('ticket.reopen.form', [ $ticket->id ]) }}"
        data-reopen
        id="tickets-table" 
        style="background-color: white;">
        <thead>
            <tr>
                <th colspan=2 style="font-weight: normal">
                    <strong>ID: </strong>{{ $ticket->id }}
                </th>
                <th colspan=2 style="font-weight: normal">
                    <strong>Title: </strong>{{ $ticket->title }}
                </th>
            </tr>
            <tr>
                <th colspan=2 style="font-weight: normal">
                    <strong>Created At: </strong>{{ $ticket->parsed_created_at }}
                </th>
                <th colspan=2 style="font-weight: normal">
                    <strong>Author: </strong>{{ $ticket->author->full_name ?? 'Not Set' }}
                </th>
            </tr>
            <tr>
                <th colspan=4 style="font-weight: normal">
                    <strong>Details: </strong>{{ $ticket->details }}
                </th>
            </tr>
            <tr>
                <th colspan=4 style="font-weight: normal">
                    <strong>Remarks: </strong>{{ $ticket->additional_info }}
                </th>
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
        var table = $('#tickets-table');
        var ajaxUrl = table.data('ajax-url');
        var apiToken = table.data('api-token');
        var addResolutionUrl = table.data('add-resolution-url');
        var assignStaffUrl = table.data('assign-staff-url');
        var closeTicketUrl = table.data('close-ticket-url');
        var reopenTicketUrl = table.data('reopen-ticket-url');

        var dataTable = table.DataTable( {
            select: {
                style: 'single'
            },
            language: {
                searchPlaceholder: "Search..."
            },
            columnDefs:[
                { targets: 'no-sort', orderable: false },
            ],
            order: [[ 0, "desc" ]],
            "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "processing": true,
            serverSide: true,
            ajax: {
                url: ajaxUrl,
                type: 'get',
                dataType: 'JSON',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("X-CSRF-TOKEN", apiToken);
                    xhr.setRequestHeader("Authorization", 'Bearer ' + apiToken);
                },
            },
            columns: [
                { data: 'created_at'},
                { data: 'details'},
                { data: 'author_fullname'},
            ],
        } );

        $("div.toolbar").html(``);
        $("div.toolbar").append(
            $('<a />', {
                id: 'add-resolution-button',
                href: addResolutionUrl,
                class: 'btn btn-success mr-1',
                text: 'Add Resolution',
            }).prepend(
                $('<i />', {
                    class: 'fas fa-edit',
                    'aria-hidden': 'true',
                })
            ),

            $('<a />', {
                id: 'transfer-button',
                href: assignStaffUrl,
                class: 'btn btn-primary mr-1 text-light',
                text: 'Assign Staff',
            }).prepend(
                $('<i />', {
                    class: 'fas fa-share',
                    'aria-hidden': 'true',
                })
            ),
            
            $('<button />', {
                type:'button',
                id: 'close-button',
                'data-url': closeTicketUrl,
                'data-alert': 'Do you really want to close this ticket?',
                class: 'btn btn-danger mr-1',
                'data-button-title': 'close',
                text: 'Close ticket',
            }).prepend(
                $('<i />', {
                    class: 'fas fa-door-closed',
                    'aria-hidden': 'true',
                })
            ),

            $('<button />', {
                type:'button',
                id: 'reopen-button',
                'data-url': reopenTicketUrl,
                'data-alert': 'Do you really want to reopen this ticket?',
                class: 'btn btn-secondary mr-1',
                'data-button-title': 'reopen',
                text: 'Reopen ticket',
            }).prepend(
                $('<i />', {
                    class: 'fas fa-door-open',
                    'aria-hidden': 'true',
                })
            ),
        );

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
