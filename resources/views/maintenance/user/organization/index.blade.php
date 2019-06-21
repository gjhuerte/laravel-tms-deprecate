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
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item">Organization</li>
                </ul>
            </div>
            <div class="col-sm-12 my-1">
                @include('notification.alert')

                <table-ajax
                    base-url="{{ route('organization.index') }}"
                    ajax-url="{{ route('api.organization.index') }}"
                    api-token="{{ Auth::user()->api_token }}"
                    create-url="{{ route('organization.create') }}"
                    column-count="6">
                    <template slot="right_header">
                        <a
                            href="{{ route('organization.create') }}"
                            class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            {{  __('Create') }}
                        </a>
                    </template>

                    <template slot="table-header">
                        <td>{{ __('ID') }}</td>
                        <td>{{ __('Name') }}</td>
                        <td>{{ __('Abbreviation') }}</td>
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
                            <td>@{{ content.abbreviation }}</td>
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
