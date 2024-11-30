@extends('landlord_admin.master')
@section('title')
    Sửa dịch vụ
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sửa dịch vụ</h4>
                    <div class="flex-shrink-0">
                    </div>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <!-- Form chỉnh sửa dịch vụ -->
                        <form action="{{ route('landlord_admin.service.update', $service->id) }}" class="row gy-4 d-flex justify-content-center" method="POST">
                            @csrf
                            @method('PUT') <!-- Phương thức PUT cho cập nhật -->
                            
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Tên dịch vụ <span style="color: red">*</span></label>
                                    <input type="text" class="form-control @error('service_type') is-invalid @enderror" name="service_type" value="{{ old('service_type', $service->service_type) }}">
                                    @error('service_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Giá điện <span style="color: red">*</span></label>
                                    <input type="text" class="form-control @error('electric') is-invalid @enderror" name="electric" value="{{ old('electric', $service->electric) }}">
                                    @error('electric')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Giá nước <span style="color: red">*</span></label>
                                    <input type="text" class="form-control @error('water') is-invalid @enderror" name="water" value="{{ old('water', $service->water) }}">
                                    @error('water')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Wifi <span style="color: red">*</span></label>
                                    <input type="text" class="form-control @error('wifi') is-invalid @enderror" name="wifi" value="{{ old('wifi', $service->wifi) }}">
                                    @error('wifi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Giá vệ sinh <span style="color: red">*</span></label>
                                    <input type="text" class="form-control @error('garbage') is-invalid @enderror" name="garbage" value="{{ old('garbage', $service->garbage) }}">
                                    @error('garbage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Dịch vụ khác</label>
                                    <input type="text" class="form-control @error('other') is-invalid @enderror" name="other" value="{{ old('other', $service->other) }}">
                                    @error('other')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                                <button type="reset" class="btn btn-warning">Nhập lại</button>
                                <button type="reset" class="btn btn-info" onclick="window.history.back()">Quay lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
