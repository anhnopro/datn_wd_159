@extends('landlord_admin.master')
@section('title')
    Thêm bài viết
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Đăng bài viết</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('landlord_admin.article.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label for="title" class="form-label">Tiêu đề <span style="color: red">*</span></label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title') }}">
                            @error('title')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="category" class="form-label">Danh Mục <span style="color: red">*</span></label>
                            <select name="category_id" class="form-select">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <p id="category-error" style="color: red; display: none;"></p>
                            @error('category_id')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="room" class="form-label">Phòng <span style="color: red">*</span></label>
                            <select name="room_id" class="form-select">
                                <option value="">Chọn Phòng</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}"
                                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold">Mô Tả <span style="color: red">*</span></label>
                            <textarea id="editor"
                                      class="form-control shadow-sm"
                                      name="description"
                                      rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-12 mb-2 text-end">
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-warning">Nhập lại</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('room/editor.js') }}"></script>
@endsection
