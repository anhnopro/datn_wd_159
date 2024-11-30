@extends('landlord_admin.master')
@section('title')
    Hủy đơn đặt phòng
@endsection

@section('content')
<div class="table-responsive table-card p-4 shadow-sm rounded">
    <!-- Phần thông tin đặt phòng -->
    <div class="mb-4">
        <h5 class="text-primary mb-3">Thông tin đặt phòng</h5>
        <ul class="list-group">
            <li class="list-group-item">
                <strong>Tên phòng:</strong> {{ $booking->room->name }}
            </li>
            <li class="list-group-item">
                <strong>Tên khách hàng:</strong> {{ $booking->username }}
            </li>
            <li class="list-group-item">
                <strong>Số điện thoại:</strong> {{ $booking->phonenumber }}
            </li>
            <li class="list-group-item">
                <strong>Email:</strong> {{ $booking->email }}
            </li>
            <li class="list-group-item">
                <strong>Thời gian đặt:</strong> {{ $booking->created_at->format('d/m/Y H:i') }}
            </li>
        </ul>
    </div>

    <!-- Phần form nhập lý do hủy -->
    <form action="{{route('landlord_admin.booking.cancelled', $booking->id)}}" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="cancel_reason" class="form-label">Lý do hủy <span class="text-danger">*</span></label>
            <textarea class="form-control" name="cancel_reason" id="cancel_reason" rows="3" placeholder="Nhập lý do hủy"
                required></textarea>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <a class="btn btn-secondary" type="button" onclick="window.history.back()">Quay lại</a>
            <button class="btn btn-danger" type="submit">Xác nhận hủy</button>
        </div>
    </form>
</div>

@endsection
