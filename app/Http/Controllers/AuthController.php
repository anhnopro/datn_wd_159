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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8|',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // return response()->json($validator->errors(), 422);
        }

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),  // Mã hóa mật khẩu trước khi lưu
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