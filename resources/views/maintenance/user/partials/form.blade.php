<div class="form-group">
	<label for="name">
		Name
	</label>
		
	<input 
		type="text"
		id="name"
		name="name"
		class="form-control"
		placeholder="e.g. Technical Support"
		value="{{ $category->name ?? old('name') }}"
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
		placeholder="e.g. Cluster of tickets with regards to technical issues such as computer malfunction, application crashes, etc..."
	>{{ $category->description ?? old('description') }}</textarea>
</div>
