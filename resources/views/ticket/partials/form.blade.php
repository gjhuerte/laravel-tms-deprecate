@include('ticket.partials.title_field')

@include('ticket.partials.details_field')

<div class="col-sm-12">
	<div class="form-group">
		<label for="level">Level of Urgency</label>
		<select
			name="level"
			class="form-control"
			id="level"
			name="level"
		>

		@foreach($levels as $key => $value)
			<option
				value="{{ $key }}"
				@if(old('level') == $key)
				selected
				@endif
			>{{ $value }}</option>
		@endforeach
		
		</select>
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group">
		<label for="category">Category</label>
		<select
			name="category"
			class="form-control"
			id="category"
			name="category"
		>
		@foreach($categories as $key => $value)
			<option
				value="{{ $key }}"
				@if(old('category') == $key)
				selected
				@endif
			>{{ $value }}</option>
		@endforeach
		</select>
	</div>
</div>

@include('ticket.partials.contact_field')

@include('ticket.partials.tags_field')

<div class="col-sm-12">
	<div class="form-group">
		<label for="notes">Additional Notes:</label>
		<textarea 
			class="form-control"
			name="notes"
			id="notes"
			placeholder="Enter additional notes here..."
		>{{ isset($ticket->notes) ? $ticket->notes : old('notes') }}</textarea>
	</div>
</div>
