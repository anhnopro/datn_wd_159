@extends('landlord_admin.master')
@section('title')
    Danh sách bài viết
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
         <div class="col-xl-12 col-sm-12 col-md-12 mb-2"><h3>Danh sách tin đăng</h3></div>
        <div class="col-xl-12 col-sm-12 col-md-12 mb-2 text-end">
            <a href="{{ route('landlord_admin.article.create') }}" class="btn btn-info">Thêm mới +</a>
        </div>

        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th>Người đăng</th>
                    <th>Tiêu đề</th>
                    <th>Phòng</th>
                    <th>Loại tin</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{{$article->user->name}}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->room->name }}</td>
                    <td>
                        @if($article->type === 'regular')
                            Tin thường
                        @elseif($article->type === 'vip')
                            VIP
                        @elseif($article->type === 'urgent')
                            Tin gấp
                        @elseif($article->type === 'free')
                            Tin miễn phí
                        @else
                            Không xác định
                        @endif
                    </td>

                    <td>{{ $article->category->name }}</td>
                    <td>
                        @if($article->status === 0)
                            <span class="badge bg-primary">Đang chờ kiểm duyệt</span>
                        @elseif ($article->status === 1)
                            <span class="badge bg-danger">Đã bị từ chối</span>
                        @elseif ($article->status === 2)
                            <span class="badge bg-success">Đã được duyệt</span>
                        @endif
                    </td>
                    <td class="d-flex gap-3">
                        {{-- Chi tiết bài viết luôn khả dụng --}}
                        <a class="btn btn-primary" href="{{ route('landlord_admin.article.detail', $article->id) }}">Chi tiết</a>

                        {{-- Logic nút Sửa và Xóa --}}
                        @if($article->status === 0)
                            {{-- Trạng thái đang chờ kiểm duyệt: Có thể chỉnh sửa và xóa --}}
                            <a class="btn btn-warning" href="{{ route('landlord_admin.article.edit', $article->id) }}">Sửa</a>
                            <form action="{{ route('landlord_admin.article.destroy', $article->id) }}" method="POST"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        @elseif($article->status === 1)
                            {{-- Trạng thái đã bị từ chối: Chỉ có thể xóa --}}
                            <form action="{{ route('landlord_admin.article.destroy', $article->id) }}" method="POST"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>

                        @endif
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div>
            {{ $articles->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
