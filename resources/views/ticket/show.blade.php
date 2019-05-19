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

    <single-ticket-table
        :ticket="'{{ json_encode($ticket) }}'"
        :ajax-url="'{{ route('api.ticket.activity.index', $ticket->id) }}'"
        :add-resolution-url="'{{ route('ticket.resolve.form', [ $ticket->id ]) }}'"
        :assign-staff-url="'{{ route('ticket.transfer.form', [ $ticket->id ]) }}'"
        :close-ticket-url="'{{ route('ticket.close.form', [ $ticket->id ]) }}'"
        :reopen-ticket-url="'{{ route('ticket.reopen.form', [ $ticket->id ]) }}'">
    </single-ticket-table>
</div>
@endsection
