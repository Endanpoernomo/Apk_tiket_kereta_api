<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tiket Kereta</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Box Icons -->
  <link rel="stylesheet" href="{{ asset('dist/boxicons/css/boxicons.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white">
    <!-- Left navbar links -->
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bx bx-menu text-lg"></i></a>
        
      </li>
    </ul>
    <h5>Selamat datang {{ auth()->user()->name }}</h5>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('/dasboard') }}" class="brand-link d-flex justify-content-center align-items-center">
      <img src="{{ asset('img/train.png') }}" alt="AdminLTE Logo" class="brand-image elevation-1">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/avatar4.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/profile" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MENU</li>
        @if (auth()->guard("user")->check())
          <li class="nav-item">
            <a href="{{ asset('/customers') }}" class="nav-link">
              <i class='nav-icon bx bx-group'></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          @endif
          {{-- cek kalo yg login itu user bukan customer keluarin menu booking asli --}}
          @if (auth()->guard("user")->check())
          <li class="nav-item">
            <a href="{{ asset('booking') }}" class="nav-link">
              <i class="nav-icon bx bx-book"></i>
              <p>
                Booking
              </p>
            </a>
          </li>
          @else
          <li class="nav-item">
            <a href="{{ asset('customers/booking') }}" class="nav-link">
              <i class="nav-icon bx bx-book"></i>
              <p>
                Booking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ asset('customers/booking/detail') }}" class="nav-link">
              <i class="nav-icon bx bx-book"></i>
              <p>
                Detail Booking
              </p>
            </a>
          </li>
          @endif
          @if (auth()->guard("user")->check())
          <li class="nav-item">
            <a href="{{ asset('kereta') }}" class="nav-link">
              <i class="nav-icon bx bx-train"></i>
              <p>
                Trains
              </p>
            </a>
          </li>
          @endif
          @if (auth()->guard("user")->check())
          <li class="nav-item">
            <a href="{{ asset('stasiun') }}" class="nav-link">
              <i class="nav-icon bx bx-station"></i>
              <p>
                Train Stations
              </p>
            </a>
          </li>
          @endif
          @if (auth()->guard("user")->check())
          <li class="nav-item">
            <a href="{{ asset('routes') }}" class="nav-link">
              <i class="nav-icon bx bx-map"></i>
              <p>
                  Train Routes
              </p>
            </a>
          </li>
          @endif
          @if (auth()->guard("user")->check())
          <li class="nav-item">
            <a href="{{ asset("journeys") }}" class="nav-link">
              <i class="nav-icon bx bx-map-alt"></i>
              <p>
                Train Journeys
              </p>
            </a>
          </li>
          @endif
          @if (auth()->guard("user")->check())
          <li class="nav-item">
              <a href="{{ asset('fare') }}" class="nav-link">
                <i class="nav-icon bx bx-money"></i>
                <p>
                    Train Fare
                </p>
            </a>
        </li>
        @endif
        @if (auth()->guard("user")->check())
          <li class="nav-item">
            <a href="{{ asset('users') }}" class="nav-link">
              <i class="nav-icon bx bx-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
        </li>
        @endif
          <li class="nav-item">
            <form action="{{ asset('logout') }}" method="POST">
              @csrf
              <button type="submit" class="text-left nav-link bg-transparent border-0 btn d-block" id="logoutBtn">
              <i class="nav-icon bx bx-log-out"></i>
                Log Out
              </button>
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    <!-- Main content -->

    <!-- <div class="container">
  <div class="card-group">
  <div class="card">
    <img class="card-img-top" src="https://wallpapercave.com/wp/wp10514716.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
  </div>
  <br>
<div class="container">
    <div class="col-md-8">

      

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://images.unsplash.com/photo-1612527670286-1912f78763f2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8a2VyZXRhJTIwYXBpfGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://wallpapercave.com/wp/wp10514716.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://wallpapercave.com/wp/wp10514706.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
</div>
  <br>
 -->


    <section class="content">
      <div class="container-fluid p-3">
        <!-- Info boxes -->
        <div class="row">
          @if ($errors->any())
          <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
              @foreach ($errors->all() as $error)
              <li class="text-white">
                {{ $error }}
              </li>
              @endforeach
            </ul>
          </div>
          @endif
          @if (session()->has("error"))
          <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-white">{{ session()->get("error") }}</p>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @if (session()->has("success"))
          <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-white">{{ session()->get("success") }}</p>
            <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
            <div class="col-12">
                @yield("content")
            </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script>
    $(function () {
        $(".dataTable").dataTable();
    });
</script>
@yield("script")
</body>
</html>
