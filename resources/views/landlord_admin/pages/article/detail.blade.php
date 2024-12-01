@extends('landlord_admin.master')

@section('title')
    Chi tiết Bài Viết
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <h4 class="card-title mb-0 flex-grow-1" style="color: white">Chi tiết Bài Viết</h4>
                    <button class="btn btn-light btn-sm" onclick="window.history.back()">Quay lại</button>
                </div>
                <div class="card-body">
                    <!-- Thông tin bài viết -->
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Thông tin bài viết</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Tiêu đề</th>
                                        <td>{{ $article->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Danh mục</th>
                                        <td>{{ $article->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả bài viết</th>
                                        <td>{{ $article->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái bài viết</th>
                                        <td>
                                            @if ($article->status)
                                                <span class="badge bg-success">Hoạt động</span>
                                            @else
                                                <span class="badge bg-danger">Không hoạt động</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Thông tin phòng -->
                        <div class="col-lg-6">
                            <h5>Thông tin phòng</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Tên phòng</th>
                                        <td>{{ $article->room->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ</th>
                                        <td>{{ $article->room->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giá</th>
                                        <td>{{ number_format($article->room->price, 2) }} VND</td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả phòng</th>
                                        <td>{!! $article->room->description !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái phòng</th>
                                        <td>
                                            @if ($article->room->status)
                                                <span class="badge bg-success">Còn phòng</span>
                                            @else
                                                <span class="badge bg-danger">Hết phòng</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Hình ảnh chính -->


                    <!-- Thư viện hình ảnh -->
                    <div class="mt-4">
                        <h5> Hình ảnh</h5>
                        <div class="row g-3">
                            @foreach ($article->room->galleries as $gallery)
                                <div class="col-md-3">
                                    <a href="{{ asset('storage/' . $gallery->image) }}" data-lightbox="room-gallery" data-title="{{ $article->room->name }}">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery Image" class="img-thumbnail shadow-sm" style="height: 200px; width: 100%; object-fit: cover;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Dịch vụ liên quan -->
                    <div class="mt-4">
                        <h5>Dịch vụ liên quan</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loại dịch vụ</th>
                                    <th>Điện</th>
                                    <th>Nước</th>
                                    <th>Rác</th>
                                    <th>Wifi</th>
                                    <th>Khác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($article->room->service)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $article->room->service->service_type }}</td>
                                        <td>{{ $article->room->service->electric }}</td>
                                        <td>{{ $article->room->service->water }}</td>
                                        <td>{{ $article->room->service->garbage }}</td>
                                        <td>{{ $article->room->service->wifi }}</td>
                                        <td>{{ $article->room->service->other }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Không có dịch vụ liên quan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Các nút thao tác -->
                    <div class="text-end mt-3">
                        <a href="{{ route('landlord_admin.article.edit', $article->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                        <form action="{{ route('landlord_admin.article.destroy', $article->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endsection
