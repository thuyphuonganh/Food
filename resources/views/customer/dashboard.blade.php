@extends('customer.layouts.master')
@section('content')
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background-color: #f6f9fa;
        }

        @media (max-width: 576.98px) {
            .category {
                display: block;
            }
        }
    </style>
    <div id="hero-carousel" class="carousel slide animate-slide-up" data-bs-ride="carousel">
        <div class="container">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/carousel_1.jpg') }}" class="d-block w-100" alt="..."
                        style="height: 200px; object-fit: cover">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel_2.png') }}" class="d-block w-100 c-img" alt="..."
                        style="height: 200px; object-fit: cover">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel_3.png') }}" class="d-block w-100 c-img" alt="..."
                        style="height: 200px; object-fit: cover">
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

    <div class="container animate-slide-up">
        <div class="row d-flex">
            <div class="col-md-3 col-sm-0 mt-3">
                <div class="card category">
                    <span class="mt-3 ms-2 text-center" style="font-size: 18px; font-weight: bold">Danh mục sản phẩm</span>
                    @forelse ($categories as $category)
                        @if (request('category') == $category->id)
                            <a href="http://localhost/Shop/public/dashboard/search?category=" class="text-center"
                                style="color: #198754;padding: 12px ;text-decoration: none; font-weight: 500; font-size: 16px">
                                {{ $category->name }}
                            </a>
                        @else
                            <a href="http://localhost/Shop/public/dashboard/search?category={{ $category->id }}"
                                class="text-center"
                                style="padding: 12px ;text-decoration: none; color: black; font-weight: 500; font-size: 16px">
                                {{ $category->name }}
                            </a>
                        @endif


                    @empty
                        <p class="text-center">Không có danh mục hiển thị</p>
                    @endforelse
                    <span class="mt-3 ms-2 text-center" style="font-size: 18px; font-weight: bold">Sắp xếp</span>

                    <a href="http://localhost/Shop/public/dashboard/search?category={{ request('category') }}&order=asc"
                        class="text-center"
                        style=" padding: 12px ;text-decoration: none; font-weight: 500; font-size: 16px">
                        @if (request('order') == 'asc')
                            <span style="color: blue;">Sắp xếp theo giá: thấp tới cao</span>
                        @else
                            <span style="color: black;">Sắp xếp theo giá: thấp tới cao</span>
                        @endif

                    </a>

                    <a href="http://localhost/Shop/public/dashboard/search?category={{ request('category') }}&order=desc"
                        class="text-center"
                        style="padding: 12px ;text-decoration: none; color: black; font-weight: 500; font-size: 16px">
                        @if (request('order') == 'desc')
                            <span style="color: blue;">Sắp xếp theo giá: cao tới thấp</span>
                        @else
                            <span style="color: black;">Sắp xếp theo giá: cao tới thấp</span>
                        @endif
                    </a>

                </div>
            </div>
            <div class="col-md-9 col-sm-12 mt-3">
                <div class="row ms-1">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                            <div class="card card-hover shadow mb-3 me-1"
                                style="display: flex; flex-direction: column; height: 100%">
                                <a href="{{ route('productDetail', ['id' => $product->id]) }}" style="text-decoration: none">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img class="mt-3" style="width: 60%;height: 150px; object-fit: contain"
                                            src="{{ asset($product->image) }}" class="card-img-top d-block mx-auto"
                                            alt="...">
                                        <div class="" style="width: 40%; margin-right: 10px">
                                            <p class="card-text text-truncate-2"
                                                style="font-size: 12px; text-align: center; color: darkgray">
                                                Cpu: Apple A15 Bionic</p>
                                            <p class="card-text text-truncate-2"
                                                style="font-size: 12px; text-align: center; color: darkgray">
                                                Ram: 6GB</p>
                                            <p class="card-text text-truncate-2"
                                                style="font-size: 12px; text-align: center; color: darkgray">
                                                Rom: 128GB</p>
                                        </div>
                                    </div>
                                    <div class="card-body mt-2">
                                        <span class="card-title text-truncate-2 name">{{ $product->name }} chính hãng vn/a
                                        </span>
                                        <p class="card-text price">Giá: {{ $product->price }}đ</p>
                                        <p class="text-truncate-2"
                                            style="font-size: 14px ;color: rgb(67, 110, 183); font-weight: 400">Tình trạng
                                            hàng: {{ $product->status }}</p>
                                        <p class="card-text text-truncate-2" style="color: gray; font-size: 14px">
                                            {{ $product->description }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty

                        <div class="col-9">
                            <h5 class="text-center">Không có sản phẩm</h5>
                        </div>
                    @endforelse


                </div>
            </div>

        </div>
        <div class="row mt-3">
            {{ $products->appends(['order' => request('order'), 'category' => request('category')])->links() }}
        </div>
    </div>
    
@endsection
