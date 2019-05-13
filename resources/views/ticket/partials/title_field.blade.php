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
