{{-- <x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You'!") }}
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout> --}}

<!DOCTYPE html>
<html>
<head>
  <base href="/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('ad_assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('ad_assets/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('ad_assets/dist/css/skins/_all-skins.min.css') }}">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ asset('ad_assets/index2.html') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu"> <!--D:\xampp\htdocs\Doan2\Shop\public\images -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('ad_assets/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('ad_assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-circle text-success"></i> Logout
          </a>
          <form method="POST" action="{{ route('admin.logout') }}">
              @csrf

              <x-dropdown-link :href="route('admin.logout')"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">
                {{ __('Log Out') }}
              </x-dropdown-link>
          </form>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
            <a href="#">
              <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
          </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Categories</span> <i class="fa fa-angle-left
            pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Product</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.product.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('admin.product.create') }}"><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Orders</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ asset('ad_assets/index.html') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ asset('ad_assets/index2.html') }}"><i class="fa fa-circle-o"></i> Status update</a></li>
          </ul>
        </li>



      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          @yield('main')
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>
<script src="{{ asset('ad_assets/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
<script src="{{ asset('ad_assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ad_assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('ad_assets/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('ad_assets/dist/js/app.min.js') }}"></script>
<script src="{{ asset('ad_assets/dist/js/demo.js') }}"></script>
</body>
</html>
