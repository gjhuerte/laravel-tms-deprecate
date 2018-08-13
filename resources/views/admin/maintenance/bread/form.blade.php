@foreach( $variable->columns as $key => $args )
	@if(isset($args->attributes))
	<div class="form-group">
		<label for="{{ isset($args->attributes->id) ? $args->attributes->id : "" }}">{{ ucfirst($args->name) }}</label>
		@if($args->selectAttribute)
		<select 
			@foreach( $args->attributes as $key => $value ) 
			{{ $key }}="{{ $value }}" 
			@endforeach 
			>
			@foreach($args->select->values as $key => $value)
			<option 
				name="{{ $key }}"
				{{ ( ( isset($model->category)) || old("$key") == $key ) ? 'selected' : '' }}>
				{{ $value }}
			</option>
			@endforeach
		</select>
		@else
			<input 
				value="{{ isset($model->$key) ? $model->$key : old("$key") }}"
				@foreach( $args->attributes as $key => $value ) 
				{{ $key }}="{{ $value }}" 
				@endforeach 
			/>
		@endif
	</div>
	@endif
@endforeach