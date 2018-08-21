<tr rowspan="1">
	<th colspan="5">
		<div class="form-inline">
			Category:
			<select 
				id="ticket-category"
				name="ticket-category"
				class="form-control mx-2">
				@if(isset($categories))
					@foreach($categories as $category)
					<option value="{{ $category->name }}">{{ $category->name }}</option>
					@endforeach
				@endif		
			</select>
			Status:
			<select 
				id="ticket-status"
				name="ticket-status"
				class="form-control mx-2">
				@if(isset($status))
					@foreach($status as $status)
					<option value="{{ $status }}">{{ $status }}</option>		
					@endforeach
				@endif
			</select>
			Level:
			<select 
				id="ticket-priority"
				name="ticket-priority"
				class="form-control mx-2">
				@if(isset($levels))
					@foreach($levels as $level)
					<option value="{{ $level->name }}">{{ $level->name }}</option>
					@endforeach
				@endif			
			</select>
		</div>
	</th>
</tr>