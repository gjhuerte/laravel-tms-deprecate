@foreach( $args->columns as $key => $column )

	@if(isset($column->attributes))

	<div class="form-group">
		<label 
			for="{{ isset($column->attributes->id) ? $column->attributes->id : "" }}">
			{{ ucfirst($column->name) }}
		</label>

		@if($column->selectAttribute)
			<select 
				@foreach($column->attributes as $key => $value) 
					{{ $key }}="{{ $value }}" 
				@endforeach 
				>
				@foreach($column->select->values as $key => $value)
				<option 
					value="{{ $key }}"
					@if($key)
					@php $model_name = $column->attributes->name @endphp
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
				@foreach( $column->attributes as $key => $value ) 
				{{ $key }}="{{ $value }}" 
				@endforeach 
			/>
		@endif
	</div>
	@endif
@endforeach
