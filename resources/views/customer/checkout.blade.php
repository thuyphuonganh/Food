@extends('customer.layouts.master')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Thanh Toán</h1>

        <div class="row">
            <!-- Danh sách sản phẩm -->
            <div class="col-md-6">
                <h3>Giỏ hàng</h3>
                <ul class="list-group mb-3">
                    @foreach ($selectedProducts as $product)
                        <li class="list-group-item d-flex align-items-center mt-1 mb-1">
                            <img style="width: 5rem; height: 5rem;" src="{{ asset($product['image']) }}" alt="Product Image"
                                class="me-3 rounded">
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-0">{{ $product['name'] }}</h4>
                            </div>
                            <div class="text-end">
                                <span class="text-primary fw-bold">₫{{ $product['price'] }}</span><br>
                                <span class="text-black">x{{ $product['quantity'] }}</span>
                            </div>
                        </li>
                    @endforeach

                </ul>
                <h5 class="text-end">Tổng tiền: <strong>{{ $total_amount }} đ</strong></h5>
            </div>

            <!-- Form thông tin khách hàng -->
            <div class="col-md-6">
                <h3>Thông tin khách hàng</h3>
                <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">FullName</label>
                        <input type="text" id="name" class="form-control" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">PhoneNumber</label>
                        <input type="text" id="phone" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Address</label>
                        <input type="text" id="address" class="form-control" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Description</label>
                        <textarea class="form-control" rows="2" name="description"></textarea>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <h4>Phương thức thanh toán</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="momo">
                        <label class="form-check-label">MoMo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" value="cod">
                        <label class="form-check-label">Thanh toán khi nhận hàng</label>
                    </div>
                    <input type="hidden" name="total_amount" value="{{ $total_amount }}">
                    <input type="hidden" name="selected_products", value="{{ json_encode($selectedProducts) }}">

                    <button type="button" class="btn btn-success mt-3 w-100" onclick="confirmPayment()">Xác nhận thanh toán</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function confirmPayment() {
            var name = document.getElementById('name').value;
            var phone = document.getElementById('phone').value;
            var address = document.getElementById('address').value;

            // Kiểm tra tên có trống không
            if (name.trim() === "" || name.length < 3) {
                alert("Vui lòng nhập họ tên.");
                return false; // Ngừng gửi form
            }

            // Kiểm tra số điện thoại (chỉ ví dụ, bạn có thể cần thêm kiểm tra khác)
            var phoneRegex = /^[0-9]{10,11}$/;
            if (!phoneRegex.test(phone)) {
                alert("Số điện thoại không hợp lệ.");
                return false; // Ngừng gửi form
            }

            if (address.trim() === "" || name.length < 3) {
                alert("Vui lòng nhập địa chỉ.");
                return false; // Ngừng gửi form
            }

            // Kiểm tra phương thức thanh toán
            var paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert("Vui lòng chọn phương thức thanh toán.");
                return false; // Ngừng gửi form
            }

            document.getElementById('checkout-form').submit(); // Gửi form nếu tất cả đều hợp lệ
        }

    </script>
@endsection
