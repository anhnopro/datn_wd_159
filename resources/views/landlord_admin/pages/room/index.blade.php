@extends('landlord_admin.master')
@section('title')
    Danh sách phòng
@endsection

@section('content')
    <div class="table-responsive table-card">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 3000); // 3 giây
                }
            });
        </script>


        <div class="col-xl-12 col-sm-12 col-md-12 mb-2">
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="col-xl-12 col-sm-12 col-md-12 mb-2 text-end">
            <a href="{{ route('landlord_admin.room.create') }}" class="btn btn-info">Thêm mới +</a>
        </div>

        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tên phòng</th>
                    <th>Loại dịch vụ</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->service->service_type ?? 'Không có dịch vụ' }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" width="100">
                        </td>
                        <td>{{ number_format($room->price, 2) }} VNĐ</td>
                        <td>{{ $room->status ? 'còn phòng' : 'hết phòng' }}</td>
                        <td class="d-flex gap-3">
                            <a class="btn btn-warning" href="{{ route('landlord_admin.room.edit', $room->id) }}">Sửa</a>
                            <form action="{{ route('landlord_admin.room.destroy', $room->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa phòng này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
