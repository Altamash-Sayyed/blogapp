<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Blog App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        @auth
        <ul class="navbar-nav mr-auto">
          
            <li class="nav-item">
                <a class="nav-link" href="{{url('create')}}">Create Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('profile')}}">My Posts</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}">Logout</a>
          
            </li>
        </ul>
        @else
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                <a class="nav-link" href="{{ route('register') }}">Register</a>
                @endif
            </li>
        </ul>
        @endauth

    </div>
</nav>