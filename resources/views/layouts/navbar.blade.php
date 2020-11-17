<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
    
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('flogout').submit();" class="dropdown-item dropdown-footer">
                <i class="fas fa-sign-out-alt"></i> Log Out
                <form id="flogout" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form> 
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
    
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">InventoryWebApp</span>
        </a>
    
        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">{{  Auth::user()->name }}</a>
            </div>
          </div>
    
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview {{ Request::segment(1) == 'produk' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::segment(1) == 'produk' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Produk
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('produk.index') }}" class="nav-link {{ Request::segment(2) == 'produk' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produk.kategori') }}" class="nav-link {{ Request::segment(2) == 'kategori' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Kategori</p>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('produk.stok') }}" class="nav-link {{ Request::segment(2) == 'stok' ? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Stok</p>
                      </a>
                  </li>
                    <li class="nav-item">
                        <a href="" class="nav-link {{ Request::segment(2) == 'laporan' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                </ul>
              </li>
              <li class="nav-item has-treeview {{ Request::segment(1) == 'master' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ Request::segment(1) == 'master' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Master
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('master.user') }}" class="nav-link {{ Request::segment(2) == 'user' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>