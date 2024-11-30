@extends('admin-main.master')
@section('title')
    Danh mục phòng
@endsection

@section('content')
    <div class="table-responsive table-card">
        <div class="col-xl-12 col-sm-6 col-md-12 mb-2 text-end">
            <a href="{{ route('admin.category.create') }}" class="btn btn-info">Thêm mới+</a>
        </div>
        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <span
                                class="px-2 py-1 rounded {{ $category->status ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                {{ $category->status ? 'Hoạt động' : 'Không hoạt động' }}
                            </span>
                        </td>

                        <td class="d-flex gap-3">
                            <a class="btn btn-warning" href="{{ route('admin.category.edit', $category->id) }}">Sửa</a>
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
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
