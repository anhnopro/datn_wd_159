{{-- @extends('admin-main.master')
@section('title')
    Danh sách phòng
@endsection

@section('content')
    <div class="table-responsive table-card">

        <div class="col-xl-12 col-sm-12 col-md-12 mb-2 text-end">
            <a href="{{ route('admin.room.create') }}" class="btn btn-info">Thêm mới +</a>
        </div>

        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tên phòng</th>
                    <th>Loại dịch vụ</th>
                    <th>Hình ảnh</th>
                    <th>Địa chỉ</th>
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
                        <td>{{ $room->address }}</td>
                        <td>{{ number_format($room->price, 2) }} VNĐ</td>
                        <td>{{ $room->status ? 'còn phòng' : 'hết phòng' }}</td>
                        <td class="d-flex gap-3">
                            <a class="btn btn-warning" href="{{ route('admin.room.edit', $room->id) }}">Sửa</a>
                            <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa phòng này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <div >
                {{ $rooms->links('pagination::bootstrap-5') }}
            </div>
        </table>
        
        
    </div>
    
@endsection --}}


@extends('admin-main.master')
@section('title')
    Danh sách phòng
@endsection

@section('content')
    <div class="table-responsive table-card">

        <div class="col-xl-12 col-sm-12 col-md-12 mb-2 text-end">
            <a href="{{ route('admin.room.create') }}" class="btn btn-info">Thêm mới +</a>
        </div>

        <form method="GET" action="{{ route('admin.room.filter') }}" class="mb-3">
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
                    <select name="price_range" id="price_range" class="form-control">
                        
                            <option value="">Tất cả mức giá</option>
                            <option value="1" {{ request('price_range') == '1' ? 'selected' : '' }}>Dưới 3 triệu</option>
                            <option value="2" {{ request('price_range') == '2' ? 'selected' : '' }}>3 - 10 triệu</option>
                            <option value="3" {{ request('price_range') == '3' ? 'selected' : '' }}>Trên 10 triệu</option>
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
        </form>
        
        

        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tên phòng</th>
                    <th>Loại dịch vụ</th>
                    <th>Hình ảnh</th>
                    <th>Địa chỉ</th>
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
                        <td>{{ $room->address }}</td>
                        <td>{{ number_format($room->price, 2) }} VNĐ</td>
                        <td>{{ $room->status ? 'còn phòng' : 'hết phòng' }}</td>
                        <td class="d-flex gap-3">
                            <a class="btn btn-warning" href="{{ route('admin.room.edit', $room->id) }}">Sửa</a>
                            <form action="{{ route('admin.room.destroy', $room->id) }}" method="POST"
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

        <!-- Phân trang -->
        <div>
            {{ $rooms->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

