@extends('landlord_admin.master')
@section('title')
    Danh dách dịch vụ
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
        <div class="col-xl-6 col-sm-6 col-md-12 mb-2">
            @if (session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="col-xl-12 col-sm-6 col-md-12 mb-2 text-end">
            <a href="{{ route('landlord_admin.service.create') }}" class="btn btn-info">Thêm mới+</a>
        </div>
        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Loại dịch vụ</th>
                    <th>Điện</th>
                    <th>Nước</th>
                    <th>Rác</th>
                    <th>Wifi</th>
                    <th>Dịch vụ Khác</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $index => $service)
                    <tr>
                        <td>{{ $service->service_type }}</td>
                        <td>{{ $service->electric }}</td>
                        <td>{{ $service->water }}</td>
                        <td>{{ $service->garbage }}</td>
                        <td>{{ $service->wifi }}</td>
                        <td>{{ $service->other }}</td>
                        <td class="d-flex gap-3">
                            <a class="btn btn-warning" href="{{ route('landlord_admin.service.edit', $service->id) }}">Sửa</a>
                            <form action="{{ route('landlord_admin.service.destroy', $service->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này không?');">
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
