@extends('pages.layouts.main')
@section('title')
    {{ $article->title }}
@endsection

@section('content')
    <section class="breadcrumb-outer">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Room Details Full Width</h2>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Room Details 2
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <section class="details">
        <div class="container">
            <div class="detail-slider">
                <div class="slider-1 slider-for">
                    <div class="detail-slider-item">
                        <img src="{{ asset('storage/' . $article->room->image) }}" alt="image" />
                    </div>
                </div>
                <div class="slider-1 slider-nav">
                    @foreach ($images as $image)
                        <div class="detail-slider-item">
                            <img height="150px" src="{{ asset('storage/' . $image->image) }}" alt="image" />
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="detail-content">
                <div class="detail-title">
                    <div class="title-left">
                        <h3>{{ $article->title }}</h3>
                        <div class="rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                    </div>
                    <div class="title-right pull-right">
                        <div class="title-price">
                            <h3>{{ number_format($article->room->price, 0, ',', '.') }} VND<span></h3>
                            /Tháng</span></h3>
                        </div>
                        <div class="title-price">
                            {{-- {{ dd($article) }} --}}
                            <a href="{{ route('guest.info.booking', $article->id) }}" class="btn btn-orange">Đặt phòng</a>
                        </div>

                    </div>
                </div>
                <div class="detail-overview">
                    <div class="row d-flex">
                        <div class="col-lg-8 ">
                            <div class="overview-outer ">
                                <div class="overview-content mar-bottom-30">
                                    <h4>Mô tả</h4>
                                    <p>{!! $article->description !!}</p>
                                    <h6>Tên phòng: {{ $article->room->name }}</h6>
                                    <p>{!! $article->room->description !!}</p>

                                </div>
                                <div class="price-table">
                                    <h4>Bảng giá dịch vụ</h4>
                                    <table class="table table-bordered mar-0">
                                        <thead>
                                            <tr>
                                                <td>Điện </td>
                                                <td>Nước</td>
                                                <td>Wifi</td>
                                                <td>Rác</td>
                                                <td>Dịch vụ khác</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ number_format($room->service->electric, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($room->service->water, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($room->service->wifi, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($room->service->garbage, 0, ',', '.') }} VND</td>
                                                <td>{{ number_format($room->service->other, 0, ',', '.') }} VND</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="detail-sidebar col-lg-4">
                            <div class="sidebar-search sidebar-item">
                                <h4>Tìm kiếm</h4>
                                <form>
                                    <input type="text" placeholder="Từ khóa" />
                                    <a href="#">Đi</a>
                                </form>
                            </div>
                            <div class="recent-post sidebar-item">
                                <h4>Bài đăng mới</h4>
                                @foreach ($articleRecents as $articleRecent)
                                    <div class="recent-item clearfix">
                                        <div class="recent-image">
                                            <img src="{{ asset('storage/' . $articleRecent->room->image) }}"
                                                alt="image" />
                                        </div>
                                        <div class="recent-content">
                                            <h5 class="mar-bottom-10">{{ $articleRecent->title }}</h5>
                                            <div class="room-services">
                                                <ul>
                                                    <li><i class="fa fa-user" aria-hidden="true"></i> Tác giả</li>
                                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                                        {{ $articleRecent->created_at }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="sidebar-box">
                                <div class="sidebar-title">
                                    <h4>Danh mục</h4>
                                </div>
                                <div class="sidebar-content">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="#"><i class="fa fa-location-arrow"></i> {{$category->name}}(25)</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="overwiew-map">
                                <div id="map" style="height: 357px; width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="check-in">
        <div class="container">
            <div class="form-content">
                <div class="table-item">
                    <div class="form-group">
                        <div class="date-range-inner-wrapper">
                            <input id="date-range2" class="form-control" value="Check In" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-item">
                    <div class="form-group">
                        <div class="date-range-inner-wrapper">
                            <input id="date-range3" class="form-control" value="Check In" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-item">
                    <div class="form-group form-icon">
                        <select class="wide">
                            <option value="0">Type</option>
                            <option value="1">0</option>
                            <option value="2">1</option>
                            <option value="3">2</option>
                            <option value="4">3</option>
                            <option value="5">4</option>
                        </select>
                    </div>
                </div>
                <div class="table-item">
                    <div class="form-group form-icon">
                        <select class="wide">
                            <option value="0">Destination</option>
                            <option value="1">0</option>
                            <option value="2">1</option>
                            <option value="3">2</option>
                            <option value="4">3</option>
                            <option value="5">4</option>
                        </select>
                    </div>
                </div>
                <div class="table-item">
                    <div class="form-btn">
                        <a class="btn btn-orange">Check Availability</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="amenities">
        <div class="container">
            <div class="section-title">
                <h3>Explore <span>Amenities</span></h3>
            </div>
            <div class="amenities-content">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item mar-bottom-30">
                            <div class="amt-icon">
                                <i class="fa fa-glass" aria-hidden="true"></i>
                            </div>
                            <h4>Private bar</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item mar-bottom-30">
                            <div class="amt-icon">
                                <i class="fa fa-car" aria-hidden="true"></i>
                            </div>
                            <h4>Transport</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item mar-bottom-30">
                            <div class="amt-icon">
                                <i class="fa fa-wifi" aria-hidden="true"></i>
                            </div>
                            <h4>Free wifi</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item mar-bottom-30">
                            <div class="amt-icon">
                                <i class="fa fa-bath" aria-hidden="true"></i>
                            </div>
                            <h4>Laundry service</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item">
                            <div class="amt-icon">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                            </div>
                            <h4>Quick service</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item">
                            <div class="amt-icon">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <h4>City map</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item">
                            <div class="amt-icon">
                                <i class="fa fa-life-ring" aria-hidden="true"></i>
                            </div>
                            <h4>Swimming pool</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="amt-item">
                            <div class="amt-icon">
                                <i class="fa fa-bolt" aria-hidden="true"></i>
                            </div>
                            <h4>Smoking free</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="detail-features">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="feature-item">
                    <div class="feature-image">
                        <img src="images/feature1.jpg" alt="image" />
                    </div>
                    <div class="feature-content">
                        <img src="images/icons/ficon1.png" alt="image" />
                        <h4><a href="#" class="white">Fitness club</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="feature-item">
                    <div class="feature-image">
                        <img src="images/feature2.jpg" alt="image" />
                    </div>
                    <div class="feature-content">
                        <img src="images/icons/ficon2.png" alt="image" />
                        <h4><a href="#" class="white">Private Beach</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="feature-item">
                    <div class="feature-image">
                        <img src="images/feature3.jpg" alt="image" />
                    </div>
                    <div class="feature-content">
                        <img src="images/icons/ficon3.png" alt="image" />
                        <h4><a href="#" class="white">Bicycle Hire</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="feature-item">
                    <div class="feature-image">
                        <img src="images/feature4.jpg" alt="image" />
                    </div>
                    <div class="feature-content">
                        <img src="images/icons/ficon4.png" alt="image" />
                        <h4><a href="#" class="white">Restaurant</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="detail-reviews">
        <div class="container">
            <div class="section-title">
                <h2>Explore <span>Reviews</span></h2>
            </div>
            <div class="review-outer">
                <ul>
                    <li>
                        <div class="review-item">
                            <div class="review-image">
                                <img src="images/review1.jpg" alt="image" />
                            </div>
                            <div class="review-content">
                                <h5>Micheal Clordy</h5>
                                <a href="#"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                <p class="date">November 10,2018 at 3:10 pm</p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Proin id iaculis arcu. Aenean non dolor magna. In sed
                                    consectetur nisi. Sed venenatis, nibh sit amet sodales
                                    ullamcorper, ipsum orci condimentum tortor, et cursus
                                    veli.tturpis at justo. Vivamus pellentesque volutpat urna
                                    vel eleifend.
                                </p>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <div class="review-item">
                                    <div class="review-image">
                                        <img src="images/review2.jpg" alt="image" />
                                    </div>
                                    <div class="review-content">
                                        <h5>Micheal Clordy</h5>
                                        <a href="#"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                        <p class="date">November 10,2018 at 3:10 pm</p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Proin id iaculis arcu. Aenean non dolor magna. In sed
                                            consectetur nisi. Sed venenatis, nibh sit amet sodales
                                            ullamcorper, ipsum orci condimentum tortor, et cursus
                                            veli.tturpis at justo. Vivamus pellentesque volutpat
                                            urna vel eleifend.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="review-item">
                            <div class="review-image">
                                <img src="images/review3.jpg" alt="image" />
                            </div>
                            <div class="review-content">
                                <h5>Micheal Clordy</h5>
                                <a href="#"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                <p class="date">November 10,2018 at 3:10 pm</p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Proin id iaculis arcu. Aenean non dolor magna. In sed
                                    consectetur nisi. Sed venenatis, nibh sit amet sodales
                                    ullamcorper, ipsum orci condimentum tortor, et cursus
                                    veli.tturpis at justo. Vivamus pellentesque volutpat urna
                                    vel eleifend.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="comment-box">
                <h4>Leave a message</h4>
                <form>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <input type="text" class="form-control" id="fname" placeholder="First Name" />
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="text" class="form-control" id="lname" placeholder="Last Name" />
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="email" class="form-control" id="email" placeholder="Email" />
                        </div>
                        <div class="form-group col-lg-3">
                            <input type="text" class="form-control" id="number" placeholder="Phone" />
                        </div>
                    </div>
                    <div class="comment-btn text-center">
                        <a href="#" class="btn btn-orange">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="related-rooms">
        <div class="container">
            <div class="section-title">
                <h2>Explore <span>Rooms</span></h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ex
                    neque, sodales accumsan sapien et, auctor vulputate quam donec vitae
                    consectetur turpis
                </p>
            </div>
            <div class="room-outer">
                <div class="row team-slider">
                    <div class="col-md-4">
                        <div class="room-item">
                            <div class="room-image">
                                <img src="images/room1.jpg" alt="image" />
                            </div>
                            <div class="room-content">
                                <div class="room-title">
                                    <h4>Super Luxury</h4>
                                    <p><i class="fa fa-tag"></i> $1000/Night</p>
                                    <div class="deal-rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                </div>
                                <div class="room-services mar-bottom-15">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <i class="fa fa-bed" aria-hidden="true"></i> 3 Bedrooms
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <i class="fa fa-wifi" aria-hidden="true"></i> Quick
                                            Service
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vestibulum orci nulla, fermentum in faucibus a, interdum eu
                                    nibh.
                                </p>
                                <div class="room-btns">
                                    <a href="#" class="btn btn-black mar-right-10">VIEW DETAILS</a>
                                    <a href="#" class="btn btn-orange">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="room-item">
                            <div class="room-image">
                                <img src="images/room2.jpg" alt="image" />
                            </div>
                            <div class="room-content">
                                <div class="room-title">
                                    <h4>Junior Suite</h4>
                                    <p><i class="fa fa-tag"></i> $500/Night</p>
                                    <div class="deal-rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                </div>
                                <div class="room-services mar-bottom-15">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <i class="fa fa-bed" aria-hidden="true"></i> 3 Bedrooms
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <i class="fa fa-wifi" aria-hidden="true"></i> Quick
                                            Service
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vestibulum orci nulla, fermentum in faucibus a, interdum eu
                                    nibh.
                                </p>
                                <div class="room-btns">
                                    <a href="#" class="btn btn-black mar-right-10">VIEW DETAILS</a>
                                    <a href="#" class="btn btn-orange">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="room-item">
                            <div class="room-image">
                                <img src="images/room3.jpg" alt="image" />
                            </div>
                            <div class="room-content">
                                <div class="room-title">
                                    <h4>Executive Suite</h4>
                                    <p><i class="fa fa-tag"></i> $8120/Night</p>
                                    <div class="deal-rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                </div>
                                <div class="room-services mar-bottom-15">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <i class="fa fa-bed" aria-hidden="true"></i> 3 Bedrooms
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <i class="fa fa-wifi" aria-hidden="true"></i> Quick
                                            Service
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vestibulum orci nulla, fermentum in faucibus a, interdum eu
                                    nibh.
                                </p>
                                <div class="room-btns">
                                    <a href="#" class="btn btn-black mar-right-10">VIEW DETAILS</a>
                                    <a href="#" class="btn btn-orange">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="room-item">
                            <div class="room-image">
                                <img src="images/room4.jpg" alt="image" />
                            </div>
                            <div class="room-content">
                                <div class="room-title">
                                    <h4>Royal Suite</h4>
                                    <p><i class="fa fa-tag"></i> $500/Night</p>
                                    <div class="deal-rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                </div>
                                <div class="room-services mar-bottom-15">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <i class="fa fa-bed" aria-hidden="true"></i> 3 Bedrooms
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <i class="fa fa-wifi" aria-hidden="true"></i> Quick
                                            Service
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Vestibulum orci nulla, fermentum in faucibus a, interdum eu
                                    nibh.
                                </p>
                                <div class="room-btns">
                                    <a href="#" class="btn btn-black mar-right-10">VIEW DETAILS</a>
                                    <a href="#" class="btn btn-orange">BOOK NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
