@extends('customer.layouts.master')
@section('content')
    <div class="container">
        @forelse ($cart as $cartItem)
            <form action="{{ route('cart.store') }}" method="POST" id="formCart{{ $cartItem['productId'] }}">
                @csrf
                <input type="hidden" name="productId" value="{{ $cartItem['productId'] }}">
                <input type="hidden" name="quantity" value="1">
            </form>
            <form action="{{ route('cart.store') }}" method="POST" id="formCartRemove{{ $cartItem['productId'] }}">
                @csrf
                <input type="hidden" name="productId" value="{{ $cartItem['productId'] }}">
            </form>
            <form action="{{ route('cart.destroy', ['cart' => $cartItem['productId']]) }}" method="POST"
                id="formCartRemoveProduct{{ $cartItem['productId'] }}">
                @csrf
                @method('DELETE')
            </form>
            <div class="row align-items-center justify-content-center content-item mt-5">
                <div class="col-xl-2 col-lg-2 col-md-6">
                    <label class="custom-checkbox ms-3 mt-3 mb-3">
                        <input type="checkbox" name="product{{ $cartItem['productId'] }}" class="product-checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6">
                    <img class="content--item-img" src="{{ asset($cartItem['image']) }}" alt="">
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="content-item-description">
                        <span class="item-name">{{ $cartItem['name'] }}</span>
                        <div class="content-item-description-info">
                            <span class="item-gia">{{ $cartItem['price'] }}đ</span>
                            <div class="item-soluong">
                                <button
                                    onclick="document.getElementById('formCartRemove{{ $cartItem['productId'] }}').submit()"
                                    class="item-operator">-</button>
                                <span id="quantity-${productId}">{{ $cartItem['quantity'] }}</span>
                                <button onclick="document.getElementById('formCart{{ $cartItem['productId'] }}').submit()"
                                    class="item-operator" id="add">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12">
                    <button onclick="document.getElementById('formCartRemoveProduct{{ $cartItem['productId'] }}').submit()"
                        class="item-delete ms-3 mb-3 mt-3">
                        <img class="item-delete-img" src="{{ asset('images/x.jpg') }}" alt="">
                    </button>
                </div>
            </div>
        @empty
            <h2>Empty</h2>
        @endforelse

        <div class="row mt-5">
            <span class="tongtien-info">Tổng tiền: {{ $tongtien }}đ</span>
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
