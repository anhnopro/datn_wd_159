<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Mail\BookingCancelMail;
use App\Mail\BookingConfirmationMail;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        return view('landlord_admin.pages.booking.index', compact('bookings'));
    }

    public function detail($id) {
        $booking = Booking::find($id);
        $room = Room::find($booking->room_id);
       
        return view('landlord_admin.pages.booking.detail', compact('booking', 'room'));
    }

    public function confirmed(Request $request, $id)
    {
        $booking = Booking::find($id);
        $room = Room::find($booking->room_id);
        // dd($booking);
        if ($booking->status === 'confirmed') {
            return back()->with('error', 'Đơn đặt phòng đã được xác nhận');
        }
        if ($room->status == false) {
            return back()->with('error', 'Phòng đã được đặt');
        }

        $booking->update([
            'status' => 'confirmed',
            'updated_at' => now(),
        ]);

        $room->update([
            'status' => false,
        ]);

        // Gửi email thông báo cho người đặt
        Mail::to($booking->email)->send(new BookingConfirmationMail($booking));
        return redirect()->route('landlord_admin.booking.list')->with('success', 'Đã xác nhận yêu cầu đặt phòng.');
    }

    public function formCancel($id)
    {
        $booking = Booking::find($id);
        return view('landlord_admin.pages.booking.cancel', compact('booking'));
    }

    public function cancelled(Request $request, $id) {
        $booking = Booking::find($id);
        $room = Room::find($booking->room_id);
        if ($booking->status === 'cancelled') {
            return redirect()->route('landlord_admin.booking.list')->with('error', 'Lỗi');
        }
        $booking->update([
            'status' => 'cancelled',
            'cancel_reason' => $request->cancel_reason,
            'updated_at' => now(),
        ]);

        $room->update([
            'status' => true,
        ]);


        Mail::to($booking->email)->send(new BookingCancelMail($booking));
        return redirect()->route('landlord_admin.booking.list')->with('success', 'Đã hủy yêu cầu đặt phòng.');

    }
}
