<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Thêm logo và bo tròn -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="DuDu Store" class="rounded-circle me-2" style="width: 60px; height: 60px; object-fit: cover;"> 
                <span>DuDu Store</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="#">Danh mục sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-uppercase">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    header {
        background-image: url('{{ asset('images/bluebg.png') }}');
        background-size: cover;
        background-position: center;
    }

    /* Tùy chỉnh thêm nếu cần */
    .navbar-brand img {
        border: 2px solid #b3d7ff; /* Thêm viền tròn màu xanh nhạt giống logo */
    }
</style>