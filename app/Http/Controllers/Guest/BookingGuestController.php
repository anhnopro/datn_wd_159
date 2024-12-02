<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingGuestController extends Controller
{
    public function booking($id)
    {
        $user_id=Auth::id();
        if(isset($user_id)){
        $article = Article::find($id);
        $idRoom = $article->room->id;
        $room = Room::find($idRoom);
        $images = Gallery::where('room_id', $idRoom)->get();
        return view('pages.guest.booking', compact('article', 'room', 'images'));
        }
        else{
            return view('auths.login');
        }
    }


    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'username' => 'required|string|max:255',
        //     'email' => 'required|email',
        //     'phonenumber' => 'required|numeric',
        //     'view_date' => 'required|date',
        // ], [
        //     // Thông báo lỗi
        //     'username.required' => 'Tên người dùng là bắt buộc.',
        //     'email.required' => 'Email là bắt buộc.',
        //     'email.email' => 'Email không hợp lệ.',
        //     'phonenumber.required' => 'Số điện thoại là bắt buộc.',
        //     'phonenumber.numeric' => 'Số điện thoại phải là số.',
        //     'view_date.required' => 'Ngày xem phòng là bắt buộc.'
        // ]);

        // $data = $request->only([
        //     'username',
        //     'email',
        //     'phonenumber',
        //     'view_date',
        //     'start_date',
        //     'end_date',
        //     'total_price',
        //     'status',
        //     'payment_status',
        //     'note',
        // ]);
        // dd($request->all());
        Booking::create($request->all());

        return redirect()->route('guest.home')->with('success', 'Đã đặt phòng. Chờ xác nhận!.');
    }
}