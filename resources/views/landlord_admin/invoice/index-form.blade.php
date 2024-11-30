@extends('landlord_admin.master')
@section('title')
    In hóa đơn
@endsection

@section('content')
<div class="mb-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" id="error-alert" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
    <div class="container p-4 shadow-sm rounded">
        <h2 class="mb-4">Thông tin hóa đơn</h2>

        <!-- Thông tin khách hàng -->
        <h4>Thông tin khách hàng</h4>
        <div class="mb-4">
            <div class="form-group">
                <label for="username">Khách hàng</label>
                <input type="text" id="username" class="form-control" value="{{ $booking->username }}" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" value="{{ $booking->email }}" disabled>
            </div>
            <div class="form-group">
                <label for="phonenumber">Số điện thoại</label>
                <input type="text" id="phonenumber" class="form-control" value="{{ $booking->phonenumber }}" disabled>
            </div>
        </div>

        <!-- Thông tin phòng -->
        <h4>Thông tin phòng</h4>
        <div class="mb-4">
            <div class="form-group">
                <label for="roomName">Tên phòng</label>
                <input type="text" id="roomName" class="form-control" value="{{ $room->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="owner">Chủ phòng</label>
                <input type="text" id="owner" class="form-control" value="{{ $room->user->name }}" disabled>
            </div>
            <div class="form-group">
                <label for="service">Dịch vụ</label>
                <input type="text" id="service" class="form-control" value="{{ $room->service->service_type }}" disabled>
            </div>
            <div class="form-group">
                <label for="price">Giá tiền</label>
                <input type="text" id="price" class="form-control" value="{{ $room->price }}" disabled>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" class="form-control" value="{{ $room->address }}" disabled>
            </div>
            <div class="form-group">
                <label for="area">Diện tích</label>
                <input type="text" id="area" class="form-control" value="{{ $room->area }} m²" disabled>
            </div>
        </div>

        <!-- Thông tin đặt phòng -->
        <h4>Thông tin đặt phòng</h4>
        <div class="mb-4">
            <div class="form-group">
                <label for="bookingDate">Ngày đặt</label>
                <input type="text" id="bookingDate" class="form-control" value="{{ $booking->created_at }}" disabled>
            </div>
            <div class="form-group">
                <label for="updatedAt">Thời gian xác nhận yêu cầu</label>
                <input type="text" id="updatedAt" class="form-control" value="{{ $booking->updated_at }}" disabled>
            </div>

        </div>

        <!-- Nhập số điện và nước -->
        <h4>Nhập số điện và nước</h4>
        <form action="{{ route('invoices.store', $booking->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="electricity">Số điện (kWh)</label>
                <input type="number" id="electricity" name="electricity" class="form-control" placeholder="Nhập số điện" required>
            </div>
            <div class="form-group mb-3">
                <label for="water">Số nước (m³)</label>
                <input type="number" id="water" name="water" class="form-control" placeholder="Nhập số nước" required>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">In hóa đơn</button>
            </div>
        </form>

    </div>
@endsection
