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
                            @if ($booking->invoice_status === 'not_created')
                                <span class="badge bg-primary">Chưa tạo hóa đơn</span>
                            @elseif ($booking->invoice_status === 'created')
                                <span class="badge bg-success">Đã hóa đơn</span>
                            @endif
                        </td>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                        <td class="d-flex gap-2">
                            <a class="btn btn-warning btn-sm" href="{{ route('landlord_admin.booking.detail', $booking->id) }}">Chi tiết</a>

                            @if ($booking->invoice_status === 'not_created')
                                <a href="{{ route('invoice.indexForm', $booking->id) }}" class="btn btn-danger btn-sm">Tạo hóa đơn</a>
                            @elseif ($booking->invoice_status === 'created')
                                <a href="" class="btn btn-info btn-sm">Xem trạng thái hóa đơn</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
