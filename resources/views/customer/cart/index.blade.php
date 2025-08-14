@extends('customer.layouts.master')
@section('content')
    <form action="{{ route('checkout.index') }}" method="post" id="formCartCheckout">
        @csrf
        <input type="hidden" name="selected_products" id="selected-products">

    </form>
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
        </button></a>
        <table class="table table-hover">
            <thead>
    <tr>
        <th scope="col">SẢN PHẨM</th>
        <th scope="col">GIÁ</th>
        <th scope="col">SỐ LƯỢNG</th>
        <th scope="col">TỔNG</th>
        <th scope="col">XÓA</th>
    </tr>
    <style>
    tr th:nth-child(2),
    tr th:nth-child(3),
    tr th:nth-child(4),
    tr th:nth-child(5) {
        padding-left: 50px;}
</style>
</thead>

            <tbody>
    @forelse ($cartItems as $item)
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="product" class="product-checkbox form-check-input"
                            value="{{ $item->product_id }}"
                            data-name="{{ $item->product->name }}"
                            data-image="{{ asset($item->product->image) }}"
                            data-price="{{ $item->price }}"
                            data-quantity="{{ $item->quantity }}">
                    </div>
                    <img class="ms-1" style="width: 5rem; height: 5rem;"
                        src="{{ asset($item->product->image) }}" alt="">
                    <span class="ms-1">
                        {{ $item->product->name }}
                    </span>
                </div>
            </td>

            <td style="text-align: center; vertical-align: middle;">
                {{ number_format($item->price, 0, ',', '.') }} đ

            </td>

            <td style="text-align: center; vertical-align: middle;">
                <div class="d-flex align-items-center justify-content-center">
                    <!-- GIảm số lượng -->
                    <form method="POST" action="{{ route('cart.update', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="operator" value="2">
                        <button type="submit" >-</button>

                    </form>

                    <span class="mx-2">{{ $item->quantity }}</span>

                    <!-- Tăng số lượng -->
                    <form method="POST" action="{{ route('cart.update', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="operator" value="1">
                        <button type="submit">+</button>
                    </form>


                </div>
            </td>

            <td style="text-align: center; vertical-align: middle;">
                 {{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ

            <td style="text-align: center; vertical-align: middle;">
                <!-- Xóa món -->
                <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        style="
                            background-color: #AE2012; 
                            color: white;
                            border: none;
                            padding: 6px 12px;
                            border-radius: 6px;
                            cursor: pointer;
                            transition: background-color 0.3s ease;
                        "
                        onmouseover="this.style.backgroundColor='#df6b5eff'"
                        onmouseout="this.style.backgroundColor='#e74c3c'"
                    >
                        Xóa
                    </button>
                </form>
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="5">
                <h4 class="text-center text-muted">Giỏ hàng trống!</h4>
            </td>
        </tr>
    @endforelse
</tbody>
        </table>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <div>
                <h5>Tổng: <span id="total"></span></h5>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-warning" onclick="buy()">
                <img src="{{ asset('images/checkout-icon.png') }}" alt="Quay lại" style="
                height: 20px;
                margin-right: 8px;
                transition: transform 0.3s ease;
            "
            onmouseover="this.style.transform='translateX(-3px)';"
            onmouseout="this.style.transform='translateX(0)';">
                THANH TOÁN
            </button>
        </div>
    </div>
    </tbody>
    </div>
    <script>
        let totalCost = 0;

    // Hàm format tiền Việt Nam
    function formatPrice(price) {
        return price.toLocaleString('vi-VN');
    }

    // Lần đầu render
    document.getElementById('total').innerHTML = `<span style="color: #2d2a27ff; font-weight: bolder; font-size: 25px;">
        ${formatPrice(totalCost)} đ
    </span>`;

    // Lấy tất cả checkbox
    const checkboxes = document.querySelectorAll('.product-checkbox');

    checkboxes.forEach(cb => {
        cb.addEventListener("change", function() {
            const price = Number(this.getAttribute('data-price'));
            const qty = Number(this.getAttribute('data-quantity'));

            if (this.checked) {
                totalCost += price * qty;
            } else {
                totalCost -= price * qty;
            }

            // Cập nhật lại hiển thị
            document.getElementById('total').innerHTML = `<span style=" font-weight: bolder; font-size: 25px;">
                ${formatPrice(totalCost)} đ
            </span>`;
        });
    });



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
            const url = baseUrl + "/Shop/public/dashboard/cart"
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
            const url = baseUrl + "/Shop/public/dashboard/cart"
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
            const url = baseUrl + `/Shop/public/dashboard/cart/delete/${productId}`
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
