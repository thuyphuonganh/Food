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
        .nav-link {
    transition: all 0.4s ease; /* Mượt khi đổi màu */
}
.nav-link:hover {
    color: var(--bs-info); /* Đổi sang màu primary */
    border-bottom: 5px solid var(--bs-warning); /* Viền dưới */
    transition: 0.3s; /* Mượt */
}
.navbar .nav-link {
    display: flex;
    align-items: center;
    height: 40px; /* Khớp với chiều cao navbar */
}

.navbar .nav-item img {
    margin-right: 6px;
}

.navbar .nav-link:hover {
    background-color: #f8f9fa;
    border-radius: 8px;
}

/* Canh giữa */
    .pagination {
        justify-content: center;
    }

    /* Màu nền nút */
    .pagination .page-item .page-link {
        color: white;               /* Màu chữ */
        background-color: #0A9396;  /* Màu nền */
        border: none;
        transition: 0.3s;
    }

    /* Hover */
    .pagination .page-item .page-link:hover {
        background-color: #005F73;
        transform: translateY(-2px);
    }

    /* Nút đang active */
    .pagination .page-item.active .page-link {
        background-color: #94D2BD; 
        border: none;
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
                    <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100" alt="..."
                        style="height: 200px; object-fit: cover">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100 c-img" alt="..."
                        style="height: 200px; object-fit: cover">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner3.jpg') }}" class="d-block w-100 c-img" alt="..."
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
        <div class="container">
    <nav class="navbar  navbar-expand-sm bg-light d-flex justify-content-between">
        
                {{-- Nhóm bên trái --}}
                <div class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item px-5 mx-2">
                            <a class=" nav-link fst-italic fw-bold active text-dark btn btn-outline " href="{{ route('products.byCategory', ['id' => 1]) }}">Ngon miệng</a>
                        </li>
                        <li class="nav-item px-5 mx-2">
                            <a class="nav-link fst-italic fw-bold active text-dark btn btn-outline " href="{{ route('products.byCategory', ['id' => 3]) }}">Hấp dẫn</a>
                        </li>
                        <li class="nav-item px-5 mx-2">
                            <a class="nav-link fst-italic fw-bold active text-dark btn btn-outline ms-auto " href="{{ route('products.byCategory', ['id' => 2]) }}">Thanh mát</a>
                        </li>
                    </ul>
                </div>

        {{-- Nhóm bên phải --}}
        
            <ul class="navbar-nav mt-n1 py-0 ">
                <li class="nav-item dropdown mx-2 ">
                    <a class="nav-link dropdown-toggle d-flex align-items-center fw-bold text-secondary" 
                    href="#" 
                    id="sortDropdown" 
                    role="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    style="padding: 8px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #fff;">
                        
                        <img src="{{ asset('images/filter-icon.png') }}" alt="Filter Icon" width="20" height="20" class="me-2">
                        Sắp xếp
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['order' => 'price_asc']) }}">
                                Giá tăng dần
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['order' => 'price_desc']) }}">
                                Giá giảm dần
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['order' => 'name_asc']) }}">
                                Tên A-Z
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['order' => 'name_desc']) }}">
                                Tên Z-A
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
</div>




    </nav>
</div>
<div class="container mt-3">
    <div class="row">
        @forelse ($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card card-hover shadow mb-3 me-1 h-100 d-flex flex-column">
                    <a href="{{ route('productDetail', ['id' => $product->id]) }}" style="text-decoration: none; height: 100%; display: flex; flex-direction: column;">
                        <div class="d-flex justify-content-center align-items-center" style="height: 160px; overflow: hidden;">
                            <img style="width: 100%; height: 100%; object-fit: cover;"
                                src="{{ asset($product->image) }}" alt="...">
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between mt-2" style="flex-grow: 1;">
                            <span class="card-title text-truncate-2 name" style="color: #0A9396;font-size: 20px;">{{ $product->name }}</span>
                            <p class="card-text price mt-1" style="color: #CA6702">
                                Giá: {{ number_format($product->price, 0, ',', '.') }}đ
                            </p>
                            <p class="text-truncate-2 mt-1" style="font-size: 14px; color: #94D2BD; font-weight: 400">
                                Tình trạng :
                                @if ($product->status === 'in-stock')
                                    Còn món
                                @elseif ($product->status === 'out-stock')
                                    Hết món
                                @else
                                    {{ $product->status }}
                                @endif
                            </p>
                            <p class="card-text text-truncate-2" style="color: #6b7280; font-size: 14px">{{ $product->description }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h5 class="text-center">Không tìm thấy món ăn</h5>
            </div>
        @endforelse
    </div>

    {{-- Phân trang --}}
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
