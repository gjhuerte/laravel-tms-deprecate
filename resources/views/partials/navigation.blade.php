<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
		<li class="nav-item">
			<a class="nav-link" href="{{ url('/') }}">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ url('ticket') }}">Tickets</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ url('maintenance') }}">Maintenance</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ url('report') }}">Reports</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ url('settings') }}">Settings</a>
		</li>
    </ul>
    <ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" href="{{ url('profile/' . Auth::user()->username ) }}">John Doe</a>
		</li>
    </ul>
  </div>
</nav>