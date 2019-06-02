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
                    <li class="breadcrumb-item">Ticket</li>
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
                            <td>@{{ content.created_at }}</td>
                            <td>@{{ content.updated_at }}</td>
                            <td>
                                <button-confirmation
                                    element-type="button"
                                    element-id="remove-button"
                                    element-class="btn btn-danger"
                                    default-text="Remove">
                                </button-confirmation>
                            </td>
                        </tr>
                    </template>
                </table-ajax>
            </div>
        </div>
    </div>
@endsection
