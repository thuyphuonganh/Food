{{-- <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">
        <a class="navbar-brand align-items-center header" href="#">
            AppleStore
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active header" aria-current="page" href="{{ route('home') }}">TRANG CHỦ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active header" aria-current="page" href="{{ route('infor') }}">VỀ CHÚNG TÔI</a>
                </li>
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('cart.index') }}" class="nav-link active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-shopping-cart">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                            <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                        </svg>
                        <ul class="dropdown-menu">
                            @if (Route::has('login'))
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Thông tin khách hàng</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Lịch sử đơn hàng</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"
                                            onclick="document.getElementById('myForm').submit()">Đăng xuất</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('admin.login') }}">Đăng nhập cho quản trị
                                            viên</a></li>
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập cho khách hàng</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
                                    @endif

                                @endauth
                            @endif

                        </ul>
                    </a>

                </li>
            </ul>
        </div>
    </div>

</nav> --}}

<nav class="navbar navbar-expand-xl bg-light">
    <div class="container">
        <a class="navbar-brand header" href="#" style="color: #198754;">
            <img style="color: #198754; width: 40px" src="{{ asset('images/logo_store.png') }}" alt=""
                width="30" height="24" class="d-inline-block align-text-top">
            COMPOSE STORE
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form class="d-flex" action="{{ route('search') }}" method="GET">
                        <input class="form-control me-2 ms-2"
                            style="width: 25rem; font-size: 12px; border-radius: 12px; font-weight: lighter"
                            type="search" placeholder="Hôm nay bạn muốn tìm gì?" aria-label="Search" name="search"
                            value="{{ request()->input('search') }}">
                        <button class="btn btn-outline-success" type="submit"
                            style="border-radius: 24px; font-size: 13px;>
                            <div class="d-flex align-items-center ps-2 pe-2">
                                <svg style="width: 15px; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                                Tìm kiếm
                            </div>
                        </button>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item d-flex align-items-center" style="margin-right: 25px">
                    <svg style="color: #198754; width: 17px" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                    <a style="color: #198754; font-size: 14px;" class="nav-link" aria-current="page" href="#">
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item menu-item d-flex align-items-center" style="margin-right: 25px">
                    <svg style="color: #198754; width: 17px" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <a style="color: #198754; font-size: 14px" class="nav-link" aria-current="page" href="#">
                        Tài khoản
                    </a>
                    <div class="dropdown">
                        @if (Route::has('login'))
                            @auth
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Thông tin khách hàng</a>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">Lịch sử đơn hàng</a>
                                <a class="dropdown-item" href="#" onclick="document.getElementById('myForm').submit()">Đăng xuất</a>
                            @else
                                <a href="{{ route('login') }}" class="dropdown-item">Đăng nhập</a>
                                <a href="{{ route('register') }}" class="dropdown-item">Đăng ký</a>
                            @endauth
                        @endif
                    </div>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <svg style="color: #198754; width: 17px" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />
                    </svg>
                    <a style="color: #198754; font-size: 14px" class="nav-link" aria-current="page" href="{{ route('cart.index') }}">
                        Giỏ hàng
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
