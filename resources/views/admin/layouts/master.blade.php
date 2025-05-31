<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Hello, world!</title>
    <style>
        li {
            list-style: none;
        }

        a {
            text-decoration: none;
        }

        .main {
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        #sidebar {
            max-width: 264px;
            min-width: 264px;
            transition: all 0.35s ease-in-out;
            background-color: #080d1a;
            display: flex;
            flex-direction: column;
        }

        #sidebar.collapsed {
            margin-left: -264px;
        }

        .toggler-btn svg {
            font-size: 1.5rem;
            color: black;
            font-weight: bold;
        }

        .navbar {
            padding: 0.75rem 1.5rem;
        }

        .sidebar-nav {
            flex: 1 1 auto;
        }

        .sidebar-logo {
            padding: 1.15rem 1.5rem;
            text-align: center;
        }

        .sidebar-logo a {
            color: white;
            font-weight: 400;
            font-size: 1.25rem;
        }

        .sidebar-header {
            color: #FFF;
            font-size: 0.75rem;
            padding: 1.5rem 1.5rem 0.375rem;
        }

        a.sidebar-link {
            padding: 0.625rem 1.625rem;
            color: #FFF;
            position: relative;
            transition: all 0.35s;
            display: block;
        }
    </style>
</head>

<body>

    <div class="d-flex" style="background-color: #F8F9FC">
        {{-- Sidebar --}}
        <aside id="sidebar">
            <div class="sidebar-logo">
                <a href="">COMPOSE ADMIN</a>
                <hr class="bg-white">
            </div>
            {{-- SidebarNavigation --}}
            <ul class="sidebar-nav">
                {{-- <li class="sidebar-header">
                    Tools and Component
                </li> --}}
                <li class="sidebar-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-home-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M10 12h4v4h-4z" />
                        </svg>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.category.index') }}" class="sidebar-link">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-category">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4h6v6h-6z" />
                            <path d="M14 4h6v6h-6z" />
                            <path d="M4 14h6v6h-6z" />
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        </svg>
                        <span>Danh mục</span>
                    </a>
                </li>
                {{-- <li class="sidebar-header">
                    Pages
                </li> --}}
                {{-- <li class="sidebar-item">
                    <a href="{{ route('admin.product.index') }}" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="true" aria-controls="auth">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-producthunt">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 16v-8h2.5a2.5 2.5 0 1 1 0 5h-2.5" />
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        </svg>
                        <span>Sản phẩm</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse">
                        <li class="sidebar-item ms-3">
                            <a href="{{ route('admin.product.index') }}" class="sidebar-link">Xem sản phẩm</a>
                        </li>
                        <li class="sidebar-item ms-3">
                            <a href="{{ route('admin.product.create') }}" class="sidebar-link">Thêm sản phẩm</a>
                        </li>
                        <li class="sidebar-item ms-3">
                            <a href="{{ route('admin.product.edit') }}" class="sidebar-link">Sửa sản phẩm</a>
                        </li>
                    </ul>
                </li> --}}
                <li class="sidebar-item">
                    <a href="{{ route('admin.product.index') }}" class="sidebar-link">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-producthunt">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 16v-8h2.5a2.5 2.5 0 1 1 0 5h-2.5" />
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        </svg>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.order.index') }}" class="sidebar-link">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-truck-delivery">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5" />
                            <path d="M3 9l4 0" />
                        </svg>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="sidebar-item">

                    <form id="logout-form" method="POST" action="{{ route('admin.logout') }}">
                        @csrf

                    </form>
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                            <path d="M15 12h-12l3 -3" />
                            <path d="M6 15l-3 -3" />
                        </svg>
                        <span>Đăng xuất</span>
                    </a>

                </li>
            </ul>
            <div class="sidebar-footer">
                {{-- <a href="" class="sidebar-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <span>Exit</span>
                </a> --}}
            </div>
        </aside>
        {{-- Sidebar end --}}
        {{-- Main component --}}
        <div class="main">
            <nav class="navbar navbar-expand-lg" style="background-color: #FFFFFF">
                <button class="toggler-btn" type="button" style="background-color: #ffffff">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-deep">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 6h16" />
                        <path d="M7 12h13" />
                        <path d="M10 18h10" />
                    </svg>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-deep">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 6h16" />
                        <path d="M7 12h13" />
                        <path d="M10 18h10" />
                    </svg>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            @yield('search')
                        </li>
                    </ul>
                    <div class="d-flex">
                        <img class="rounded-circle" src="{{ asset('images/admin.jpg') }}" alt=""
                            style="width: 25px; height: 25px;">
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </div>


            </nav>
            <main class="p-1">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const toggler = document.querySelector(".toggler-btn")
        toggler.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed")
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
