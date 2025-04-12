@extends('customer.layouts.master')
@section('content')
    <form action="{{ route('checkout.index') }}" method="post" id="formCartCheckout">
        @csrf
        <input type="hidden" name="selected_products" id="selected-products">

    </form>
    <div class="container mt-5">
        <a href="{{ route('dashboard') }}">
            <button style="height: 2.5rem;" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>

                Tiếp tục xem sản phẩm
            </button>
        </a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">SẢN PHẨM</th>
                    <th scope="col">GIÁ</th>
                    <th scope="col">SỐ LƯỢNG</th>
                    <th scope="col">TỔNG</th>
                    <th scope="col">XÓA</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $item)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="product" class="product-checkbox" id="customCheck1"
                                        value="{{ $item->product_id }}" data-name="{{ $item->product->name }}"
                                        data-image="{{ asset($item->product->image) }}" data-price="{{ $item->price }}"
                                        data-quantity="{{ $item->quantity }}">
                                </div>
                                <img class="ms-1" style="width: 5rem; height: 5rem;"
                                    src="{{ asset($item->product->image) }}" alt="">
                                <span class="ms-1">
                                    {{ $item->product->name }}
                                </span>
                            </div>
                        </th>
                        <td style="text-align: center; vertical-align: middle;">
                            <div class="d-flex align-items-center">
                                {{ $item->price }}đ
                            </div>
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <div class="d-flex align-items-center">
                                <button onclick="removeProductToCart({{ $item->product_id }})"
                                    class="btn btn-primary">-</button>
                                <span class="ms-1 me-1">{{ $item->quantity }}</span>
                                <button onclick="addProductToCart({{ $item->product_id }})"
                                    class="btn btn-primary">+</button>
                            </div>
                        </td>
                        <td style="text-align: center; vertical-align: middle; ">
                            <div class="d-flex align-items-center">
                                {{ $item->price * $item->quantity }}đ
                            </div>
                        </td>
                        <td style="text-align: center; vertical-align: middle; ">
                            <div class="d-flex">
                                <div class="image" onclick="deleteProductToCart({{ $item->id }})">
                                    <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="icon icon-tabler icons-tabler-filled icon-tabler-square-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M19 2h-14a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3zm-9.387 6.21l.094 .083l2.293 2.292l2.293 -2.292a1 1 0 0 1 1.497 1.32l-.083 .094l-2.292 2.293l2.292 2.293a1 1 0 0 1 -1.32 1.497l-.094 -.083l-2.293 -2.292l-2.293 2.292a1 1 0 0 1 -1.497 -1.32l.083 -.094l2.292 -2.293l-2.292 -2.293a1 1 0 0 1 1.32 -1.497z" />
                                    </svg>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <h1>EMPTY CART</h1>
                @endforelse

            </tbody>
        </table>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <div>
                <h5>Tổng: <span id="total"></span>đ</h5>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-primary" onclick="buy()">
                THANH TOÁN
            </button>
        </div>
    </div>

    <script>
        let totalCost = 0
        document.getElementById('total').innerHTML = `<strong>${totalCost}</strong>`;
        const checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach(cb => {
            cb.addEventListener("change", function() {
                if (this.checked) {
                    totalCost += this.getAttribute('data-price') * this.getAttribute('data-quantity')
                } else {
                    totalCost -= this.getAttribute('data-price') * this.getAttribute('data-quantity')
                }
                document.getElementById('total').innerHTML = `<strong>${totalCost}</strong>`;
            });
        })


        function buy() {
            let products = [];
            let selectedProducts = document.querySelectorAll(".product-checkbox:checked");
            selectedProducts.forEach((checkbox) => {
                products.push({
                    productId: checkbox.value,
                    name: checkbox.getAttribute('data-name'),
                    image: checkbox.getAttribute('data-image'),
                    price: checkbox.getAttribute('data-price'),
                    quantity: checkbox.getAttribute('data-quantity')
                });
            });



            if (selectedProducts.length === 0) {
                alert("Vui lòng chọn ít nhất một sản phẩm!");
                return;
            }
            document.getElementById('selected-products').value = JSON.stringify(products);
            document.getElementById('formCartCheckout').submit()

        }

        function addProductToCart(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const baseUrl = window.location.origin;
            const url = baseUrl + "/shop/public/dashboard/cart"
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('productId', productId);
            formData.append('quantity', 1);
            formData.append('operator', 1);

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                })
                .then(data => console.log(data))
                .catch(error => console.error(error));
        }

        function removeProductToCart(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const baseUrl = window.location.origin;
            const url = baseUrl + "/shop/public/dashboard/cart"
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('productId', productId);
            formData.append('quantity', 1);
            formData.append('operator', 2);

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                })
                .then(data => console.log(data))
                .catch(error => console.error(error));
        }

        function deleteProductToCart(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const baseUrl = window.location.origin;
            const url = baseUrl + `/shop/public/dashboard/cart/delete/${productId}`
            const formData = new FormData();
            formData.append('_token', csrfToken);

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                })
                .then(data => console.log(data))
                .catch(error => console.error(error));
        }
    </script>
@endsection
