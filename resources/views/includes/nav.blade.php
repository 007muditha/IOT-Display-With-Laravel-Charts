<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ url('/') }}">IOT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/packet">Packet</a>
        </li>
      </ul>
        <div class="form-inline my-2 my-lg-0">
          <!-- Authentication Links -->
          @guest
              <a class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" href="{{ route('login') }}">Login</a>
              <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('register') }}">Register</a>
              {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
          @else

            <span class="navbar-text my-2 my-sm-0 mr-sm-2">
                    Hi, {{ Auth::user()->name }} <span class="caret"></span>
           </span>
            <a class="btn btn-outline-success my-2 my-sm-0 mr-sm-2"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>

        @endguest
      </div>
    </div>
</nav>
