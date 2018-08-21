@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3 p-3">
	<div class="row">
		<div class="col-md-3 my-3">
			<div class="card">
				<div class="card-body">
					<p class="text-center display-4">Messages</p>
				</div>
			</div>
		</div>
		<div class="col-md-6 my-3">
			<div class="card">
				<div class="card-body">
					<p class="text-center display-4">Announcements</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 my-3">
			<div class="card">
				<div class="card-body">
					<p class="text-center display-4">Reports</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection