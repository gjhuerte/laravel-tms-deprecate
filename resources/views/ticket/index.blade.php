@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3 p-3" style="background-color: white;">
	<div>
		<div class="form-group mr-2 float-left">
			<select 
				id="ticket-category"
				name="ticket-category"
				class="form-control">
				<option>Software Applications</option>
				<option>Hardware</option>				
			</select>
		</div>
		<div class="form-group mr-2 float-left">
			<select 
				id="ticket-status"
				name="ticket-status"
				class="form-control">
				<option>Open</option>
				<option>Closed</option>			
			</select>
		</div>
		<div class="form-group mr-2 float-left">
			<select 
				id="ticket-priority"
				name="ticket-priority"
				class="form-control">
				<option>Level 5</option>
				<option>Level 4</option>			
			</select>
		</div>
	</div>
	<div class="float-right">
		<a href="{{ url('ticket/create') }}" class="btn btn-success">Create Ticket</a>
	</div>
	<div class="clearfix"></div>
	<table class="table table-condensed table-bordered table-hover" id="ticketsTable">
		<thead>
			<th>ID</th>
			<th>Title</th>
			<th>Category</th>
			<th>Assigned</th>
			<th>Status</th>
		</thead>
	</table>
</div>
@endsection