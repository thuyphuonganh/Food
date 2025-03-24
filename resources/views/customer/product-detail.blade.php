@extends('customer.layouts.master')
@section('content')
<div class="container">
    <form action="{{ route('cart.store') }}" method="POST" id="formCart">
        @csrf
        <input type="hidden" name="productId" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="operator" value="1"> {{-- 1:Add  2:Remove --}}
    </form>

    <div class="mt-5 d-flex">
        <div class="col-4 me-3">
            <img src="{{ asset($product->image) }}" class="image-product" alt="">
        </div>

        <div class="col-8 mt-3">
            <h1 class="name-product">{{ $product->name }}</h1>
            <p class="price-product mt-5">{{ $product->price }} đ</p>
            <p class="description-product">
                {{ $product->description }}
            </p>
            <strong>Tình trạng hàng:</strong>
            <p class="description-product mt-1">{{ $product->status }}</p>
            <strong>Phân loại:</strong>
            <p class="description-product mt-1">{{ $product->category->name }}</p>
            <div class="d-flex">
                <button onclick="document.getElementById('formCart').submit()" class="btn btn-primary me-3">THÊM VÀO GIỎ HÀNG</button>
                <button class="btn btn-success">THANH TOÁN</button>
            </div>

        </div>

    </div>

</div>
@endsection
