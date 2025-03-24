@extends('customer.layouts.master')
@section('content')
    <div class="container">
        @forelse ($cartItems as $item)

            {{-- Add 1 quantity item to cart --}}
            <form action="{{ route('cart.store') }}" method="POST" id="formCart{{ $item->product_id }}">
                @csrf
                <input type="hidden" name="productId" value="{{ $item->product_id }}">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="operator" value="1"> {{-- 1:Add  2:Remove --}}
            </form>

            {{-- Remove 1 quantity item from cart --}}
            <form action="{{ route('cart.store') }}" method="POST" id="formCartRemove{{ $item->product_id }}">
                @csrf
                <input type="hidden" name="productId" value="{{ $item->product_id }}">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="operator" value="2"> {{-- 1:Add  2:Remove --}}
            </form>

            {{-- Remove 1 item from cart --}}
            <form action="{{ route('cart.delete', ['id' =>  $item->id]) }}" method="POST" id="formCartDeleteItem{{ $item->id }}">
                @csrf
            </form>


            <div class="row align-items-center justify-content-center content-item mt-5">
                <div class="col-xl-2 col-lg-2 col-md-6">
                    <label class="custom-checkbox ms-3 mt-3 mb-3">
                        <input type="checkbox" name="product" class="product-checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6">
                    <img class="content--item-img" src="{{ asset($item->product->image) }}" alt="">
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="content-item-description">
                        <span class="item-name">{{ $item->product->name }}</span>
                        <div class="content-item-description-info">
                            <span class="item-gia">{{ $item->price * $item->quantity }}đ</span>
                            <div class="item-soluong">
                                <button onclick="document.getElementById('formCartRemove{{ $item->product_id }}').submit()" class="item-operator">-</button>
                                <span id="quantity">{{ $item->quantity }}</span>
                                <button onclick="document.getElementById('formCart{{ $item->product_id }}').submit()" class="item-operator" id="add">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12">
                    <button onclick="document.getElementById('formCartDeleteItem{{ $item->id }}').submit()" class="item-delete ms-3 mb-3 mt-3">
                        <img class="item-delete-img" src="{{ asset('images/x.jpg') }}" alt="">
                    </button>
                </div>
            </div>
        @empty
            <div class="row align-items-center justify-content-center">
                <span class="empty-cart
                ">Giỏ hàng trống</span>
            </div>
        @endforelse


        <div class="row mt-5">
            <span class="tongtien-info">Tổng tiền: {{ $totalCost }}đ</span>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 mt-5">
                <div class="d-flex">
                    <button onclick="" class="item-delete">
                        <img class="item-delete-img" src="{{ asset('images/x.jpg') }}" alt="">
                    </button>
                    <span class="item-delete-name">Xóa đã chọn</span>
                </div>

            </div>

            <div class="col-lg-6 mt-5 mb-5">
                <button type="submit" class="btn btn-primary btn-muahang" onclick="">MUA HÀNG</button>
            </div>

        </div>

    </div>
@endsection
