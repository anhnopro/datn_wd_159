<?php

namespace App\Http\Controllers\invoice;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail; // Import Mail facade
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Room;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('status', 'confirmed')->orderBy('created_at', 'desc')->get();;

        return view('landlord_admin.invoice.index', compact('bookings'));
    }
    public function indexForm($id)
    {
        $booking = Booking::find($id);
        $room = Room::find($booking->room_id);
        return view('landlord_admin.invoice.index-form', compact('booking', 'room'));
    }
    public function store(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $room = $booking->room;

        // Tính toán chi phí
        $electricity = $request->input('electricity');
        $water = $request->input('water');
        $electricityPrice = $electricity * $room->electric;
        $waterPrice = $water * $room->water;
        $totalPrice = $room->price + $electricityPrice + $waterPrice;

        $invoice = Invoice::create([
            'booking_id' => $booking->id,
            'room_id' => $room->id,
            'electricity' => $electricity,
            'water' => $water,
            'total_price' => $totalPrice,
            'invoice_status' => 'created'
        ]);
        $booking->invoice_status = 'created';
        $booking->save();
        $invoiceFolder = storage_path('app/public/invoices');
        if (!file_exists($invoiceFolder)) {
            mkdir($invoiceFolder, 0777, true);
        }
        $pdf = FacadePdf::loadView('landlord_admin.invoice.invoice-pdf', [
            'booking' => $booking,
            'room' => $room,
            'electricity' => $electricity,
            'water' => $water,
            'totalPrice' => $totalPrice,
        ]);
        $pdfPath = storage_path('app/public/invoices/invoice-' . $invoice->id . '.pdf');
        $pdf->save($pdfPath);
        Mail::send('landlord_admin.invoice.invoice-email', [
            'booking' => $booking,
            'room' => $room,
            'electricity' => $electricity,
            'water' => $water,
            'totalPrice' => $totalPrice,
        ], function ($message) use ($booking, $pdfPath) {
            $message->to($booking->email)
                ->subject('Hóa đơn tiền trọ')
                ->attach($pdfPath); // Đính kèm file PDF
        });

        // Trả về thông báo thành công
        return redirect()->route('invoice.index')->with('success', 'Hóa đơn đã được tạo và gửi qua email thành công!');
    }
}
