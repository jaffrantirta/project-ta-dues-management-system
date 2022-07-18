<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="{{ asset('storage/logo/logo.png') }}" alt="">
      <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ auth()->user()->name }}</h6>
            <span>{{ auth()->user()->roles[0]->name }}</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          {{-- <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="fa fa-user"></i>
              <span>Profil</span>
            </a>
          </li> --}}
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#" onclick="logout()">
              <i class="fa fa-right-from-bracket"></i>
              <span>Keluar</span>
            </a>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<script>
  function logout(){
      Swal.fire({
          title: 'Yakin logout ?',
          showCancelButton: true,
          confirmButtonColor: '#ff6600',
          confirmButtonText: 'Logout',
          dangerMode: true,
      }).then( function(result){
          if(result.isConfirmed){
              event.preventDefault();document.getElementById('logout-form').submit();
          }
      })
  }
</script>