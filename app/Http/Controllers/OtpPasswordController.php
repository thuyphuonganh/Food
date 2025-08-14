<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class OtpPasswordController extends Controller
{
    // 1. Hiển thị form nhập email
    public function showEmailForm()
    {
        return view('auth.forgot-password-otp');
    }

    // 2. Gửi OTP qua email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        // Kiểm tra email tồn tại trong database
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
    }
        $otp = rand(100000, 999999); // Tạo OTP 6 số

        // Lưu vào session
        session([
            'otp' => $otp,
            'otp_email' => $request->email
        ]);

        // Gửi email OTP
        Mail::raw("Mã OTP của bạn là: {$otp}", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Mã OTP đặt lại mật khẩu');
        });

        return redirect()->route('password.verify.otp')->with('status', 'Đã gửi OTP tới email của bạn.');
    }

    // 3. Form nhập OTP
    public function showVerifyForm()
    {
        return view('auth.verify-otp');
    }

    // 4. Xử lý OTP
    public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|numeric'
    ]);

    if ($request->otp == session('otp')) {
        // Đánh dấu OTP đã xác thực
        session(['otp_verified' => true]);

        return redirect()->route('password.reset.otp');
    }

    return back()->withErrors(['otp' => 'Mã OTP không đúng']);
}


    // 5. Form đổi mật khẩu
    public function showResetForm(Request $request)
{
    // Nếu chưa xác thực OTP thì chặn
    if (!session('otp_verified') || !session('otp_email')) {
        return redirect()->route('password.request.otp')
                         ->with('error', 'Vui lòng xác thực OTP trước.');
    }

    $email = session('otp_email');

    return view('auth.reset-password-otp', compact('email'));
}


    // 6. Lưu mật khẩu mới
    public function resetPassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed'
    ]);

    $user = User::where('email', session('otp_email'))->first();
    $user->password = Hash::make($request->password);
    $user->save();

    // Xóa OTP + trạng thái xác thực
    session()->forget(['otp', 'otp_email', 'otp_verified']);

    return redirect()->route('login')->with('status', 'Đặt lại mật khẩu thành công!');
}

}
