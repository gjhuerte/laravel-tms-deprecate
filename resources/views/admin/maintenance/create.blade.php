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
<form method="post" action="{{ url( $path['forms']['save'] ) }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	@foreach( $fields as $key => $value )
	<input 
			type="text" 
			name="{{ $key }}"
			@foreach( $value['args'] as $key => $value ){{ "$key=$value " }}@endforeach
	/>
	@endforeach
	<input type="submit" name="button" value="Save" />
</form>