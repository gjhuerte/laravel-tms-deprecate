@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul style='margin-left: 10px;'>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1>Maintenance</h1>
<a href="{{ url( $path['create'] ) }}">Create</a>
<table>
	<thead>
	@foreach( $columns as $key => $value )
		@if( $value['select'] )
		<td>{{ $key }}</td>
		<td></td>
		@endif
	@endforeach
	</thead>
	<tbody>
	@foreach( $data as $datum )
		<tr>
		@foreach( $columns as $key => $value )
			@if( $value['select'] )
			<td>{{ $datum->$key }}</td>
			@endif
		@endforeach
			<td><a href="{{ url( $path['edit']['prefix'] . '/' .$datum->id . '/' . $path['edit']['suffix'] ) }}">Update</a></td>
		</tr>
	@endforeach
	</tbody>
</table>