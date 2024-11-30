@extends('pages.layouts.main')
@section('title')
    Đặt phòng
@endsection

@section('content')
    <section class="breadcrumb-outer">
        {{-- <div class="container">
      <div class="breadcrumb-content">
        <h2>Reservation</h2>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Booking
            </li>
          </ul>
        </nav>
      </div>
    </div> --}}
    </section>

    <section class="content">
        <div class="container">
            <div class="reservation-links text-center">
                <h2 class="mar-bottom-60 text-capitalize">Đặt phòng</h2>
                <div class="reservation-links-content">
                    <div class="res-item">
                        <a href="availability.html" class="active"><i class="fa fa-check"></i></a>
                        <p>Kiểm tra</p>
                    </div>
                    <div class="res-item">
                        <a href="room-select.html" class="active"><i class="fa fa-check"></i></a>
                        <p>Chọn phòng</p>
                    </div>
                    <div class="res-item">
                        <a href="booking.html" class="active">3</a>
                        <p>Đặt phòng</p>
                    </div>
                    <div class="res-item">
                        <a href="confirmation.html">4</a>
                        <p>Xác nhận</p>
                    </div>
                </div>
            </div>
            <div class="booking">
                <div class="row">
                    <div class="col-lg-8">
                        <form action="{{ route('guest.booking') }}" method="POST">
                            @csrf
                            <div class="booking-content">

                                <div class="personal-info mar-top-50">
                                    <div class="form-title">
                                        <h4 class="mar-bottom-30">Thông tin chi tiết của bạn</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Họ và tên</label>
                                                <input type="text" name="username" placeholder="Ví dụ: Nguyễn Văn A">
                                                @error('username')
                                                    <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Địa chỉ email</label>
                                                <input type="email" name="email" placeholder="">
                                                <p style="font-size: 12px;">Email xác nhận đặt phòng sẽ được gửi đến địa chỉ
                                                    này</p>
                                                @error('email')
                                                    <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Số điện thoại</label>
                                                <input type="text" name="phonenumber" />
                                                @error('phonenumber')
                                                    <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="booking-desc mar-top-50">
                                    <div class="form-title">
                                        <h4 class="mar-bottom-30">Thông tin phòng</h4>
                                    </div>
                                    <div class="reservation-detail">
                                        <h5>{{ $room->name }}</h5>
                                    </div>
                                    <img height="80px" src="{{ asset('storage/' . $article->room->image) }}"
                                        alt="Ảnh phòng">
                                    <p class="mar-bottom-30">Wifi, điều hòa, máy giặt...</p>
                                    <p><i class="fa-solid fa-location"></i>{{ $room->address }}</p>
                                    {{-- <span>{!! number_format($article->room->price, 0, ',', '.') !!} VND</span> --}}
                                    <hr>
                                </div>

                                <div class="card-info mar-top-50">
                                    <div class="form-title">
                                        <h4 class="mar-bottom-30">Chi tiết đặt phòng</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p>Phòng đã chọn: {{ $room->name }}</p>
                                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                                <input type="hidden" name="total_price" value="{{ $room->price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p>Giá phòng: <span>{!! number_format($article->room->price, 0, ',', '.') !!} VND</span></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p for="">Thời gian xem phòng</p>
                                                <input type="date" name="view_date" />
                                                @error('view_date')
                                                    <span style="color: red;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <p for="">Ghi chú cho chủ phòng</p>
                                                <textarea name="" id="" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mar-top-15">
                                            {{-- <div class="form-group mar-bottom-30">
                                                <input type="checkbox" /> I agree to the<a href="#">Terms and
                                                    Conditions</a>
                                            </div> --}}
                                            <div class="card-btn">
                                                <button><a class="btn btn-orange">Xác nhận đặt phòng</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4">
                        <div class="detail-sidebar">
                            <div class="sidebar-reservation">
                                <h3>Your reservation</h3>
                                <div class="reservation-detail">
                                    <div class="rd-top">
                                        <div class="rd-box">
                                            <label>Check in</label>
                                            <p class="bold">04</p>
                                            <p>August, 2019<br />Monday</p>
                                        </div>
                                        <div class="rd-box">
                                            <label>Check out</label>
                                            <p class="bold">13</p>
                                            <p>August, 2019<br />Wednesday</p>
                                        </div>
                                    </div>
                                    <div class="rd-top">
                                        <div class="rd-box">
                                            <p class="bold">03</p>
                                            <p>Guest</p>
                                        </div>
                                        <div class="rd-box">
                                            <p class="bold">10</p>
                                            <p>Night</p>
                                        </div>
                                    </div>
                                </div>
                                <table class="reservation-table table">
                                    <tbody>
                                        <tr>
                                            <td>1 Room x 10 Nights</td>
                                            <td>$12000</td>
                                        </tr>
                                        <tr>
                                            <td>Tax</td>
                                            <td>$80</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td>$12080</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="sidebar-support">
                                <h3>Help and Support</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vivamus ut arnare
                                </p>
                                <p><i class="fa fa-phone"></i> 977 - 222 - 444 - 666</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
