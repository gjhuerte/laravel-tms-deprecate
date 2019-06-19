<div class="form-group">
	<label for="firstname">
		Firstname
	</label>
		
	<input 
		type="text"
		id="firstname"
		name="firstname"
		class="form-control"
		placeholder="e.g. John"
		value="{{ $user->firstname ?? old('firstname') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="middlename">
		Middlename
	</label>
		
	<input 
		type="text"
		id="middlename"
		name="middlename"
		class="form-control"
		placeholder="e.g. Dela Cruz"
		value="{{ $user->middlename ?? old('middlename') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="lastname">
		Lastname
	</label>
		
	<input 
		type="text"
		id="lastname"
		name="lastname"
		class="form-control"
		placeholder="e.g. Doe"
		value="{{ $user->lastname ?? old('lastname') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="email">
		E-mail
	</label>
		
	<input 
		type="email"
		id="email"
		name="email"
		class="form-control"
		placeholder="e.g. john.doe@email.com"
		value="{{ $user->email ?? old('email') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="namrolee">
		Role
	</label>
		
	<input 
		type="text"
		id="role"
		name="role"
		class="form-control"
		placeholder="e.g. Software Engineer"
		value="{{ $user->role ?? old('role') }}"
		max=50
		required
	/>
</div>

<div class="form-group">
	<label for="organization_id">
		Organization
	</label>
		
	<select
		id="organization_id"
		name="organization_id"
		class="form-control">
		<option value="">Select an organization...</option>

		@forelse($organizations as $organization)
			<option 
				@if(old('organization_id') == $organization)
					selected
				@elseif(isset($user->organization_id))
					@if($user->organization_id == $organization->id)
						selected
					@endif
				@endif
				value="{{ $organization->id }}">
				{{ $organization->name }}		
			</option>
		@empty

		@endforelse
	</select>
</div>