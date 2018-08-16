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
				value="{{ $key }}"
				@if($key)
				@php $model_name = $args->attributes->name @endphp
				{{ ( ( isset($model->$model_name) && $model->$model_name == $key) || old("$key") == $key ) ? 'selected' : '' }}
				@endif
				>
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