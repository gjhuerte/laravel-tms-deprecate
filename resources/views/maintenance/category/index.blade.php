@extends('layouts.client')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 my-1">
                <h1 class="display-4">{{ __('Category List') }}</h1>
            </div>
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Maintenance</li>
                    <li class="breadcrumb-item">Ticket</li>
                    <li class="breadcrumb-item">Category</li>
                </ul>
            </div>
            <div class="col-sm-12 my-1">
                @include('notification.alert')

                <table-ajax
                    base-url="{{ route('category.index') }}"
                    ajax-url="{{ route('api.category.index') }}"
                    api-token="{{ Auth::user()->api_token }}"
                    create-url="{{ route('category.create') }}"
                    column-count="6">
                    <template slot="right_header">
                        <a
                            href="{{ route('category.create') }}"
                            class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            {{  __('Create') }}
                        </a>
                    </template>

                    <template slot="table-header">
                        <td>{{ __('ID') }}</td>
                        <td>{{ __('Name') }}</td>
                        <td>{{ __('Description') }}</td>
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
                            <td>@{{ content.human_readable_created_at }}</td>
                            <td>@{{ content.human_readable_updated_at }}</td>
                            <td>
                                <a
                                    v-bind:href="content.links.edit_url"
                                    class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                    Update
                                </a>

                                <button
                                    type="button"
                                    v-bind:url="content.remove_url"
                                    class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    Remove
                                </button>
                            </td>
                        </tr>
                    </template>
                </table-ajax>
            </div>
        </div>
    </div>
@endsection
