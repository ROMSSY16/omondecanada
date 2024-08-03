<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center w-100">
        <nav aria-label="breadcrumb">
          <h2 class="font-weight-bolder mb-0 d-none d-md-block">{{ $pageTitle ?? $page  }}</h2> <!-- Hide on small screens -->
              </nav>
        <ul class="navbar-nav d-flex justify-content-end w-auto">
          <li class="nav-item d-sm-none d-md-flex "> <!-- Hide on small screens -->
            @include('partials.user')
          </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  