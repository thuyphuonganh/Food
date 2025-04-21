@extends('customer.layouts.master')
@section('content')
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="container">
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
    <div class="container mt-2">
        <h3 class="text-center title">DuDuStore - Shop gấu bông đẹp và cao cấp</h3>
        <form action="{{ route('search') }}" method="GET" class="">
            <div class="d-flex">
                <input class="form-control mt-3" type="search" name="search" placeholder="Search" aria-label="Search"
                    style="width: 20%" value="{{ request('search') }}">
                <button class="btn btn-primary ms-2 mt-3" type="submit">Search</button>
                <select class="form-select ms-auto mt-3" name="order" id="exampleSelect">
                    <option @selected(request('order') == 'asc') value="asc">Filter by price: Low to high</option>
                    <option @selected(request('order') == 'desc') value="desc">Filter by price: High to low</option>
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

        <div class="row mt-3 align-items-center">
            @forelse ($products as $product)
                <div class="d-flex col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow mb-3 me-1" style="width: 100%; height: 27rem;">
                        <a href="{{ route('productDetail', ['id' => $product->id]) }}" style="text-decoration: none">
                            <img src="{{ asset($product->image) }}" class="card-img-top d-block mx-auto" alt="..."
                                style="height: 20rem; width: 100%">
                            <div class="card-body mt-2">
                                <h5 class="card-title text-center text-truncate-2 name">{{ $product->name }}</h5>
                                <p class="card-text text-center price">{{ $product->price }}đ</p>
                            </div>
                        </a>
                    </div>
                </div>

            @empty
                <h5>Not Product</h5>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>


    </div>
@endsection
