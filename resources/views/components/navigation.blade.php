<div>
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('/dashboard/account') }}">My Account</a></li>
        <form method="POST" action="{{ route('logout') }}"><li> 
<a href="{{route('logout')}}" onclick="event.preventDefault();
          this.closest('form').submit();">Logout</a>
          @csrf</li></form>
      </ul>


      <nav class="white">
       <div class="container">
        <div class="nav-wrapper">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons indigo accent-1-text">menu</i></a>

            <!-- PROJECT LOGO-->
            <a href="/" class="brand-logo grey-text"><img class="dim" style="margin-top:10px" width=50 src="{{asset('images/logo.png')}}" alt=""></a>
            <ul class="right hide-on-med-and-down">
              <li class="{{ request()->is('jobs') ? 'active' : '' }}"><a href="/jobs" class="grey-text">Jobs</a></li>
              <li class="{{ request()->is('companies') ? 'active' : '' }}"><a href="/companies" class="grey-text">Companies</a></li>
              <li><a href="#" class="grey-text">How it Works</a></li>
              @if (Route::has('login'))
          
                  @auth
                  <li><a class="dropdown-trigger grey-text" href="#!" data-target="dropdown1">{{ Auth::user()->name }}<i class="material-icons right indigo-text">arrow_drop_down</i></a></li>
                  @else
                      <strong><li><a href="{{ route('login') }}" class="indigo-text" style="font-weight: bold">Log in</a></li>

                      @if (Route::has('register'))
                      <li><a href="{{ route('register') }}" class="indigo-text" style="font-weight: bold">Register</a></li>
                      @endif
                  @endauth
 
          @endif
            </ul>
          </div>
       </div>
      </nav>

    <!-- SIDE NAV COMPONENT -->  
    <x-side-nav />
</div>