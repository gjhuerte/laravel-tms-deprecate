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
		value="{{ $organization->name ?? old('name') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="abbreviation">
		Abbreviation
	</label>
		
	<input 
		type="text"
		id="abbreviation"
		name="abbreviation"
		class="form-control"
		placeholder="e.g. TS"
		value="{{ $organization->abbreviation ?? old('abbreviation') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="parent_id">
		Parent Organization
	</label>
		
	<select
		class="form-control"
		name="parent_id"
		id="parent_id">
		<option value>Select an organization...</option>

		@forelse($organizations as $org)
			<option

				@if($org->id == old('parent_id'))
					selected
				@elseif(isset($organization->parent_id))
					@if($organization->parent_id == $org->id)
						selected
					@endif
				@elseif(Request::has('parent_id'))
					@if(Request::get('parent_id') == $org->id)
						selected
					@endif
				@endif

				value="{{ $org->id }}">
				{{ $org->name }}
			</option>
		@empty
		@endforelse
	</select>
</div>