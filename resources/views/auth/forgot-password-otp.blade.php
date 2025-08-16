<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-4/assets/css/login-4.css">
</head>

<body>
    <div class="bg-light d-flex justify-content-center align-items-center min-vh-100">
        <section class="p-3 p-md-4 p-xl-5 w-100" style="max-width: 800px;">
            <div class="container">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                        <!-- Hình bên trái -->
                        <div class="col-12 col-md-6">
                            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                src="{{ asset('images/logo_auth.png') }}" alt="Logo">
                        </div>

                        <!-- Form bên phải -->
                        <div class="col-12 col-md-6">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <h3>Quên mật khẩu</h3>
                                        <p class="text-muted">Nhập email của bạn để nhận mã OTP và đặt lại mật khẩu.</p>
                                    </div>
                                </div>

                                <form action="{{ route('password.email.otp') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3 gy-md-4">
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="name@example.com" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn bsb-btn-xl btn-dark">
                                                    Gửi OTP
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Session Status -->
                                        <x-auth-session-status class="mb-4" :status="session('status')" />
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-5 mb-4 border-secondary-subtle">
                                        <div class="d-flex flex-column gap-2">
                                            <a href="{{ route('login') }}" class="link-secondary fw-bold text-decoration-none">Quay lại đăng nhập</a>
                                            <a href="{{ route('register') }}" class="link-secondary fw-light text-decoration-none">Đăng ký tài khoản mới</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
