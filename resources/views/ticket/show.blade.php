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
            <li class="breadcrumb-item active" aria-current="page">{{ $ticket->code }}</li>
        </ol>
    </nav>

    @if(count((array) $tags) > 0)
        <div class="tags border-bottom mb-2">
            <label>
                <strong>Tags: </strong>
            </label>

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
            @if(! $isClosed)
                <a 
                    id="add-resolution-button"
                    class="btn btn-success btn-sm"
                    href="{{ route('ticket.resolve.form', [ $ticket->id ]) }}">
                    <i class="fas fa-plus"></i>

                    Create Solution
                </a>

                <a 
                    id="add-resolution-button"
                    class="btn btn-info btn-sm"
                    href="{{ route('ticket.verify.form', [ $ticket->id ]) }}">
                    <i class="fas fa-thumbs-up"></i>

                    Verified By ({{ $isVerified }})
                </a>

                <a 
                    id="transfer-button"
                    class="btn btn-primary mr-1 text-light btn-sm"
                    href="{{ route('ticket.transfer.form', [ $ticket->id ]) }}">
                    <i class="fas fa-share"></i>
                    
                    @if($isAssigned)
                        Transfer Staff
                    @else
                        Assign Staff
                    @endif
                </a>
            
                <a 
                    id="close-button"
                    class="btn btn-danger mr-1 text-light btn-sm"
                    href="{{ route('ticket.close.form', [ $ticket->id ]) }}">
                    <i class="fas fa-door-closed"></i>

                    Close Ticket
                </a>
            @endif
                
            @if($isClosed)
                <a 
                    id="close-button"
                    class="btn btn-secondary mr-1 text-light btn-sm"
                    href="{{ route('ticket.reopen.form', [ $ticket->id ]) }}">
                    <i class="fas fa-door-open"></i>

                    Reopen Ticket
                </a>
            @endif
        </template>

        <template slot="table-header">
            <tr>
                <th colspan=2 style="font-weight: normal">
                    <strong>Code: </strong>{{ $ticket->code }}
                </th>
                <th colspan=2 style="font-weight: normal">
                    <strong>Title: </strong>{{ $ticket->title }}
                </th>
            </tr>
            <tr>
                <th colspan=2 style="font-weight: normal">
                    <strong>Author: </strong>{{ $ticket->author->full_name ?? 'Not Set' }}
                </th>
                <th colspan=2 style="font-weight: normal">
                    <strong>Created At: </strong>{{ $ticket->created_at }}
                </th>
            </tr>
            <tr>
                <th colspan=2 style="font-weight: normal">
                    <strong>Current Assigned: </strong>{{ $ticket->personnel->full_name }}
                </th>
                <th colspan=2 style="font-weight: normal">
                    <strong>Status: </strong>{{ $ticket->status }}
                
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
                <th>{{ __('Date') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Involved User') }}</th>
            </tr>
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
