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

                <table-ajax
                    base-url="{{ route('ticket.index') }}"
                    ajax-url="{{ route('api.ticket.index') }}"
                    api-token="{{ Auth::user()->api_token }}"
                    create-url="{{ route('ticket.create') }}"
                    column-count="7">
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
                        <td>{{ __('Updated At') }}</td>
                        <td></td>
                    </template>

                    <template 
                        slot="table-body" 
                        slot-scope="{ contents }">
                        <tr
                            v-bind:key="content.id"
                            v-for="content in contents"> 
                            <td>@{{ content.code }}</td>
                            <td>@{{ content.title }}</td>
                            <td>@{{ content.status }}</td>
                            <td>@{{ content.human_readable_created_at }}</td>
                            <td>@{{ content.human_readable_updated_at }}</td>
                            <td>

                                <div class="d-flex flex-row justify-content-around align-items-center">
                                    <a-button-loading
                                        v-bind:element-href="content.links.view_url"
                                        element-class="btn btn-info"
                                        loading-text="Fetching...">
                                        <i class="fas fa-list"></i>
                                        Show
                                    </a-button-loading>
                                </div>
                            </td>
                        </tr>
                    </template>
                </table-ajax>
            </div>
        </div>
    </div>
@endsection
