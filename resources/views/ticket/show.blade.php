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

                <label class="badge badge-{{ $color }} p-2">{{ $tag->name }}</label>
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
                href="{{ route('ticket.create') }}"
                class="btn btn-primary">
                <i class="fas fa-plus"></i>
                {{  __('Create') }}
            </a>
        </template>

        <template slot="table-header">
            <td>{{ __('Code') }}</td>
            <td>{{ __('Title') }}</td>
            <td>{{ __('Status') }}</td>
            <td>{{ __('Created At') }}</td>
            <td></td>
        </template>

        <template 
            slot="table-body" 
            slot-scope="{ contents }">
            <tr
                v-bind:key="content.id"
                v-for="content in contents"> 
                <td>@{{ content.title }}</td>
                <td>@{{ content.author_name }}</td>
                <td>@{{ content.human_readable_created_at }}</td>
            </tr>
        </template>
    </table-ajax>
</div>
@endsection
