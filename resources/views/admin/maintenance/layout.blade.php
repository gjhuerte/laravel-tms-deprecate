@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3 row">
    <section id="maintenance-sidebar-list" class="col-lg-3">
        <div class="card">   
            <div class="card-header">
                Navigation
            </div>
            @include('admin.maintenance.sidebar')
        </div>
    </section>
    <section id="maintenance-sidebar-list" class="col-lg-9">
        @yield('maintenance-body')
    </section>
</div>

@endsection