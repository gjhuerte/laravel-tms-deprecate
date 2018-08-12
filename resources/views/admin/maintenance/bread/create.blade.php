@extends('admin.maintenance.layout')

@section('maintenance-body')
@include('notification.alert')
<div class="row p-3" style="background-color: white;">
	<div class="col-sm-12 my-1">
		<h1>{{ $path['titles']['create'] }}</h1>
	</div>
	<div class="col-sm-12 my-1">
		@include('notification.alert')
		<form method="post" action="{{ url( $path['forms']['save'] ) }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			@foreach( $fields as $key => $value )
			<div class="form-group">
				<input 
						type="text" 
						name="{{ $key }}"
						@foreach( $value['args'] as $key => $value ){{ "$key=$value " }}@endforeach
				/>
			</div>
			@endforeach
			<div class="form-group">
				<input type="submit" name="button" value="Save" class="btn btn-primary" />
			</div>
		</form>
	</div>
</div>
@endsection