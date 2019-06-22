<div class="col-sm-12">
	<div class="form-group">
		<label for="title">Title</label>
		<input 
			value="{{ isset($ticket->title) ? $ticket->title : old('title') }}"
			class="form-control"
			name="title"
			id="title"
			placeholder="Enter title..."
		/>
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group">
		<label for="details">Details</label>

		<wysiwyg-textarea
			v-bind:element-name="'details'"
			v-bind:element-id="'details'"
			v-bind:element-style="'height: 350px'">
		</wysiwyg-textarea>
	</div>
</div>


<div class="col-sm-12">
	<div class="form-group">
		<label for="level">Level of Urgency</label>

		<select
			name="level"
			class="form-control"
			id="level"
			name="level">
			@foreach($levels as $key => $value)
				<option
					value="{{ $key }}"
					@if(old('level') == $key)
						selected
					@endif>
					{{ $value }}
				</option>
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
			name="category">
			@foreach($categories as $key => $value)
				<option
					value="{{ $key }}"
					@if(old('category') == $key)
					selected
					@endif>
					{{ $value }}
				</option>
			@endforeach
		</select>
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group">
		<label for="contact">Contact Information</label>
		<input 
			value="{{ isset($ticket->alt_contact) ? $ticket->alt_contact : old('contact') }}"
			class="form-control"
			name="contact"
			id="contact"
			placeholder="Enter Contact Information..."
		/>
	</div>
</div>

<div class="col-sm-12">
	<div class="form-group">
		<label for="tags">Tags</label>
		<multi-select element-name="tags" />
	</div>
</div>

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
