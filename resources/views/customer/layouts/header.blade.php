<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            DuDu Store
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">PRODUCTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" aria-disabled="true">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" tabindex="-1" aria-disabled="true">CONTACT</a>
                </li>
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
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
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Thông tin khách hàng</a></li>
                                    <li><a class="dropdown-item" href="#"
                                            onclick="document.getElementById('myForm').submit()">Đăng xuất</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('admin.login') }}">Sign in for admin</a></li>
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Sign in for customer</a></li>
                                    @if (Route::has('register'))
                                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                                    @endif

                                @endauth
                            @endif

                        </ul>
                    </a>

                </li>
            </ul>
        </div>
    </div>

</nav>
