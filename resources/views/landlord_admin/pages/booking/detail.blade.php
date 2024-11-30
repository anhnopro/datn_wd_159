@extends('landlord_admin.master')
@section('title')
    Danh sách đặt phòng
@endsection


@section('content')
    <div class="table-responsive table-card p-4 shadow-sm rounded">

        <table class="table table-bordered table-hover table-striped mb-0 align-middle">
            <thead class="table-light">
                <h4>Thông tin khách hàng</h4>
                <tr>
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $booking->username }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->phonenumber }}</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table class="table table-bordered table-hover table-striped mb-0 align-middle">
            <thead class="table-light">
                <h4>Thông tin phòng</h4>
                <tr>
                    <th>Tên phòng</th>
                    <th>Chủ phòng</th>
                    <th>Dịch vụ</th>
                    <th>Giá tiền</th>
                    <th>Địa chỉ</th>
                    <th>Diện tích</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->user->name }}</td>
                    <td>{{ $room->service->service_type }}</td>
                    <td>{{ $room->price }}</td>
                    <td>{{ $room->address }}</td>
                    <td>{{ $room->area }} m&sup2</td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table class="table table-bordered table-hover table-striped mb-0 align-middle">
            <thead class="table-light">
                <h4>Thông tin đặt phòng</h4>
                <tr>
                    <th>Ngày đặt</th>
                    <th>Ghi chú của khách hàng</th>
                    <th>Trạng thái yêu cầu</th>
                    <th>Thời gian xác nhận yêu cầu</th>
                    <th>Lí do hủy</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $booking->created_at }}</td>
                    <td>{{ $booking->note }}</td>
                    <td>
                        @if ($booking->status === 'pending')
                            <span class="badge bg-primary">Đang chờ xác nhận</span>
                        @elseif ($booking->status === 'confirmed')
                            <span class="badge bg-success">Đã xác nhận</span>
                        @elseif ($booking->status === 'cancelled')
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </td>
                    <td>{{ $booking->updated_at }}</td>
                    <td>{{ $booking->cancel_reason }}</td>

                </tr>
            </tbody>

        </table>
        <br><br>
        <div class="float-end">
            <button onclick="window.history.back()" class="btn btn-warning btn-sm">Quay lại</button>
            <a href="{{ route('landlord_admin.booking.formCancel', $booking->id) }}" class="btn btn-danger btn-sm">Từ
                chối</a>
            <form action="{{ route('landlord_admin.booking.confirmed', $booking->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-primary btn-sm"
                    onclick="return confirm('Bạn có chắc chắn muốn xác nhận đặt phòng này?')">Xác nhận</button>
            </form>

        </div>
    </div>
@endsection
