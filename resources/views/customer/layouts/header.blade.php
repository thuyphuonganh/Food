<!-- resources/views/layouts/header.blade.php -->
<style>
    header {
        background-color: #f8f9fa;
        padding: 10px 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
         
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
        margin-left:50px;
        
    }
    .logo img {
    height: 50px;      /* kích thước desktop */
    max-width: 150px;
    
}
    
    .icon{margin-left: 25px;}
    .search-bar {
        flex: 1;
        display: flex;
        justify-content: center;
        margin-left: 0 20px;
    }

    .search-bar input[type="text"] {
       width: 300px;
        padding: 6px 10px;
        border: 1px solid #ccc;
        border-radius: 4px 0 0 4px;
        outline: none;
         flex: 1;
   
    }

    .search-bar button {
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-left: none;
        background-color: #fcfdfeff;
        color: white;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
    }
    .search-icon {
        transition: transform 0.3s ease;
    }

    .search-bar button:hover .search-icon {
        transform: scale(1.1) rotate(-5deg);
    }



    .icons {
        display: flex;
        gap: 15px;
        align-items: center;
        margin-right: 60px;
    }
        .icon-box {
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }

        .icon-box:hover {
        transform: scale(1.05);
    }

    .icons a {
        text-decoration: none;
        color: #333;
       
    }

    .icon-box a img {
        transition: transform 0.3s ease;
    }

    .icon-box a:hover img {
        transform: scale(1.2) rotate(-5deg);
    }

    .dropdown {
        position: relative;
        display: inline-block;
        border-radius: 8px; /* Bo góc */
        transition: transform 0.2s ease;
         min-width: 90px;
    }
    .dropdown:hover{transform: scale(1.05);}

    .dropdown-menu {
    
    position: absolute;
    width: max-content;
    min-width: auto;
    box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
    padding: 5px 10px;
    box-sizing: border-box;
    z-index: 1;
    border-radius: 6px;       /* Bo góc nhẹ nhàng */
    border: 1px solid #ccc;   /* Viền mỏng */
    background-color: white;  /* Màu nền */
    
    
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #FFBF69;
        min-width: 160px;
        box-shadow: 0 4px 8px rgba(204, 134, 53, 0.1); 
        z-index: 100;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a,
    .dropdown-content form button {
        padding: 8px 12px;
        display: block;
        font-size: 14px;
        color: #333;
        text-decoration: none;
        white-space: nowrap; /* Không xuống dòng */
    }
    .dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    }
    .dropdown-content a:hover {
            background-color: #f1f1f1;
    }
    .search-bar button img {
        transition: transform 0.3s ease;
    }

    .search-bar button:hover img {
        transform: scale(1.2) rotate(5deg);
    }
    .dropdown > a img {
        transition: transform 0.3s ease;
    }

    .dropdown > a:hover img {
        transform: scale(1.2) rotate(-5deg);
    }
    
@media (max-width: 768px) {
    header {
        padding: 10px;  /* giảm padding cho gọn */
    }
    .logo {
        margin-left: 0 !important;
        
        
    }
    .logo img {
        height: 40px;   /* thu nhỏ logo */
        max-width: 70px;
    }
    .search-bar {
        width: 50px;
        margin-right:10px;
    }
    
}

</style>

<header>
    <!-- LOGO -->
    <a href="{{ route('home') }}" class="logo" ><img src="{{ asset('images/logo2.png') }}" alt="Logo" ></a>

    <!-- THANH TÌM KIẾM -->
    <form class="search-bar" method="GET" action="{{ route('search') }}">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm món ăn...">
    <button type="submit">
        <img src="{{ asset('images/timkiem.png') }}" alt="Tìm kiếm" style="width: 30px; height: 25px;">
    </button>
</form>


    <!-- BIỂU TƯỢNG -->
    <div class="icons">
        <!-- Giỏ hàng -->
<div class="icon-box">
    <a href="{{ route('cart.index') }}" title="Giỏ hàng">
        <img src="{{ asset('images/giohang.png') }}" alt="Giỏ hàng" style="width: 30px; height: 24px;">
    </a>
</div>


       <!-- Đơn mua -->
@auth
    @if(auth()->user()->role == 0)
        <a href="{{ route('orders.index') }}" title="Đơn mua">
            <img src="{{ asset('images/donmua.png') }}" alt="Đơn mua" style="width: 24px; height: 24px;">
        </a>
    @endif
@endauth


    <!-- Người dùng dropdown -->
<div class="dropdown">
    <!-- Nút dropdown với icon -->
    <a href="#" title="Tài khoản" >
        <img src="{{ asset('images/people.png') }}" alt="Thông tin cá nhân" style="width: 24px; height: 24px;">
    </a>

    <div class="dropdown-menu">
                            @if (Route::has('login'))
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Thông tin cá nhân</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Đơn hàng</a>
                                    </li>
                                    <li>
    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModalHeader">
        Đăng xuất
    </a>
</li>

                                @else
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                                    
                                    @if (Route::has('register'))
                                        <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
                                    @endif

                                @endauth
                            @endif
   
    </div>
    </div>
    
</header>
