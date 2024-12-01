@extends('admin-main.master')
@section('title')
    Danh sách bài viết
@endsection

@section('content')
    <div class="table-responsive table-card">

        <div class="col-xl-12 col-sm-12 col-md-12 mb-2 text-end">
            <a href="{{ route('landlord_admin.article.create') }}" class="btn btn-info">Thêm mới +</a>
        </div>

        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tiêu đề</th>
                    <th>Phòng</th>
                    <th>Danh mục</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->room->name ?? 'Không phòng' }}</td>
                    <td>{{ $article->category->name ?? 'Không danh mục' }}</td>
                    <td>
                        @if ($article->status == 0)
                            <span class="badge bg-primary">Đang chờ duyệt</span>
                        @elseif ($article->status == 1)
                            <span class="badge bg-danger">Bị hủy</span>
                        @else
                            <span class="badge bg-success">Đã duyệt</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        @if ($article->status == 0)  <!-- Only show these buttons if status is "Pending" -->
                            <form action="{{ route('admin.article.confirm', $article->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-primary btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xác nhận đăng bài này?')">Xác nhận</button>
                            </form>

                            <form action="{{ route('admin.article.rejected', $article->id) }}" method="post" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn từ chối bài đăng này?')">Từ chối</button>
                            </form>
                        @endif

                        <!-- Always show "Detail" button -->
                        <a class="btn btn-warning btn-sm" href="{{ route('admin.article.detail', $article->id) }}">Chi tiết</a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $articles->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
