@extends('layouts.client')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 my-1">
                <h1 class="display-4">{{ __('Tickets List') }}</h1>
            </div>
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Ticket</li>
                </ul>
            </div>
            <div class="col-sm-12 my-1">
                @include('notification.alert')

                <ticket-list-table
                    :base-url="'{{ route('ticket.index') }}'"
                    :ajax-url="'{{ route('api.ticket.index') }}'"
                    :api-token="'{{ Auth::user()->api_token }}'"
                    :create-url="'{{ route('ticket.create') }}'">
                </ticket-list-table>
            </div>
        </div>
    </div>
@endsection
