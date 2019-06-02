@extends('layouts.client')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 my-1">
                <h1 class="display-4">{{ __('Levels List') }}</h1>
            </div>
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Maintenance</li>
                    <li class="breadcrumb-item">Ticket</li>
                    <li class="breadcrumb-item">Level</li>
                </ul>
            </div>
            <div class="col-sm-12 my-1">
                @include('notification.alert')

                <table-ajax
                    base-url="{{ route('level.index') }}"
                    ajax-url="{{ route('api.level.index') }}"
                    api-token="{{ Auth::user()->api_token }}"
                    create-url="{{ route('level.create') }}"
                    column-count="6">
                    <template slot="table-header">
                        <td>{{ __('ID') }}</td>
                        <td>{{ __('Name') }}</td>
                        <td>{{ __('Details') }}</td>
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
                            <td>@{{ content.id }}</td>
                            <td>@{{ content.name }}</td>
                            <td>@{{ content.description }}</td>
                            <td>@{{ content.created_at }}</td>
                            <td>@{{ content.updated_at }}</td>
                            <td>
                                <button>Update</button>
                                <button>Remove</button>
                            </td>
                        </tr>
                    </template>
                </table-ajax>
            </div>
        </div>
    </div>
@endsection
