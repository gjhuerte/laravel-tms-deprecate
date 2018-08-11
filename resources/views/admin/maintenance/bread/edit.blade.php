@extends('admin.maintenance.index')

@section('maintenance-body')
@include('notification.alert')
<div class="row p-3" style="background-color: white;">
	<div class="col-sm-12 my-1">
		<h1>Maintenance</h1>
	</div>
	<div class="col-sm-12 my-1">
		@include('notification.alert')
		<form method="post" action="{{ url($path['forms']['edit'] . '/' . $datum->id ) }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="hidden" name="_method" value="PUT" />
			@foreach( $fields as $key => $value )
			<div class="form-group">
				<input 
						type="text" 
						name="{{ $key }}"
						value="{{ isset( $datum->$key ) ? $datum->$key : old( $key ) }}"
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