<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Đăng Ký</title>
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-4/assets/css/login-4.css">
</head>

<body>
    <div class="bg-light d-flex justify-content-center align-items-center min-vh-100">
        <section class="p-3 p-md-4 p-xl-5 w-100" style="max-width: 1000px;">
            <div class="container">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                        <!-- Hình bên trái -->
                        <div class="col-12 col-md-6">
                            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" 
                                 src="{{ asset('images/logo_auth.png') }}" alt="Logo">
                        </div>

                        <!-- Form bên phải -->
                        <div class="col-12 col-md-6">
                            <div class="card-body p-4 p-md-5 p-xl-5">
                                <h3 class="mb-4">Đăng ký tài khoản mới</h3>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3 gy-md-4">
                                        <div class="col-12">
                                            <label for="name" class="form-label">Tên</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn bsb-btn-xl btn-dark">Xác nhận đăng ký</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr class="mt-5 mb-3 border-secondary-subtle">
                                <p class="text-center m-0 text-secondary">
                                    Bạn đã có tài khoản? 
                                    <a href="{{ route('login') }}" class="link-primary text-decoration-none">Đăng nhập</a>
                                </p>
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
