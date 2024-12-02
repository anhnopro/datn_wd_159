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
                        <select name="price" class="form-select">
                            <option value="">Tất cả mức giá</option>
                            <option value="1" {{ request('price') == '1' ? 'selected' : '' }}>Dưới 1 triệu</option>
                            <option value="2" {{ request('price') == '2' ? 'selected' : '' }}>1 - 3 triệu</option>
                            <option value="3" {{ request('price') == '3' ? 'selected' : '' }}>Trên 3 triệu</option>
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
                @if ($articles->count() > 0)
                    <div class="row">
                        @foreach ($articles as $article)
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
                                            {{ $article->title }}
                                        </h5>
    
                                        <!-- Price and Area -->
                                        <p class="text-danger fw-bold mb-1">
                                            {{ number_format($article->room->price, 0, ',', '.') }} VNĐ &nbsp;·&nbsp;
                                            {{ $article->room->area }} m²
                                        </p>
    
                                        <!-- Address -->
                                        <p class="text-muted small mb-1">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $article->room->address 
                                                ? '...' . substr($article->room->address, -20) 
                                                : 'Địa chỉ chưa cập nhật' }}
                                        </p>
    
                                        <!-- Posted Date -->
                                        <p class="text-muted small">Đăng hôm nay</p>
                                    </div>
    
                                    <!-- Card Footer -->
                                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <a href="{{ route('guest.detail', $article->id) }}" class="btn btn-primary btn-sm">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Không tìm thấy phòng nào phù hợp với điều kiện lọc.</p>
                @endif
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
