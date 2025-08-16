<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Food Ordering</title>
    @vite('resources/css/customer/dashboard.css')
    @vite('resources/js/customer/dashboard.js')
    <style>

    </style>
</head>

<body>
    @include('customer.layouts.header')

    {{-- Flash messages --}}
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('logout') }}" id="myForm">
        @csrf

        <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>

    @yield('content')

    @include('customer.layouts.footer')


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> -->
<!-- Bootstrap JS + Popper -->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Modal xác nhận logout trong header -->
<div class="modal fade" id="logoutModalHeader" tabindex="-1" aria-labelledby="logoutModalLabelHeader" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="logoutModalLabelHeader">Xác nhận đăng xuất</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body text-center">
        Bạn có chắc chắn muốn đăng xuất không?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <form id="logout-form-header" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>

</html>
