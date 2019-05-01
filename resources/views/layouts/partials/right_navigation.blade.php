<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown hidden-md-down">
        <a 
            class="nav-link dropdown-toggle" 
            href="#" 
            id="navbarDropdownMenuLink" 
            data-toggle="dropdown" 
            aria-haspopup="true"
            aria-expanded="false">
            {{ Auth::user()->full_name }}
        </a>

        <div 
            class="dropdown-menu dropdown-menu-right" 
            aria-labelledby="navbarDropdownMenuLink">

            <a 
                href="{{ route('user.profile', Auth::user()->username) }}"
                class="dropdown-item">
                {{ _('Profile') }}
            </a>

            <a 
                href="{{ url('settings') }}" 
                class="dropdown-item">
                {{ _('Settings') }}
            </a>

            <div class="dropdown-divider"></div>

            <button 
                role="button"
                type="button" 
                class="dropdown-item"
                onclick="document.getElementById('logout-form').submit()">
                {{ __('Logout') }}
            </button>

            <form 
                id="logout-form"
                class="d-none"
                method="post"
                action="{{ route('logout') }}">
                @csrf
            </form>
        </div>
    </li>
</ul>
