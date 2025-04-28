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

    <title>Store</title>
    @vite('resources/css/customer/dashboard.css')
    @vite('resources/js/customer/dashboard.js')
    <style>

    </style>
</head>

<body>
    @include('customer.layouts.header')

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>
