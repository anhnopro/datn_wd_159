<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function sendConfirmationCode(Request $request)
    {
        if($request->email != Auth::user()->email) {
            return back()->with('success', 'Email không đúng!');
        }

        $user = User::where('email', $request->email)->first();

        // dd($request->email);
        if ($user) {
            // Tạo mã xác nhận ngẫu nhiên
            $confirmationCode = Str::random(6);
            $user->password_reset_token = $confirmationCode;
            $user->save();

            // Gửi mã xác nhận qua email
            Mail::to($user->email)->send(new PasswordResetCode($confirmationCode));

            // Trả về thông báo thành công
            return back()->with('success', 'Mã xác nhận đã được gửi đến email của bạn.');
        } else {
            // Nếu không tìm thấy người dùng, trả về thông báo lỗi
            return back()->with(['error' => 'Không tìm thấy người dùng với email này.']);
        }
    }

    public function confirmPasswordChange(Request $request)
    {
        $request->validate([
            'confirmation_code' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Kiểm tra mã xác nhận
        if ($user->password_reset_token !== $request->confirmation_code) {
            return back()->with(['error' => 'Mã xác nhận không hợp lệ.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->password_reset_token = null;  // Xóa mã xác nhận sau khi đổi mật khẩu
        $user->save();

        return back()->with('success', 'Mật khẩu đã được thay đổi thành công!');
    }
}
