@extends('customer.layouts.master')
@section('content')
<style>
    @media (max-width: 768px) {
    .btn-back {
        margin-bottom: 1rem; /* tạo khoảng cách với hình */
        margin-top: -10px;   /* đẩy nút lên 1 chút */
    }
}

</style>


    <div class="container animate-slide-up">
<div style="margin-top: 2rem;">
    <a href="{{ route('dashboard') }}" style="text-decoration: none;">
        <button class="btn-back" style="
            height: 2.5rem;
            display: flex;
            align-items: center;
            background-color: #005F73;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0 1rem;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.backgroundColor='#02bbbbff'; this.style.transform='scale(1.05)';"
        onmouseout="this.style.backgroundColor='#005F73'; this.style.transform='scale(1)';">
            <img src="{{ asset('images/arrow-left-icon.png') }}" alt="Quay lại" style="
                height: 20px;
                margin-right: 8px;
                transition: transform 0.3s ease;
            "
            onmouseover="this.style.transform='translateX(-3px)';"
            onmouseout="this.style.transform='translateX(0)';">
            Tiếp tục xem món ăn
        </button>
    </a>
</div>


        </a>
        {{-- FORM ĐẶT MÓN NGAY --}}
        <form action="{{ route('checkout.index') }}" method="POST" id="formCartCheckout">
            @csrf
            <input type="hidden" name="productId" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
        </form>

        {{-- FORM THÊM VÀO GIỎ HÀNG --}}
        <form action="{{ url('dashboard/cart') }}" method="POST" id="formAddToCart">
            @csrf
            <input type="hidden" name="productId" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="operator" value="1">
        </form>

        <div class="row">
    <!-- Ảnh sản phẩm -->
    <div class="col-12 col-lg-7 mb-3 d-flex justify-content-center align-items-center">
        <div class="card border-0 w-100 text-center">
            <img src="{{ asset($product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="img-fluid" 
                 style="max-height: 400px; object-fit: contain;">
        </div>
    </div>

    <!-- Thông tin sản phẩm -->
    <div class="col-12 col-lg-5">
        <p class="text-primary fw-bold fs-1">{{ $product->name }}</p>
        <p class="text-warning fw-bold fs-3">Giá: {{ number_format($product->price, 0, ',', '.') }} đ</p>

        <p><strong>Tình trạng: </strong>
            @if($product->status == 'in-stock')
                <span class="text-success">Còn món</span>
            @elseif($product->status == 'out-stock')
                <span class="text-danger">Hết món</span>
            @else
                {{ $product->status }}
            @endif
        </p>

        <p><strong>Danh mục: </strong>{{ $product->category->name }}</p>
        <p><strong>Thông tin món ăn: </strong>{{ $product->description }}</p>

        <!-- Nút hành động -->
        <div class="d-flex flex-wrap mt-4">
            @if($product->status == 'in-stock')
                {{-- Nút giỏ hàng --}}
                <button type="submit" form="formAddToCart" 
                        class="btn btn-outline-warning me-2 mb-2 d-flex align-items-center justify-content-center" 
                        style="width: 60px; height: 60px;">
                    <img src="{{ asset('images/carticon.png') }}" alt="Giỏ hàng" class="img-fluid" style="max-width: 35px;">
                </button>

                {{-- Nút đặt món ngay --}}
                <form action="{{ route('checkout.index') }}" method="POST" id="formCartCheckout" class="flex-grow-1 mb-2">
                    @csrf
                    <input type="hidden" name="selected_products" value='[{
                        "productId": "{{ $product->id }}",
                        "name": "{{ $product->name }}",
                        "price": {{ $product->price }},
                        "quantity": 1
                    }]'>
                    <button type="submit" class="btn btn-warning w-100 h-100 fw-bold" style="height: 60px;">
                        ĐẶT MÓN NGAY
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>


        <div style="margin-bottom: 250px;"></div> <!-- tạo khoảng cách với footer -->
    </div>
@endsection
