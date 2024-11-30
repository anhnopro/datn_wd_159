@extends('admin-main.master')
@section('title')
    Danh sách người thuê
@endsection

@section('content')
    <div class="table-responsive table-card">
        <table class="table table-nowrap table-striped-columns mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                            <label class="form-check-label" for="cardtableCheck"></label>
                        </div>
                    </th>
                    <th scope="col">Số thứ tự</th> <!-- Thay đổi tiêu đề cột -->
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="cardtableCheck{{ $index }}">
                                <label class="form-check-label" for="cardtableCheck{{ $index }}"></label>
                            </div>
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td><a href="#" class="fw-semibold">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light">
                                @if ($user->role == 1)
                                    Người cho thuê
                                @elseif ($user->role == 2)
                                    Người thuê
                                @else
                                    Admin
                                @endif
                            </button>
                        </td>
                        <td><span class="badge bg-success">Kích hoạt</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
