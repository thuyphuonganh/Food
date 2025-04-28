<style>
    .image {
        width: 100%;
    }

    .image_small {
        width: 12px;
        height: 12px;
    }

    .payment-icon {
        width: 60px;
        height: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .payment-icon:hover {
        transform: scale(1.1);
    }

    .shipping-icon {
        width: 120px;
        height: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .shipping-icon:hover {
        transform: scale(1.1);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<footer class="text-dark py-4">
    <hr>
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-md-3">
                <i class="fa-solid fa-bag-shopping fa-2x mb-2"></i>
                <h6>Mua sắm thả ga</h6>
            </div>
            <div class="col-md-3">
                <i class="fas fa-shield-alt fa-2x mb-2"></i>
                <h6>Bảo hành uy tín</h6>
            </div>
            <div class="col-md-3">
                <i class="fas fa-shipping-fast fa-2x mb-2"></i>
                <h6>Giao hàng nhanh</h6>
            </div>
            <div class="col-md-3">
                <i class="fas fa-headset fa-2x mb-2"></i>
                <h6>Hỗ trợ 24/7</h6>
            </div>
        </div>

        <div class="row text-center mb-4">
            <div class="col-md-6">
                <h5 class="fw-bold">Hỗ trợ thanh toán</h5>
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
                    <img src="{{ asset('images/visa.png') }}" alt="Visa" class="payment-icon" />
                    <img src="{{ asset('images/Momo.png') }}" alt="Momo" class="payment-icon" />
                    <img src="{{ asset('images/Jcb.png') }}" alt="JCB" class="payment-icon" />
                    <img src="{{ asset('images/samsungpay.png') }}" alt="Samsung Pay" class="payment-icon" />
                    <img src="{{ asset('images/vnpay.png') }}" alt="VNPay" class="payment-icon" />
                    <img src="{{ asset('images/zalopay.png') }}" alt="ZaloPay" class="payment-icon" />
                    <img src="{{ asset('images/applepay.png') }}" alt="Apple Pay" class="payment-icon" />
                </div>
            </div>

            <div class="col-md-6">
                <h5 class="fw-bold">Hình thức vận chuyển</h5>
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-3">
                    <img src="{{ asset('images/Giaohangnhanh.png') }}" alt="Giao Hàng Nhanh" class="shipping-icon" />
                    <img src="{{ asset('images/vietnampost.png') }}" alt="Vietnam Post" class="shipping-icon" />
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <p>
                    <i class="fas fa-map-marker-alt"></i> <strong>Địa chỉ:</strong> 29 Võ Trường Toản, An Hòa, Ninh
                    Kiều, Cần Thơ
                </p>
                <p>
                    <i class="fas fa-phone"></i> <strong>Số ĐT:</strong> 0945.199.786
                </p>
                <p>
                    <i class="fas fa-envelope"></i> <strong>Email:</strong> mobilesales@example.com
                </p>
                <p>
                    <i class="fas fa-copyright"></i> @2025 – Bản quyền thuộc về <strong>Dragon-LH</strong>
                </p>
            </div>
        </div>
    </div>
</footer>
