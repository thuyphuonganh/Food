<x-guest-layout>
<div class="bg-light d-flex justify-content-center align-items-center min-vh-100">
    <section class="p-3 p-md-4 p-xl-5 w-100" style="max-width: 450px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 text-center">Đặt lại mật khẩu</h3>
                <p class="text-center text-muted mb-4">Nhập mật khẩu mới để đăng nhập vào tài khoản của bạn.</p>

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

                    <button type="submit" class="btn btn-dark w-100">Đặt lại mật khẩu</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">Quay lại đăng nhập</a>
                </div>
            </div>
        </div>
    </section>
</div>
</x-guest-layout>
