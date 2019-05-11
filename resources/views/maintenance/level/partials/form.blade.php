<div class="form-group">
	<label for="name">
		Name
	</label>
		
	<input 
		type="text"
		id="name"
		name="name"
		class="form-control"
		placeholder="e.g. Level 10"
		value="{{ $level->name ?? old('name') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="details">
		Details
	</label>
		
	<input 
		type="text"
		id="details"
		name="details"
		class="form-control"
		placeholder="e.g. Serious problem occurred. Need to alert everyone"
		value="{{ $level->details ?? old('details') }}"
		max=50
		required
	/>
</div>
