<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zxx">

<!-- Mirrored from htmldesigntemplates.com/html/hotux/bootstrap5/index-4.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 14:42:26 GMT -->

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('client/assets/images/favicon.png') }}" />

    <!-- CSS Files -->
    <link href="{{ asset('client/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/assets/css/default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('client/assets/css/plugin.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
</head>

<body>
    <div id="preloader">
        <div id="status"></div>
    </div>
    <header class="main_header_area">
        <div class="header-content">
            <div class="container">
                <div class="links links-left">
                    <ul>
                        <li>
                            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> <span
                                    class="__cf_email__"
                                    data-cfemail="2d44434b426d4542595855034e424003435d">[email&#160;protected]</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> 977-222-333-444</a>
                        </li>
                        <li>
                            <select class="wide">
                                <option>Eng</option>
                                <option>Fra</option>
                                <option>Esp</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <div class="links links-right pull-right">
                    <ul class="menu_user">
                        @if (Auth::user())
                            @if (Auth::user()->role == 2)
                                <li>
                                    {{-- <a href="{{ route('auth.logout') }}" onclick="return confirm('Bạn có chắc muốn đăng xuất?')"><i class="fa-solid fa-right-from-bracket"></i>Đăng Xuất</a> --}}
                                    <form action="{{ route('auth.logout') }}" method="POST">
                                        @csrf
                                        
                                        <button class="dropdown-item"><i
                                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>Đăng xuất</button>
                                    </form>
                                </li>
                                <li><a href="{{ route('admin.profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
                            @elseif (Auth::user()->role == 0)
                                <li>
                                    <form action="{{ route('auth.logout') }}" method="POST">
                                    @csrf
                                    
                                    <button class="dropdown-item"><i
                                            class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>Đăng xuất</button>
                                </form>
                                </li>
                                <li><a href="{{ route('guest.profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
                                <li><a href="{{ route('admin.room.list') }}"><i class="fa-solid fa-people-roof"></i>Trang Admin</a></li>
                                
                            @else

                                <li><form action="{{ route('auth.logout') }}" method="POST">
                                    @csrf
                                    
                                    <button class="dropdown-item"><i
                                            class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>Đăng xuất</button>
                                </form></li>
                                <li><a href="{{ route('guest.profile') }}"><i class="fa-solid fa-user"></i>Profile</a></li>
                                <li><a href="{{ route('landlord_admin.room.list') }}"><i class="fa-solid fa-user"></i>Quản Lý Phòng</a></li>
                            @endIf
                            
                        @else
                            <li><a href="{{ route('auth.register') }}"><i class="fa-solid fa-registered"></i>Đăng Ký</a></li>
                            <li><a href="{{ route('auth.login') }}"><i class="fa-solid fa-right-to-bracket"></i>Đăng Nhập</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="header_menu affix-top">
            <div class="container">
                <nav class="navbar navbar-default">

                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{route('guest.home')}}">
                            <img alt="Image" src="{{ asset('client/assets/images/logo.png') }}" class="logo-white" />
                            <img alt="Image" src="{{ asset('client/assets/images/logo-black.png') }}"
                                class="logo-black" />
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="responsive-menu">
                            <li class="dropdown submenu active">
                                <a href="{{ route('guest.home') }}" role="button" aria-haspopup="true"
                                    aria-expanded="false">Home</a>

                            </li>
                            <li class="submenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Loại phòng<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    {{-- php --}}
                                    @foreach ($categories as $category)
                                        <li><a href="">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            {{-- <li class="submenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Pages<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="submenu dropdown">
                                        <a href="service.html" class="dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">Service<i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="service.html">Service</a></li>
                                            <li><a href="service-detail.html">Service Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="aboutus.html" class="dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">About Us<i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="aboutus.html">About One</a></li>
                                            <li><a href="aboutus1.html">About Two</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="gallery.html" class="dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">Gallery<i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="gallery.html">Gallery 1</a></li>
                                            <li><a href="gallery1.html">Gallery 2</a></li>
                                            <li><a href="gallery2.html">Gallery Masonry</a></li>
                                            <li><a href="gallery3.html">Gallery Lightbox</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="events.html" class="dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">Events<i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="events.html">Events One</a></li>
                                            <li><a href="events1.html">Events Two</a></li>
                                            <li><a href="events-detail.html">Events Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="contact.html" class="dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">Contact Us<i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="contact.html">Contact One</a></li>
                                            <li><a href="contact1.html">Contact Two</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="404.html" class="dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">Error<i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="404.html">Error Page 1</a></li>
                                            <li><a href="404-1.html">Error Page 1</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu dropdown">
                                        <a href="comingsoon.html" class="dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">Comming Soon<i
                                                class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="comingsoon.html">Coming Soon 1</a></li>
                                            <li><a href="comingsoon-1.html">Coming Soon 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="testimonial.html">Testimonials</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                    <li><a href="faq.html">Faq</a></li>
                                    <li><a href="terms.html">Terms and Conditions</a></li>
                                </ul>
                            </li>
                            <li class="submenu dropdown">
                                <a href="restaurant.html" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">Restaurant<i
                                        class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="restaurant.html">Home</a></li>
                                    <li><a href="restaurant-about.html">About Us</a></li>
                                    <li><a href="restaurant-menu.html">Menu</a></li>
                                    <li><a href="restaurant-reserve.html">Reservation</a></li>
                                </ul>
                            </li>
                            <li class="submenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Shop<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="shop.html">Shop List</a></li>
                                    <li><a href="shop-detail.html">Shop Single</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="login.html">Account</a></li>
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                </ul>
                            </li> --}}
                            <li class="submenu dropdown">
                                <a href="blog-full.html" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Blog<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog-full.html">Blog Fullwidth</a></li>
                                    <li><a href="blog-left.html">Blog Left</a></li>
                                    <li><a href="blog-right.html">Blog Right</a></li>
                                    <li><a href="blog-masonry.html">Blog Masonry</a></li>
                                    <li><a href="single-full.html">Blog Single</a></li>
                                    <li><a href="single-left.html">Single Left</a></li>
                                    <li><a href="single-right.html">Single Right</a></li>
                                </ul>
                            </li>
                            <li class="submenu dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Tài khoản<i class="fa fa-angle-down"
                                        aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    @if (Auth::check())
                                        <!-- Hiển thị nếu người dùng đã đăng nhập -->
                                        <li><a href="dashboard/profile.html">Thông tin cá nhân</a></li>
                                        <li><a href="dashboard/appointment.html">Đặt phòng</a></li>
                                        <li><a href="dashboard/invoice.html">Hóa đơn</a></li>
                                        <li><a href="dashboard/rating.html">Đánh giá</a></li>
                                        <li><a href="{{ route('auth.logout') }}">Đăng xuất</a></li>
                                    @else
                                        <!-- Hiển thị nếu người dùng chưa đăng nhập -->
                                        <li><a href="{{ route('auth.login') }}">Đăng nhập</a></li>
                                        <li><a href="{{ route('auth.register') }}">Đăng ký</a></li>
                                    @endif
                                </ul>

                            </li>
                            <li class="dropdown submenu">
                                <a href="cart.html" class="mt_cart"><i class="fa fa-shopping-cart"></i><span
                                        class="number-cart">1</span></a>
                            </li>
                        </ul>
                        {{-- @if (Auth::user()->role === 2) --}}
                        <div class="nav-btn">
                            <a href="#" class="btn btn-orange">Book Now</a>
                        </div>
                        {{-- @endif --}}
                    </div>

                    <div id="slicknav-mobile"></div>
                </nav>
            </div>

        </div>

    </header>
