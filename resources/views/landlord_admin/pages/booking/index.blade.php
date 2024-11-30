@extends('landlord_admin.master')
@section('title')
    Danh sách đặt phòng
@endsection



@section('content')
    <div class="table-responsive table-card p-4 shadow-sm rounded">
        <!-- Script để ẩn thông báo -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const successAlert = document.getElementById('success-alert');
                const errorAlert = document.getElementById('error-alert');

                if (successAlert) {
                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 3000); // 3 giây
                }

                if (errorAlert) {
                    setTimeout(function() {
                        errorAlert.style.display = 'none';
                    }, 3000); // 3 giây
                }
            });
        </script>

        <!-- Hiển thị thông báo -->
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

        <!-- Bảng thông tin đặt phòng -->
        <table class="table table-bordered table-hover table-striped mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Khách hàng</th>
                    <th>Tên phòng</th>
                    <th>Trạng thái</th>
                    <th>Thời gian đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->username }}</td>
                        <td>{{ $booking->room->name }}</td>
                        <td>
                            @if ($booking->status === 'pending')
                                <span class="badge bg-primary">Đang chờ xác nhận</span>
                            @elseif ($booking->status === 'confirmed')
                                <span class="badge bg-success">Đã xác nhận</span>
                            @elseif ($booking->status === 'cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                        <td class="d-flex gap-2">
                            <form action="{{ route('landlord_admin.booking.confirmed', $booking->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                <button class="btn btn-primary btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xác nhận đặt phòng này?')">Xác nhận</button>
                            </form>

                            <a class="btn btn-warning btn-sm" href="{{route('landlord_admin.booking.detail', $booking->id)}}">Chi tiết</a>
                            <a href="{{ route('landlord_admin.booking.formCancel', $booking->id) }}"
                                class="btn btn-danger btn-sm">Từ chối</a>
                            <a href="{{ route('invoice.indexForm', $booking->id) }}"
                                class="btn btn-danger btn-sm">Tạo hóa đơn</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
