@extends('landlord_admin.master')
@section('title')
    Cập nhật bài viết
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Cập nhật bài viết</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('landlord_admin.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Tiêu đề *</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title', $article->title) }}">
                            @error('title')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="category" class="form-label">Danh Mục *</label>
                            <select name="category_id" class="form-select">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="room" class="form-label">Phòng *</label>
                            <select name="room_id" class="form-select">
                                <option value="">Chọn Phòng</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}"
                                        {{ old('room_id', $article->room_id) == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thêm trường chọn 'type' vào đây -->
                        <div class="col-md-6">
                            <label for="type" class="form-label">Loại bài viết *</label>
                            <select name="type" class="form-select">
                                <option value="regular" {{ old('type', $article->type) == 'regular' ? 'selected' : '' }}>Regular</option>
                                <option value="vip" {{ old('type', $article->type) == 'vip' ? 'selected' : '' }}>VIP</option>
                                <option value="urgent" {{ old('type', $article->type) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                <option value="free" {{ old('type', $article->type) == 'free' ? 'selected' : '' }}>Free</option>
                            </select>
                            @error('type')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold">Mô Tả *</label>
                            <textarea id="editor"
                                      class="form-control shadow-sm"
                                      name="description"
                                      rows="4">{{ old('description', $article->description) }}</textarea>
                            @error('description')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-12 mb-2 text-end">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                            <button type="button" class="btn btn-warning" onclick="window.location.reload()">Nhập lại</button>
                            <button type="button" class="btn btn-info" onclick="window.history.back()">Quay lại</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script src="{{ asset('room/editor.js') }}"></script>
@endsection
