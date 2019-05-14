
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
