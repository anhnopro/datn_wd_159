@extends('landlord_admin.master')
@section('title')
    Thêm Phòng
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm Phòng</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.room.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-4">
                            <!-- Tên phòng -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Tên Phòng <span style="color:red;"> *<span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-2" id="name-error" style="color: red;">{{ $message }}</p>
                                @enderror
                                <p class="mt-2" id="name-error" style="color: red; display: none;"></p>
                            </div>
                            <!-- Dịch vụ -->
                            <div class="col-md-6">
                                <label for="service" class="form-label">Chọn Dịch Vụ <span style="color:red;">
                                        *<span></label>
                                <select name="service_id" id="service" class="form-select">
                                    <option value="">Chọn dịch vụ</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_type }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-2" id="service-error" style="color: red; display: none;"></p>
                                @error('service_id')
                                    <p class="mt-2" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Chi tiết dịch vụ -->
                            <div class="col-md-6">
                                <label for="service_details" class="form-label">Chi Tiết Dịch Vụ</label>
                                <div id="service_details" class="p-2 border rounded">
                                    <!-- Thông tin dịch vụ sẽ hiển thị ở đây -->
                                </div>
                            </div>

                            <!-- Giá -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá <span style="color:red;"> *<span></label>
                                <input
                                    type="text"
                                    id="formatted-price"
                                    class="form-control"
                                    value="{{ old('price') }}"
                                    oninput="formatPrice(this)"
                                    onblur="syncHiddenInput()"
                                >
                                <input type="hidden" id="price" name="price" value="{{ old('price') }}">
                                <p class="mt-2" id="price-error" style="color: red; display: none;"></p>
                                @error('price')
                                    <p class="mt-2" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Địa chỉ -->
                            <div class="col-md-6">
                                <label for="address" class="form-label">Địa chỉ <span style="color:red;"> *<span></label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                <p class="mt-2" id="address-error" style="color: red; display: none;"></p>
                                @error('address')
                                    <p class="mt-2" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="area" class="form-label">Diện tích(mét vuông) <span style="color:red;">
                                        *<span></label>
                                <input type="text" name="area" class="form-control" value="{{ old('area') }}">
                                <p class="mt-2" id="area-error" style="color: red; display: none;"></p>
                                @error('area')
                                    <p class="mt-2" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hình ảnh -->
                            <div class="col-md-12">
                                <label for="images" class="form-label fw-bold">Hình Ảnh <span style="color:red;">
                                        *<span></label>
                                <input type="file" class="form-control shadow-sm" name="images[]" id="images" multiple
                                    accept="image/*">
                                <div id="preview-images" class="row mt-3 gy-3"></div>
                                <small class="text-muted d-block mt-1">Chọn nhiều ảnh bằng cách nhấn giữ phím Ctrl.</small>
                                <p class="mt-2" id="images-error" style="color: red; display: none;"></p>
                                @error('images')
                                    <p class="mt-2" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Mô tả -->
                            <div class="col-md-12">
                                <label for="description" class="form-label fw-bold">Mô Tả <span style="color:red;">
                                        *<span></label>
                                <textarea id="editor" class="form-control shadow-sm" name="description" rows="4">{{ old('description') }}</textarea>
                                <p class="mt-2" id="description-error" style="color: red; display: none;"></p>
                                @error('description')
                                    <p class="mt-2" style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nút hành động -->
                            <div class="col-sm-12 col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-success">Thêm mới</button>
                                <button type="reset" class="btn btn-warning">Nhập lại</button>
                                <button type="button" class="btn btn-info" onclick="window.history.back()">Quay
                                    lại</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="{{asset('room/formatPrice.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#service').change(function() {
                var serviceId = $(this).val();
                if (serviceId) {
                    $.ajax({
                        url: `/landlord_admin/service/${serviceId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var detailsHtml = `
                                <p><strong>Loại dịch vụ:</strong> ${data.service_type}</p>
                                <p><strong>Giá điện:</strong> ${data.electric}</p>
                                <p><strong>Giá nước:</strong> ${data.water}</p>
                                <p><strong>Wifi:</strong> ${data.wifi}</p>
                                <p><strong>Giá vệ sinh:</strong> ${data.garbage}</p>
                                <p><strong>Dịch vụ khác:</strong> ${data.other}</p>
                            `;
                            $('#service_details').html(detailsHtml);
                        },
                        error: function() {
                            $('#service_details').html(
                                '<p class="text-danger">Không thể lấy thông tin dịch vụ.</p>'
                            );
                        }
                    });
                } else {
                    $('#service_details').html('');
                }
            });
        });
    </script>
    <script src="{{ asset('room/editor.js') }}"></script>
    <script src="{{ asset('room/images.js') }}"></script>
    <script src="{{ asset('room/validate-room.js') }}"></script>

@endsection
