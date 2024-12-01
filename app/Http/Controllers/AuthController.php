<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function showFormRegister()
    {
        return view('auths.register');
    }

    public function handleRegister(Request $request)
{
    $validator = FacadesValidator::make($request->all(), [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'phone' => 'required|regex:/^\+?[0-9]{10,15}$/|unique:users,phone',
        'password' => 'required|string|min:8|confirmed',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'role' => 'required'
    ], [

        'name.required' => 'Tên không được để trống.',
        'name.min' => 'Tên phải có ít nhất 3 ký tự.',
        'email.required' => 'Email không được để trống.',
        'email.unique' => 'Email này đã được sử dụng.',
        'phone.required' => 'Số điện thoại không được để trống.',
        'phone.regex' => 'Số điện thoại không hợp lệ.',
        'password.required' => 'Mật khẩu không được để trống.',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        'role.required' => 'Vai trò không được để trống.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $avatarPath = null;
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    }

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
        'avatar' => $avatarPath,
        'role' => $request->role,
    ]);

    return redirect('/login')->with('success', 'Tạo tài khoản thành công!');
}


    public function showFormLogin()
    {
        return view('auths.login');
    }

    public function handleLogin()
    {
        $credentials = request()->except('_token');

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();


            $role = Auth::user()->role;
            if ($role == 0) {
                return redirect('/admin/dashboard')->with('success', 'Đăng nhập thành công');
            } elseif ($role == 1) {
                return redirect('/landlord_admin/dashboard')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect('/guest/home')->with('success', 'Đăng nhập thành công');
            }
        }


        return back()->withErrors([
            'name' => 'Thông tin không chính xác',
            'password' => 'Thông tin không chính xác',
        ])->onlyInput('name');


    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/admin/welcome')->with('success', 'Đã đăng xuất!');
    }

    public function showProfileAdmin()
    {
        return view('auths.profile-admin');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auths.profile-admin-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Cập nhật thông tin thành công.');
    }
}
