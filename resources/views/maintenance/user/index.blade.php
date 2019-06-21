@extends('layouts.client')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-12 my-1">
                <h1 class="display-4">{{ __('User List') }}</h1>
            </div>
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">User</li>
                </ul>
            </div>
            <div class="col-sm-12 my-1">
                @include('notification.alert')

                <table-ajax
                    base-url="{{ route('user.index') }}"
                    ajax-url="{{ route('api.user.index') }}"
                    api-token="{{ Auth::user()->api_token }}"
                    create-url="{{ route('user.create') }}"
                    column-count="10">
                    <template slot="right_header">
                        <a
                            href="{{ route('user.create') }}"
                            class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            {{  __('Create') }}
                        </a>
                    </template>

                    <template slot="table-header">
                        <td>{{ __('Username') }}</td>
                        <td>{{ __('Firstname') }}</td>
                        <td>{{ __('Middlename') }}</td>
                        <td>{{ __('Lastname') }}</td>
                        <td>{{ __('Email') }}</td>
                        <td>{{ __('Role') }}</td>
                        <td>{{ __('Mobile Number') }}</td>
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
                            <td>@{{ content.username }}</td>
                            <td>@{{ content.firstname }}</td>
                            <td>@{{ content.middlename }}</td>
                            <td>@{{ content.lastname }}</td>
                            <td>@{{ content.email }}</td>
                            <td>@{{ content.role }}</td>
                            <td>@{{ content.mobile }}</td>
                            <td>@{{ content.human_readable_created_at }}</td>
                            <td>@{{ content.human_readable_updated_at }}</td>
                            <td>

                                <div class="d-flex flex-row justify-content-around align-items-center">
                                    <a-button-loading
                                        v-bind:element-href="content.links.edit_url"
                                        element-class="btn btn-warning"
                                        loading-text="Fetching...">
                                        <i class="fas fa-edit"></i>
                                        Update
                                    </a-button-loading>

                                    <remove-button-loading-i
                                        v-bind:content-id="content.id"
                                        v-bind:url="content.links.remove_url"
                                        element-class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                        Remove
                                    </remove-button-loading-i>
                                </div>
                            </td>
                        </tr>
                    </template>
                </table-ajax>
            </div>
        </div>
    </div>
@endsection
