<footer class="bg-dark text-white pt-4 pb-2 mt-5">
    <div class="container">
        <div class="row">

            <!-- Cột 1: Logo & Slogan -->
            <div class="col-md-4 mb-4">
                <h5 class="text-warning">Food - Fuel your day with flavor</h5>
                <p class="small">Mang đến hương vị tuyệt vời – nhanh chóng và tiện lợi.</p>
            </div>

            <!-- Cột 2: Điều hướng -->
            <div class="col-md-4 mb-4">
                <h6 class="text-uppercase fw-bold">Liên kết nhanh</h6>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white text-decoration-none">Trang chủ</a></li>
                    <li><a href="{{ route('customer.infor') }}" class="text-white text-decoration-none">Giới thiệu</a></li>
                    <li><a href="/contact" class="text-white text-decoration-none">Liên hệ</a></li>
                </ul>
            </div>

            <!-- Cột 3: Liên hệ -->
        <div class="col-md-4 mb-4">
            <h6 class="text-uppercase fw-bold">Địa chỉ liên hệ</h6>
            <p class="small mb-1"><i class="fas fa-map-marker-alt me-2"></i>138z3/20 Nguyễn Văn Cừ nối dài ,Ninh Kiều, TP.Cần Thơ</p>
            <p class="small mb-1"><i class="fas fa-phone me-2"></i>0969 726 955</p>
            <p class="small mb-1"><i class="fas fa-envelope me-2"></i>food@email.com</p>

            <!-- Icon mạng xã hội sd svg-->
            
                <div class="mt-2 d-flex align-items-center">
                <!-- Facebook -->
                <span class="me-3 social-icon text-white" role="img" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07C2 17.03 5.66 21.17 10.48 21.95v-6.92H8.08v-2.96h2.4V9.66c0-2.38 1.42-3.69 3.6-3.69 1.04 0 2.13.18 2.13.18v2.34h-1.2c-1.18 0-1.55.73-1.55 1.48v1.78h2.64l-.42 2.96h-2.22v6.92C18.34 21.17 22 17.03 22 12.07z"/>
                    </svg>
                </span>

                <!-- Zalo -->
                <span class="me-3 social-icon text-white" role="img" aria-label="Zalo">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- bubble -->
                    <path d="M12 2C6.48 2 2 5.92 2 10.37c0 2.34 1.25 4.47 3.36 5.93L5 21l4.73-2.52c.96.18 1.96.28 3.27.28 5.52 0 10-3.92 10-8.37S17.52 2 12 2z" fill="currentColor"/>
                    <!-- chữ Z đơn giản -->
                    <path d="M16.1 7H8.9l6.2 10H9.9" stroke="#fff" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>

                <!-- Instagram -->
                <span class="me-3 social-icon text-white" role="img" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.6"/>
                    <circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.6"/>
                    <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor"/>
                    </svg>
                </span>
                </div>

        </div>

        </div>

        <!-- Copyright -->
        <div class="text-center border-top border-secondary pt-3 mt-3 small">
            &copy; {{ date('Y') }} FoodShop. Đã đăng ký bản quyền.
        </div>
    </div>
</footer>
