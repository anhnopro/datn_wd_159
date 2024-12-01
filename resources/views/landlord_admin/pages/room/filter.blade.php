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
        {{-- <form method="GET" action="{{ route('landlord_admin.room.list') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <label for="service_type">Chọn loại dịch vụ:</label>
                    <select name="service_type" id="service_type" class="form-control">
                        <option value="">Tất cả</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ request()->service_type == $service->id ? 'selected' : '' }}>
                                {{ $service->service_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="price_range">Chọn mức giá:</label>
                    <select name="price" id="price_range" class="form-control">
                        
                            <option value="">Tất cả mức giá</option>
                            <option value="under_3000000" {{ request('price_range') == 'under_3000000' ? 'selected' : '' }}>Dưới 3 triệu</option>
                            <option value="3000000_10000000" {{ request('price_range') == '3000000_10000000' ? 'selected' : '' }}>3 - 10 triệu</option>
                            <option value="over_10000000" {{ request('price_range') == 'over_10000000' ? 'selected' : '' }}>Trên 10 triệu</option>
                    </select>
                </div>
        
                <div class="col-md-3">
                    <label for="status">Chọn trạng thái:</label>
                    <select name="status" id="" class="form-control">
                        <option value="">Tất cả</option>
                        <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>Còn phòng</option>
                        <option value="0" {{ request()->status == '0' ? 'selected' : '' }}>Hết phòng</option>
                    </select>
                </div>
        
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-4">Lọc</button>
                </div>
            </div>
        </form> --}}
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
                        <td>{{ $room->status ? 'Còn phòng' : 'Hết phòng' }}</td>
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
        <div>
            {{ $rooms->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
