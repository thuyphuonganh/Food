<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
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
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                            <h3>Đăng ký</h3>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3 gy-md-4 overflow-hidden">
                                        <div class="col-12">
                                            <label for="text" class="form-label">Tên</label>
                                            <input type="text" class="form-control" name="name" :value="old('name')"
                                                >
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" :value="old('email') id="email"
                                                >
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            <input type="password" class="form-control" name="password" id="password" >
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" name="password_confirmation" >
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn bsb-btn-xl btn-dark" type="submit">Xác nhận đăng ký</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-5 mb-4 border-secondary-subtle">
                                        <p class="m-0 text-secondary text-center">Bạn đã có tài khoản? <a href="{{ route('login') }}" class="link-primary text-decoration-none">Đăng nhập</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>

