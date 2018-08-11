@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <section id="settings-sidebar-list" class="col-md-3">
        <div class="card">   
            <div class="card-header">
                Navigation
            </div>
            <div class="card-body">
            @include('settings.sidebar')
            </div>
        </div>
    </section>
</div>

@endsection