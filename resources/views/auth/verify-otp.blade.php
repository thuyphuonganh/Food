<x-guest-layout>
    <div class="container mt-5">
        <h3 class="mb-4 text-center">Xác thực OTP</h3>

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
            <button type="submit" class="btn btn-dark w-100">Xác nhận OTP</button>
        </form>
    </div>
</x-guest-layout>
