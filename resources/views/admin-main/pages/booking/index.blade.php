@extends('admin-main.master')
@section('title')
    Danh sách đặt phòng
@endsection

@section('content')
    <div class="table-responsive table-card">

        <div class="col-xl-12 col-sm-12 col-md-12 mb-2 text-end">
            <a href="{{ route('landlord_admin.article.create') }}" class="btn btn-info">Thêm mới +</a>
        </div>

        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Khách hàng</th>
                    <th>Tên phòng</th>
                    <th>Ngày thuê</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Thời gian đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->room->name }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->payment_status }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td>
                            <form action="">
                                <input type="hidden" name="status" value="confirmed">
                                <button class="btn">Xác nhận</button>
                            </form>
                            <form action="">
                                <input type="hidden" name="status" value="cancelled">
                                <button>Từ chối</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
