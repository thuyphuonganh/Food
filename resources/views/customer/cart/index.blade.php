@extends('customer.layouts.master')
@section('content')
    <div class="container">
        <form action="{{ route('checkout.index') }}" method="post" id="formCartCheckout">
            @csrf
            <input type="hidden" name="selected_products" id="selected-products">

        </form>
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
            <form action="{{ route('cart.delete', ['id' => $item->id]) }}" method="POST"
                id="formCartDeleteItem{{ $item->id }}">
                @csrf
            </form>

            <div class="row align-items-center justify-content-center content-item mt-5">
                <div class="col-xl-2 col-lg-2 col-md-6">
                    <label class="custom-checkbox ms-3 mt-3 mb-3">
                        <input type="checkbox" name="product" class="product-checkbox" value="{{ $item->product_id }}"
                        data-name="{{ $item->product->name }}"
                        data-image="{{ asset($item->product->image) }}"
                        data-price="{{ $item->price }}"
                        data-quantity="{{ $item->quantity }}"
                        >
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
                                <button onclick="document.getElementById('formCartRemove{{ $item->product_id }}').submit()"
                                    class="item-operator">-</button>
                                <span id="quantity">{{ $item->quantity }}</span>
                                <button onclick="addProductToCart({{ $item->product_id }})" class="item-operator"
                                    id="add">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-12">
                    <button onclick="document.getElementById('formCartDeleteItem{{ $item->id }}').submit()"
                        class="item-delete ms-3 mb-3 mt-3">
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
                <button type="submit" class="btn btn-primary btn-muahang" onclick="buy()">MUA HÀNG</button>
            </div>

        </div>

    </div>
    <script>

        function buy() {
            let products = [];
            let selectedProducts = document.querySelectorAll(".product-checkbox:checked");
            selectedProducts.forEach((checkbox) => {
                products.push(
                    {
                        productId: checkbox.value,
                        name: checkbox.getAttribute('data-name'),
                        image: checkbox.getAttribute('data-image'),
                        price: checkbox.getAttribute('data-price'),
                        quantity: checkbox.getAttribute('data-quantity')
                    }
                );
            });

            if (selectedProducts.length === 0) {
                alert("Vui lòng chọn ít nhất một sản phẩm!");
                return;
            }
            document.getElementById('selected-products').value = JSON.stringify(products);
            document.getElementById('formCartCheckout').submit()

            // fetch('http://localhost/shop/public/dashboard/checkout', {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
            //                 'content') // CSRF Token
            //         },
            //         body: JSON.stringify({
            //             products: products
            //         })
            //     })
            //     .then(response => response.json())
            //     .then(data => {
            //         console.log('Success:', data);
            //         window.location.href = 'http://localhost/shop/public/dashboard/checkout/view/'+data;
            //     })
            //     .catch(error => console.error('Error:', error));

        }

        function addProductToCart(productId) {

            document.getElementById('formCart' + productId).submit();
        }
    </script>
@endsection
