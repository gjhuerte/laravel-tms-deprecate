<div class="form-group">
	<label for="name">
		Name
	</label>
		
	<input 
		type="text"
		id="name"
		name="name"
		class="form-control"
		placeholder="e.g. Need Support"
		value="{{ $tag->name ?? old('name') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="description">
		Description
	</label>
		
	<textarea
		rows=4
		id="description"
		name="description"
		class="form-control"
		placeholder="e.g. Important matters that need more care"
	>{{ $tag->description ?? old('description') }}</textarea>
</div>
