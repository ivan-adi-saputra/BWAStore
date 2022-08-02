 <nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="/images/logo.svg" alt="" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }} ">
              <a class="nav-link" href="{{ route('home') }}">Home </a>
            </li>
            <li class="nav-item {{ Route::is('categories') ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('categories') }}">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Rewards</a>
            </li>
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
              </li>
              <li class="nav-item">
                <a
                  class="btn btn-success nav-link px-4 text-white"
                  href="{{ route('login') }}"
                  >Sign In</a
                >
              </li>
            @endguest
          </ul>

          @auth
               <ul class="navbar-nav ml-auto d-none d-lg-flex">
                <li class="nav-item dropdown">
                  <a
                    class="nav-link"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <img
                      src="/images/icon-user.png"
                      alt=""
                      class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{ auth()->user()->name }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('dashboard') }}"
                      >Dashboard</a
                    >
                    <a class="dropdown-item" href="{{ route('dashboard-account') }}"
                      >Settings</a
                    >
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="post">
                    @csrf
                      <button class="dropdown-item border-0">Logout</button>
                    </form>
                  </div>
                </li>
              </ul>
              <!-- Mobile Menu -->
              <ul class="navbar-nav d-block d-lg-none mt-3">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    Hi, Angga
                  </a>
                </li>
              </ul>
          @endauth
        </div>
      </div>
    </nav>