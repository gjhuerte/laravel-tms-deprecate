@extends('admin.maintenance.layout')

@section('maintenance-body')
<div class="row p-3" style="background-color: white;">
	<div class="col-sm-12 my-1">
		<h1>Maintenance</h1>
	</div>
	<div class="col-sm-12 my-1">
		<a class="btn btn-outline-success" href="{{ url( $path['create'] ) }}">Create</a>
	</div>
	<div class="col-sm-12 my-1">
		@include('notification.alert')
		<table class="table table-hover table-bordered">
			<thead>
			@foreach( $columns as $key => $value )
				@if( $value['select'] )
				<td>{{ ucfirst($key) }}</td>
				@endif
			@endforeach
				<td></td>
			</thead>
			<tbody>
			@foreach( $data as $datum )
				<tr>
				@foreach( $columns as $key => $value )
					@if( $value['select'] )
					<td>{{ $datum->$key }}</td>
					@endif
				@endforeach
					<td>
						<a class="btn btn-secondary" href="{{ url( $path['edit']['prefix'] . '/' .$datum->id . '/' . $path['edit']['suffix'] ) }}">
							Update
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection