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

@if(Request::has('parent_id'))
	<input type='hidden' name="parent_id" value="{{ Request::get('parent_id') }}" />
@endif
