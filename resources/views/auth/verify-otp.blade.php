<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Xác thực OTP</title>
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
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <h3>Xác thực OTP</h3>
                                        <p class="text-muted">Nhập mã OTP đã gửi vào email của bạn. Lưu ý: OTP chỉ có hiệu lực trong 6 phút.</p>
                                    </div>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-success">{{ session('status') }}</div>
                                @endif

                                <form action="{{ route('password.verify.otp.post') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="otp" class="form-label">Nhập mã OTP</label>
                                        <input type="text" name="otp" id="otp" class="form-control" placeholder="6 chữ số" required>
                                        @error('otp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="d-grid mt-3">
                                        <button type="submit" class="btn bsb-btn-xl btn-dark">Xác nhận OTP</button>
                                    </div>
                                </form>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <hr class="mt-4 mb-3 border-secondary-subtle">
                                        <div class="d-flex flex-column gap-2">
                                            <a href="{{ route('password.request.otp') }}" class="link-secondary fw-light text-decoration-none">Gửi lại OTP</a>
                                            <a href="{{ route('login') }}" class="link-secondary fw-bold text-decoration-none">Quay lại đăng nhập</a>                  
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
