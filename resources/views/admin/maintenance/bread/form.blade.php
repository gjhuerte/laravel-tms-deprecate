@foreach( $variable->columns as $key => $value )
	@if(isset($value->attributes))
	<div class="form-group">
		<label for="{{ isset($value->attributes->id) ? $value->attributes->id : "" }}">{{ ucfirst($key) }}</label>
		<input 
			value="{{ isset($model->$key) ? $model->$key : old("$key") }}"
			@foreach( $value->attributes as $key => $value ) 
			{{ $key }}="{{ $value }}" 
			@endforeach 
			/>
	</div>
	@endif
@endforeach