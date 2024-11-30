@extends('landlord_admin.master')
@section('title')
    Sửa phòng
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="card-title mb-0">Sửa Phòng</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('landlord_admin.room.update', $room->id) }}" method="POST"
                        enctype="multipart/form-data" id="form-edit-room">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                            <!-- Tên phòng -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Tên Phòng *</label>
                                <input type="text" class="form-control shadow-sm" name="name"
                                    value="{{ old('name', $room->name) }}" required>
                                <p id="name-error" style="color: red; display: none;"></p>
                                @error('name')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Danh mục -->
                            <!-- Dịch vụ -->
                            <div class="col-md-6">
                                <label for="service_id" class="form-label fw-bold">Dịch Vụ *</label>
                                <select name="service_id" id="service_id" class="form-select shadow-sm" required>
                                    <option value="">Chọn dịch vụ</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id', $room->service_id) == $service->id ? 'selected' : '' }}>
                                            {{ $service->service_type }}
                                        </option>
                                    @endforeach
                                </select>
                                <p id="service-error" style="color: red; display: none;"></p>
                                @error('service_id')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Chi tiết dịch vụ -->
                            <div class="col-md-6">
                                <label for="service_details" class="form-label fw-bold">Chi Tiết Dịch Vụ</label>
                                <div id="service_details" class="p-2 border rounded bg-white shadow-sm">
                                    <!-- Thông tin dịch vụ sẽ được hiển thị qua AJAX -->
                                    <p class="text-muted">Vui lòng chọn dịch vụ để xem chi tiết.</p>
                                </div>
                            </div>

                            <!-- Giá -->
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold">Giá *</label>
                                <input type="number" class="form-control shadow-sm" name="price"
                                    value="{{ old('price', $room->price) }}" required>
                                <p id="price-error" style="color: red; display: none;"></p>
                                @error('price')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Địa chỉ -->
                            <div class="col-md-6">
                                <label for="address" class="form-label fw-bold">Địa chỉ *</label>
                                <input type="text" class="form-control shadow-sm" name="address"
                                    value="{{ old('address', $room->address) }}" required>
                                <p id="address-error" style="color: red; display: none;"></p>
                                @error('address')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="area" class="form-label fw-bold">M^2 *</label>
                                <input type="text" class="form-control shadow-sm" name="area"
                                    value="{{ old('area', $room->area) }}" required>
                                <p id="area-error" style="color: red; display: none;"></p>
                                @error('area')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>



                            <!-- Hình ảnh -->
                            <div class="col-md-12">
                                <label for="images" class="form-label fw-bold">Hình Ảnh *</label>
                                <input type="file" class="form-control shadow-sm" name="images[]" id="images" multiple
                                    accept="image/*">
                                <div id="preview-images" class="row mt-3 gy-3">
                                    @foreach ($room->galleries as $gallery)
                                        <div class="col-md-3">
                                            <div class="card shadow-sm">
                                                <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top"
                                                    alt="Hình ảnh">
                                                <div class="card-body text-center">
                                                    <p class="small mb-0 text-truncate">{{ basename($gallery->image) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-muted d-block mt-1">Chọn nhiều ảnh bằng cách nhấn giữ phím Ctrl.</small>
                                <p id="images-error" style="color: red; display: none;"></p>
                                @error('images')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Mô tả -->
                            <div class="col-md-12">
                                <label for="description" class="form-label fw-bold">Mô Tả *</label>
                                <textarea id="editor" class="form-control shadow-sm" name="description" rows="4" required>{{ old('description', $room->description) }}</textarea>
                                <p id="description-error" style="color: red; display: none;"></p>
                                @error('description')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Trạng thái -->
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-bold">Trạng Thái</label>
                                <select name="status" class="form-select shadow-sm">
                                    <option value="1" {{ old('status', $room->status) == 1 ? 'selected' : '' }}>Còn
                                        phòng</option>
                                    <option value="0" {{ old('status', $room->status) == 0 ? 'selected' : '' }}>Hết
                                        phòng</option>
                                </select>
                            </div>

                            <!-- Nút hành động -->
                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-success px-4 shadow-sm">Cập Nhật</button>
                                <button type="reset" class="btn btn-warning px-4 shadow-sm">Nhập Lại</button>
                                <button type="button" class="btn btn-info px-4 shadow-sm"
                                    onclick="window.history.back()">Quay Lại</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            const serviceId = "{{ $room->service_id }}";
            if (serviceId) {
                loadServiceDetails(serviceId);
            }

            // Khi chọn dịch vụ khác
            $('#service_id').change(function() {
                const serviceId = $(this).val();
                if (serviceId) {
                    loadServiceDetails(serviceId);
                } else {
                    $('#service_details').html('<p class="text-muted">Không có thông tin dịch vụ.</p>');
                }
            });

            // Hàm tải chi tiết dịch vụ qua AJAX
            function loadServiceDetails(serviceId) {
                $.ajax({
                    url: `/landlord_admin/service/${serviceId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const detailsHtml = `
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
                            '<p class="text-danger">Không thể tải thông tin dịch vụ.</p>');
                    }
                });
            }
        });
    </script>
    <script src="{{ asset('room/editor.js') }}"></script>
    <script src="{{ asset('room/images.js') }}"></script>
@endsection
