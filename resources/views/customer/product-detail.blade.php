@extends('customer.layouts.master')
@section('content')
    <div class="container animate-slide-up">
<div style="margin-top: 2rem;">
    <a href="{{ route('dashboard') }}" style="text-decoration: none;">
        <button style="
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

        <div class="d-flex">
            <div class="card col-xl-7 col-lg-7 me-3 d-flex justify-content-center align-items-center" style="height: 400px; border: none;">
                <img src="{{ asset($product->image) }}" alt="" style="height: 300px; object-fit: contain;">
            </div>

            <div class="col-xl-5 col-lg-5" style="padding-left: 20px;">
                <p style="color: #0A9396; font-weight: bolder; font-size: 40px;">{{ $product->name }}</p>
                <p style="color: #CA6702; font-weight: bolder; font-size: 25px;">Giá: {{ number_format($product->price, 0, ',', '.') }} đ</p>

                <p class="description-product mt-1">
                    <strong>Tình trạng: </strong>
                    @if($product->status == 'in-stock')
                        Còn món
                    @elseif($product->status == 'out-stock')
                        Hết món
                    @else
                        {{ $product->status }}
                    @endif
                </p>

                <p class="description-product mt-1"><strong>Danh mục: </strong>{{ $product->category->name }}</p>
                <p class="description-product mt-2"><strong>Thông tin món ăn: </strong>{{ $product->description }}</p>

                <div class="d-flex justify-content-center mt-4">
    {{-- Nút thêm vào giỏ --}}
    <button type="submit" form="formAddToCart" class="btn btn-outline-warning me-2" style="width: 15%">
        <div class="d-flex align-items-center justify-content-center">
            <img src="{{ asset('images/carticon.png') }}" alt="Giỏ hàng" style="width: 40px; height: 40px;">
        </div>
    </button>

    {{-- Nút đặt món ngay --}}
    <form action="{{ route('checkout.index') }}" method="POST" id="formCartCheckout" style="display: inline-block; width: 85%;">
        @csrf
        <input type="hidden" name="selected_products" value='[{
            "productId": "{{ $product->id }}",
            "name": "{{ $product->name }}",
            "price": {{ $product->price }},
            "quantity": 1
        }]'>

        <button type="submit" class="btn btn-warning w-100 me-2" style=" height: 60px;">
            <div class="d-flex align-items-center justify-content-center">
                <span class="ms-2" style="font-weight: bold">ĐẶT MÓN NGAY</span>
            </div>
        </button>
    </form>
</div>

            </div>
        </div>

        <div style="margin-bottom: 250px;"></div> <!-- tạo khoảng cách với footer -->
    </div>
@endsection
