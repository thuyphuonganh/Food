<x-guest-layout>
<div class="bg-light d-flex justify-content-center align-items-center min-vh-100">
    <section class="p-3 p-md-4 p-xl-5 w-100" style="max-width: 800px;">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="row g-0">
                <!-- Hình bên trái -->
                <div class="col-12 col-md-6">
                    <img class="img-fluid w-100 h-100 object-fit-cover"
                         src="{{ asset('images/logo_auth.png') }}"
                         alt="Logo">
                </div>

                <!-- Form bên phải -->
                <div class="col-12 col-md-6">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 text-center fw-bold">Quên mật khẩu</h3>
                        <p class="text-center text-muted mb-4">Nhập email của bạn để nhận mã OTP và đặt lại mật khẩu.</p>

                        <form action="{{ route('password.email.otp') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg rounded-3"
                                       placeholder="Nhập email" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3">
                                    Gửi OTP
                                </button>
                            </div>

                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-semibold">Quay lại đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</x-guest-layout>
