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

    @if(count((array) $tags) > 0)
        <div class="tags">
            @foreach($tags as $tag)
                @php
                    $colors = [
                        'success',
                        'danger',
                        'info',
                        'secondary',
                        'warning',
                    ];

                    $color = $colors[rand(0, count($colors) - 1)];
                @endphp

                <label class="badge badge-{{ $color }} p-2">
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
    @endif
    
    @include('notification.alert')

    <table-ajax
        base-url="{{ route('api.ticket.activity.index', $ticket->id) }}"
        ajax-url="{{ route('api.ticket.activity.index', $ticket->id) }}"
        api-token="{{ Auth::user()->api_token }}"
        column-count="4">
        <template slot="right_header">
            <a 
                id="add-resolution-button"
                class="btn btn-success btn-sm"
                href="{{ route('ticket.resolve.form', [ $ticket->id ]) }}">
                <i class="fas fa-plus"></i>

                Create Solution
            </a>

            <a 
                id="transfer-button"
                class="btn btn-primary mr-1 text-light btn-sm"
                href="{{ route('ticket.transfer.form', [ $ticket->id ]) }}">
                <i class="fas fa-share"></i>

                Assign Staff
            </a>
            
            <a 
                id="close-button"
                class="btn btn-danger mr-1 text-light btn-sm"
                href="{{ route('ticket.close.form', [ $ticket->id ]) }}">
                <i class="fas fa-door-closed"></i>

                Close Ticket
            </a>
            
            <a 
                id="close-button"
                class="btn btn-secondary mr-1 text-light btn-sm"
                href="{{ route('ticket.reopen.form', [ $ticket->id ]) }}">
                <i class="fas fa-door-open"></i>

                Reopen Ticket
            </a>
        </template>

        <template slot="table-header">
            <td>{{ __('Date') }}</td>
            <td>{{ __('Title') }}</td>
            <td>{{ __('Involved User') }}</td>
        </template>

        <template 
            slot="table-body" 
            slot-scope="{ contents }">
            <tr
                v-bind:key="content.id"
                v-for="content in contents"> 
                <td>@{{ content.human_readable_created_at }}</td>
                <td>@{{ content.title }}</td>
                <td>@{{ content.author_name }}</td>
            </tr>
        </template>
    </table-ajax>
</div>
@endsection
