@extends('admin.maintenance.app')

@section('maintenance-body')
@include('notification.alert')
<div class="row p-3" style="background-color: white;">
	<div class="col-sm-12 my-1">
		<h1 class="display-4">Edit: {{ $variable->title }}</h1>
	</div>
	<div class="col-sm-12 my-1">
		@include('notification.alert')
		<form method="post" action="{{ url("$variable->formBasePath/$model->id") }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="hidden" name="_method" value="PUT" />
			@include('admin.maintenance.bread.form')
			<div class="form-group">
				<input type="submit" name="button" value="Update" class="btn btn-primary" />
			</div>
		</form>
	</div>
</div>
@endsection