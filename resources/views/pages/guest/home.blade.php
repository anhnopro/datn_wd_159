@extends('pages.layouts.main')
@section('title', 'Trang chủ')
@section('content')
    <section class="banner">
        <div class="slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"
                        style="background-image: url({{ asset('client/assets/images/slider/slider4.jpg') }})">
                        <div class="swiper-content">
                            <div class="slider-logo">
                                <img src="{{ asset('client/assets/images/icons/bed-logo.png') }}" alt="Image" />
                            </div>
                            <h3 data-animation="animated fadeInUp">Room Availability Checker & Booking</h3>
                            <h1 data-animation="animated fadeInUp">Book Early <span>Save</span>More</h1>
                            <a href="#" data-animation="animated fadeInUp"
                                class="slider-btn btn-or mar-right-10">Explore Our Rooms</a>
                        </div>
                    </div>
                    <div class="swiper-slide"
                        style="background-image: url({{ asset('client/assets/images/slider/slider2.jpg') }})">
                        <div class="swiper-content">
                            <div class="slider-logo">
                                <img src="{{ asset('client/assets/images/icons/bed-logo.png') }}" alt="Image" />
                            </div>
                            <h3 data-animation="animated fadeInUp">The lap of Luxury</h3>
                            <h1 data-animation="animated fadeInUp">Quality <span>Holiday</span> With Us</h1>
                            <a href="#" data-animation="animated fadeInUp" class="slider-btn btn-or">Book A Room
                                Now</a>
                        </div>
                    </div>
                    <div class="swiper-slide"
                        style="background-image: url({{ asset('client/assets/images/slider/slider3.jpg') }})">
                        <div class="swiper-content">
                            <div class="slider-logo">
                                <img src="i{{ asset('client/assets/images/icons/bed-logo.png') }}" alt="Image" />
                            </div>
                            <h3 data-animation="animated fadeInUp">As We Like to Keep It That Way</h3>
                            <h1 data-animation="animated fadeInUp">A <span>Five Star</span> Hotel</h1>
                            <a href="#" data-animation="animated fadeInUp"
                                class="slider-btn btn-or mar-right-10">Explore Our Rooms</a>
                            <a href="#" data-animation="animated fadeInUp" class="slider-btn btn-wt">Book A Room
                                Now</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination"></div>
            </div>
            <div class="overlay"></div>
        </div>
        <div class="banner-form form-style-1 form-style-3">
        </div>
    </section>





    <section class="rooms rooms-style2">
        <div class="container">
            <div class="section-title">
                <h2>Phòng trọ <span>nổi bật</span></h2>
            </div>
            <form action="{{ route('guest.filter') }}" method="GET" class="mb-4">
                <div class="row">
                    <!-- Lọc theo danh mục -->
                    <div class="col-md-3">
                        <select name="category_id" class="form-select">
                            <option value="">Tất cả danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lọc theo giá -->
                    <div class="col-md-3">
                        <select name="price_range" class="form-select">
                            <option value="">Tất cả mức giá</option>
                            <option value="1" {{ request('price_range') == '1' ? 'selected' : '' }}>Dưới 1 triệu
                            </option>
                            <option value="2" {{ request('price_range') == '2' ? 'selected' : '' }}>1 - 3 triệu
                            </option>
                            <option value="3" {{ request('price_range') == '3' ? 'selected' : '' }}>Trên 3 triệu
                            </option>
                        </select>
                    </div>

                    <!-- Lọc theo địa chỉ -->
                    <div class="col-md-3">
                        <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ"
                            value="{{ request('address') }}">
                    </div>

                    <!-- Nút Lọc -->
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Lọc</button>
                    </div>
                </div>
            </form>


            <div class="room-outer">
                <div class="row">
                    @foreach ($articlesVip as $article)
                        <div class="col-lg-3 col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <!-- Room Image -->
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $article->room->image) }}" alt="Room Image"
                                        class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 bg-dark text-white px-2 py-1 rounded">
                                        <i class="fas fa-camera"></i> 3
                                    </div>
                                </div>

                                <!-- Room Content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title text-truncate mb-2" title="{{ $article->title }}">
                                        {{ $article->title }}</h5>

                                    <!-- Price and Area -->
                                    <p class="text-danger fw-bold mb-1">
                                        {{ number_format($article->room->price, 0, ',', '.') }} VNĐ &nbsp;·&nbsp;
                                        {{ $article->room->area }} m²
                                    </p>

                                    <!-- Address -->
                                    <p class="text-muted small mb-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $article->room->address ? '...' . substr($article->room->address, -20) : 'Địa chỉ chưa cập nhật' }}
                                    </p>



                                    @php
                                    $updatedAt = \Carbon\Carbon::parse($article->updated_at);
                                    $daysDiff = $updatedAt->diffInDays(\Carbon\Carbon::now());
                                @endphp

                                <p class="text-muted small">
                                    @if($daysDiff === 0)
                                        Đăng hôm nay
                                    @elseif($daysDiff === 1)
                                        Đăng hôm qua
                                    @else
                                        Đăng {{ $daysDiff }} ngày trước
                                    @endif
                                </p>


                                </div>

                                <!-- Card Footer -->
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <a href="{{ route('guest.detail', $article->id) }}" class="btn btn-primary btn-sm">Chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>




            </div>

        </div>
    </section>


    <section class="call-to-action call-style-1">
        <div class="container">
            <div class="call-content text-center">
                <h2 class="white mar-bottom-25">Get up to <span>20% off</span> on your next travel</h2>
                <p>Choose the package you would like to offer to your clients andsend us an inquiry using the contact form.
                </p>
                <a href="#" class="btn btn-orange mar-top-20">Get It Now <i
                        class="fas fa-angle-double-right"></i></a>
            </div>
            <div class="best-services">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="wrap-best text-center">
                            <div class="icon-best mar-bottom-20">
                                <i class="fas fa-bed" aria-hidden="true"></i>
                            </div>
                            <h5 class="white mar-0">Master Bedrooms</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="wrap-best text-center">
                            <div class="icon-best mar-bottom-20">
                                <i class="fas fa-swimmer" aria-hidden="true"></i>
                            </div>
                            <h5 class="white mar-0">Pool &amp; Spa</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="wrap-best text-center">
                            <div class="icon-best mar-bottom-20">
                                <i class="fas fa-wifi" aria-hidden="true"></i>
                            </div>
                            <h5 class="white mar-0">Wifi Coverage</h5>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        <div class="wrap-best text-center">
                            <div class="icon-best mar-bottom-20">
                                <i class="fas fa-taxi" aria-hidden="true"></i>
                            </div>
                            <h5 class="white mar-0">Airport Taxi</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="rooms rooms-style2">


        <div class="container">
            <div class="section-title">
                <h2>Phòng trọ <span>nhiều lượt xem nhất</span></h2>
            </div>
            <div class="room-outer">
                <div class="row">
                    @foreach ($articlesHot as $article)
                        <div class="col-lg-3 col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <!-- Room Image -->
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $article->room->image) }}" alt="Room Image"
                                        class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 bg-dark text-white px-2 py-1 rounded">
                                        <i class="fas fa-camera"></i> 3
                                    </div>
                                </div>

                                <!-- Room Content -->
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title text-truncate mb-2" title="{{ $article->title }}">
                                        {{ $article->title }}</h5>

                                    <!-- Price and Area -->
                                    <p class="text-danger fw-bold mb-1">
                                        {{ number_format($article->room->price, 0, ',', '.') }} VNĐ &nbsp;·&nbsp;
                                        {{ $article->room->area }} m²
                                    </p>

                                    <!-- Address -->
                                    <p class="text-muted small mb-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $article->room->address ? '...' . substr($article->room->address, -20) : 'Địa chỉ chưa cập nhật' }}
                                    </p>


                                    <!-- Posted Date -->
                                    <p class="text-muted small">Đăng hôm nay</p>
                                </div>

                                <!-- Card Footer -->
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <a href="{{ route('guest.detail', $article->id) }}"
                                        class="btn btn-primary btn-sm">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>




            </div>

        </div>
    </section>

    <section class="reviews reviews-style-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="section-title title-white mar-0">
                        <h4 class="white">What People Says</h4>
                        <h2>Happy Explore <span>Reviews</span></h2>
                        <p class="mar-bottom-30">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ex neque, sodales accumsan sapien
                            et, auctor vulputate quam donec vitae
                            consectetur turpis
                        </p>
                        <a href="testimonial.html" class="btn btn-orange">View More</a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="review-slider1">
                        <div class="slider-item">
                            <div class="slider-image">
                                <img src="{{ asset('client/assets/images/review1.jpg') }}" alt="image" />
                            </div>
                            <div class="slider-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod tortor vitae nisi
                                    pharetra egestas. Sed egestas sapien libero.</p>
                                <h4>Micheal Clordy</h4>
                                <span>Germany</span>
                            </div>
                            <div class="slider-quote">
                                <img src="{{ asset('client/assets/images/review1.jpg') }}" alt="Image" />
                            </div>
                        </div>
                        <div class="slider-item">
                            <div class="slider-image">
                                <img src="{{ asset('client/assets/images/review2.jpg') }}" alt="image" />
                            </div>
                            <div class="slider-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod tortor vitae nisi
                                    pharetra egestas. Sed egestas sapien libero.</p>
                                <h4>Ketty Perry</h4>
                                <span>Australia</span>
                            </div>
                            <div class="slider-quote">
                                <img src="{{ asset('client/assets/images/icons/quote.png') }}" alt="Image" />
                            </div>
                        </div>
                        <div class="slider-item">
                            <div class="slider-image">
                                <img src="{{ asset('client/assets/images/icons/quote.png') }}" alt="image" />
                            </div>
                            <div class="slider-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod tortor vitae nisi
                                    pharetra egestas. Sed egestas sapien libero.</p>
                                <h4>Micheal Clordy</h4>
                                <span>Germany</span>
                            </div>
                            <div class="slider-quote">
                                <img src="{{ asset('client/assets/images/icons/quote.png') }}" alt="Image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>


    <section class="news news-style-1 pad-bottom-70">
        <div class="container">
            <div class="section-title">
                <h2>Latest <span>News</span></h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ex neque, sodales accumsan sapien et,
                    auctor vulputate quam donec vitae consectetur
                    turpis
                </p>
            </div>
            <div class="news-outer">
                <div class="row">
                    <div class="col-lg-8 mar-bottom-30">
                        <div class="events-list mar-bottom-30">
                            <div class="row display-flex">
                                <div class="col-lg-7 col-md-7">
                                    <div class="events-content">
                                        <div class="events-title">
                                            <div class="time-from text-center">
                                                <span class="date">25</span>
                                                <span class="maina">July</span>
                                            </div>
                                            <h4><a href="single-right.html">Why choose Hotux Hotel to travel this
                                                    summer</a></h4>
                                        </div>
                                        <div class="room-services mar-bottom-10">
                                            <ul>
                                                <li>
                                                    <a href="single-right.html"><i class="fa fa-user"
                                                            aria-hidden="true"></i> By Jack Daniels</a>
                                                </li>
                                                <li>
                                                    <a href="single-right.html"><i class="fa fa-comment"
                                                            aria-hidden="true"></i> 3 comments</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <p class="mar-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum orci nulla,
                                            fermentum in faucibus a, interdum eu nibh sapien et,
                                            auctor vulputate quam donec vitae.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="news-image">
                                        <img src="images/news12.jpg" alt="image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="events-list">
                            <div class="row display-flex">
                                <div class="col-lg-7 col-md-7">
                                    <div class="events-content">
                                        <div class="events-title">
                                            <div class="time-from text-center">
                                                <span class="date">25</span>
                                                <span class="maina">July</span>
                                            </div>
                                            <h4><a href="single-right.html">Why choose Hotux Hotel to travel this
                                                    summer</a></h4>
                                        </div>
                                        <div class="room-services mar-bottom-10">
                                            <ul>
                                                <li>
                                                    <a href="single-right.html"><i class="fa fa-user"
                                                            aria-hidden="true"></i> By Jack Daniels</a>
                                                </li>
                                                <li>
                                                    <a href="single-right.html"><i class="fa fa-comment"
                                                            aria-hidden="true"></i> 3 comments</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <p class="mar-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum orci nulla,
                                            fermentum in faucibus a, interdum eu nibh sapien et,
                                            auctor vulputate quam donec vitae travel this summer.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <div class="news-image">
                                        <img src="images/news13.jpg" alt="image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mar-bottom-30">
                        <div class="news-item">
                            <div class="news-image">
                                <img src="images/news3.jpg" alt="image" />
                            </div>
                            <div class="news-content">
                                <p class="date mar-bottom-5">16 DECEMBER 2019</p>
                                <h4><a href="single-right.html">Why choose Hotux Hotel to travel this summer</a></h4>
                                <div class="room-services mar-bottom-10">
                                    <ul>
                                        <li>
                                            <a href="single-right.html"><i class="fa fa-user" aria-hidden="true"></i> By
                                                Jack Daniels</a>
                                        </li>
                                        <li>
                                            <a href="single-right.html"><i class="fa fa-comment" aria-hidden="true"></i>
                                                3 comments</a>
                                        </li>
                                    </ul>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum orci nulla, fermentum
                                    in faucibus a, interdum eu nibh.</p>
                                <a href="single-left.html">READ MORE <i class="fas fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="footer-style-1">
        <div class="newsletter">
            <div class="container">
                <div class="section-title title-white">
                    <h2>Subscribe to our <span>Newsletter</span></h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ex neque, sodales accumsan sapien et,
                        auctor vulputate quam donec vitae consectetur
                        turpis
                    </p>
                </div>
                <div class="newsletter-form">
                    <form>
                        <input type="email" placeholder="Enter your email" />
                        <a href="#" class="btn btn-orange">SIGN UP</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-top pad-bottom-20">
            <div class="container">
                <div class="footer-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mar-bottom-30">
                            <div class="footer-about">
                                <h4>Company Info</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius tellus vitae
                                    justo blandit ultrices.</p>
                            </div>
                            <div class="footer-payment">
                                <h4>We Accept</h4>
                                <ul>
                                    <li><img src="images/icons/visa.png" alt="image" /></li>
                                    <li><img src="images/icons/mastercard.png" alt="image" /></li>
                                    <li><img src="images/icons/americanexpress.png" alt="image" /></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mar-bottom-30">
                            <div class="quick-links">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Rooms</a></li>
                                    <li><a href="#">Testimonials</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Gallery</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mar-bottom-30">
                            <div class="Rooms">
                                <h4>Rooms</h4>
                                <ul>
                                    <li><a href="#">Single Rooms</a></li>
                                    <li><a href="#">Double Rooms</a></li>
                                    <li><a href="#">Studio Rooms</a></li>
                                    <li><a href="#">Kingsize Rooms</a></li>
                                    <li><a href="#">Presidentsuite Rooms</a></li>
                                    <li><a href="#">Luxury Kings Rooms</a></li>
                                    <li><a href="#">Connecting Rooms</a></li>
                                    <li><a href="#">Murphy Rooms</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mar-bottom-30">
                            <div class="footer-contact">
                                <h4>Contact info</h4>
                                <ul>
                                    <li>Tel: 977-222-444-6666</li>
                                    <li>Email: <a href="https://htmldesigntemplates.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="a6cfc8c0c9e6cec9d2d3de88c5c9cb88c8d6">[email&#160;protected]</a>
                                    </li>
                                    <li>Fax: 977-222-444-666</li>
                                    <li>Address: 445 Mount Eden Road, Sundarbasti, Chakrapath</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="copyright-content text-center">
                    <p class="white">
                        Copyright 2019. Made with <span><a href="https://cyclonethemes.com/">Cyclone Themes</a></span>. All
                        Rights Reserved. <a href="#">Hotux</a>
                    </p>
                    <ul>
                        <li>
                            <a href="#" class="white"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="white"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="white"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#" class="white"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
