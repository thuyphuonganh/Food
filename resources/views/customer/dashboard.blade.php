<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/css/tabler.min.css" />
    <title>Hello, world!</title>
    <style>
        .form-select {
            width: 20%;
        }

        /* Products */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;

        }

        .product-item {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            border: 1px solid #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

        }

        .product-link {
            text-decoration: none;
            /* Bỏ gạch chân */
            color: inherit;
            /* Kế thừa màu sắc từ phần tử cha */
        }

        .product-link:hover {
            text-decoration: none;
            /* Tùy chọn: thêm hiệu ứng gạch chân khi hover */
        }

        .product-item img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .text-info {
            flex-grow: 1;
            /* Chiếm không gian còn lại */
            text-align: left
        }

        .product-info p,
        .product-info span {
            margin: 0;
            /* Xóa khoảng cách mặc định */
            text-align: left;
            /* Căn trái nội dung */
            font-weight: bold;
        }

        .product-item button {
            padding: 4px 25px;
            background-color: #87ceeb;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-align: right;
        }

        .text-info button {
            margin-top: 10px;
            /* Khoảng cách giữa giá và nút "Mua" */
            margin-left: 20px;
            /* Khoảng cách bên trái để tạo không gian giữa giá và nút "Mua" */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                DuDu Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="true"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quản lí sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Đơn hàng</a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor"
                                class="icon icon-tabler icons-tabler-filled icon-tabler-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                <path
                                    d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                            </svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="">
            <form action="{{ route('search') }}" method="GET" class="">
                <div class="d-flex">
                    <input class="form-control ms-3 mt-3" type="search" name="search" placeholder="Search"
                        aria-label="Search" style="width: 20%" value="{{ request('search') }}">
                    <button class="btn btn-outline-success ms-2 mt-3" type="submit">Search</button>
                    <select class="form-select ms-auto mt-3" name="order" id="exampleSelect">
                        <option @selected(request('order') == 'asc') value="asc">Lọc theo giá: từ thấp đến cao</option>
                        <option @selected(request('order') == 'desc') value="desc">Lọc theo giá: từ cao đến thấp</option>
                    </select>
                </div>

            </form>
        </div>

        <div class="product-grid" id="productGrid">
            @forelse ($products as $product)
                <a href="#" class="product-link">
                    <div class="product-item">
                        <img src="{{ asset($product->image) }}" alt="">
                        <p class="card-title">{{ $product->name }}</p>
                        <span>{{ $product->price }}đ</span>
                        <button>Mua</button>
                    </div>
                </a>
            @empty
                <h5>NotP Product</h5>
            @endforelse

        </div>
        <div class="mt-3">
            {{ $products->links() }}
        </div>


    </div>


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


    <script>
        document.getElementById('exampleSelect').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/js/tabler.min.js">
        < /body>

        <
        /html>
