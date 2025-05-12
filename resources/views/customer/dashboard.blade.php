@extends('customer.layouts.master')
@section('content')
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background-color: #f2f4f5;
        }


        .image-card {
            height: 19rem;
            width: 100%;
            object-fit: fill;
        }

        @media (min-width: 768px) {
            .card {
                width: 100%;
                height: 27rem;
            }
        }

        @media (max-width: 767.98px) {
            .row-all {
                justify-content: center;
                content-align: center;
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin: 0 auto;
                padding: 0 1rem;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            .card {
                width: 80%;
                height: 25rem;
            }
        }
    </style>
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="container animate-slide-up">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://gaubongonline.vn/wp-content/uploads/2025/04/Bemori-online_Web-2.webp"
                        class="d-block w-100" alt="..." style="height: 500px; object-fit: cover">
                </div>
                <div class="carousel-item">
                    <img src="https://gaubongonline.vn/wp-content/uploads/2024/12/Banner-trang-chu_Bemori-online_B2.webp"
                        class="d-block w-100 c-img" alt="..." style="height: 500px; object-fit: cover">
                </div>
                <div class="carousel-item">
                    <img src="https://gaubongonline.vn/wp-content/uploads/2024/12/Banner-trang-chu_Bemori-online_B3.webp"
                        class="d-block w-100 c-img" alt="..." style="height: 500px; object-fit: cover">
                </div>
            </div>
            <button class="carousel-control-prev ms-5" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next me-5" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
    <div class="container mt-2 animate-slide-up">
        <h3 class="text-center title">DuDuStore - Shop gấu bông đẹp và cao cấp</h3>
        <form action="{{ route('search') }}" method="GET" class="">
            <div class="d-flex align-items-center justify-content-center">
                <input class="form-control mt-3" type="search" name="search" placeholder="Tìm kiếm theo tên sản phẩm"
                    aria-label="Search" style="width: 30%" value="{{ request('search') }}">
                <button class="btn btn-primary ms-2 mt-3" type="submit">Tìm kiếm</button>
            </div>
            <div class="d-flex">
                <select class="form-select me-auto mt-3" name="category" id="exampleSelect">
                    <option value="">DANH MỤC SẢN PHẨM</option>
                    @forelse ($categories as $category)
                        <option @selected(request('category') == $category->id) value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @empty
                        <option value="">Không có danh mục hiển thị</option>
                    @endforelse
                </select>
                <select class="form-select ms-auto mt-3" name="order" id="exampleSelect" onchange="this.form.submit()">
                    <option @selected(request('order') == 'asc') value="asc">Lọc theo giá: thấp tới cao</option>
                    <option @selected(request('order') == 'desc') value="desc">Lọc theo giá: cao tới thấp</option>
                </select>
            </div>

        </form>

        {{-- <div class="product-grid" id="productGrid">
            @forelse ($products as $product)
                <a href="{{ route('productDetail', ['id' => $product->id]) }}" class="product-link">
                    <div class="product-item">
                        <img src="{{ asset($product->image) }}" alt="">
                        <p class="card-title">{{ $product->name }}</p>
                        <span>{{ $product->price }}đ</span>
                        <button>Buy</button>
                    </div>
                </a>
            @empty
                <h5>Not Product</h5>
            @endforelse

        </div> --}}

        <div class="row mt-3 align-items-center row-all">
            @forelse ($products as $product)
                <div class="d-flex col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-hover shadow mb-3 me-1">
                        <a href="{{ route('productDetail', ['id' => $product->id]) }}" style="text-decoration: none">
                            <img src="{{ asset($product->image) }}" class="card-img-top image-card d-block mx-auto"
                                alt="...">
                            <div class="card-body mt-2">
                                <h5 class="card-title text-center text-truncate-2 name">{{ $product->name }}</h5>
                                <p class="card-text text-center price">{{ $product->price }}đ</p>
                            </div>
                        </a>
                    </div>
                </div>

            @empty
                <h5>Không có sản phẩm</h5>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $products->appends(['order' => request('order'), 'category' => request('category')])->links() }}
        </div>

    </div>
@endsection
