@extends('admin-main.master')
@section('title')
    Thêm mới dịch vụ
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới dịch vụ</h4>
                    <div class="flex-shrink-0">
                    </div>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('service.store') }}" class="row gy-4 d-flex justify-content-center" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Tên dịch vụ *</label>
                                    <input type="text" class="form-control" name="service_type">
                                </div>
                            </div>
                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Giá điện *</label>
                                    <input type="text" class="form-control" name="electric">
                                </div>
                            </div>
                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Giá nước *</label>
                                    <input type="text" class="form-control" name="water">
                                </div>
                            </div>
                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Wifi *</label>
                                    <input type="text" class="form-control" name="wifi">
                                </div>
                            </div>
                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Giá vệ sinh *</label>
                                    <input type="text" class="form-control" name="garbage">
                                </div>
                            </div>
                            <div class="col-xxl-6 col-md-6 mb-2">
                                <div>
                                    <label for="" class="form-label">Dịch vụ khác</label>
                                    <input type="text" class="form-control" name="other">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-success ">Thêm mới</button>
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
