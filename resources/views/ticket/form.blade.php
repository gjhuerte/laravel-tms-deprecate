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
<div class="form-group">
	<label for="details">Details</label>
	<textarea 
		class="form-control"
		name="details"
		id="details"
		placeholder="Enter details here..."
	>
	{{ isset($ticket->details) ? $ticket->details : old('details') }}
	</textarea>
</div>
<div class="form-group">
	<label for=""></label>
	<select 
		class="form-control"
		>
		<option 
			value=""
			>
		</option>
	</select>
</div>
<div class="form-group">
	<label for=""></label>
	<input 
		value=""
		class="form-control"
	/>
</div>