<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Đặt lại mật khẩu</title>
</head>

<body>
    <div class="bg-light d-flex justify-content-center align-items-center min-vh-100">
        <section class="p-3 p-md-4 p-xl-5 w-100" style="max-width: 800px;">
            <div class="container">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                        <!-- Hình bên trái -->
                        <div class="col-12 col-md-6 d-none d-md-block">
                            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                src="{{ asset('images/logo_auth.png') }}" alt="Logo">
                        </div>

                        <!-- Form bên phải -->
                        <div class="col-12 col-md-6">
                            <div class="card-body p-4 p-md-5">
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <h3>Đặt lại mật khẩu</h3>
                                        <p class="text-muted">Nhập mật khẩu mới để đăng nhập vào tài khoản của bạn.</p>
                                    </div>
                                </div>

                                <form action="{{ route('password.update.otp') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $email }}">

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mật khẩu mới</label>
                                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu mới</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" required>
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="d-grid mt-3">
                                        <button type="submit" class="btn bsb-btn-xl btn-dark">Đặt lại mật khẩu</button>
                                    </div>
                                </form>

                                <div class="row mt-4">
                                    <div class="col-12 text-center">
                                        <hr class="mt-4 mb-3 border-secondary-subtle">
                                        <a href="{{ route('login') }}" class="link-secondary fw-bold text-decoration-none">Quay lại đăng nhập</a>
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
