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
                    <ul>
                        <li>
                            <a href="{{ route('auth.login') }}" data-bs-target="#login"><i class="fa fa-user"
                                    aria-hidden="true"></i> Login</a>
                        </li>
                        <li>
                            <a href="auth.register" data-bs-target="#register"><i class="fa fa-pen"
                                    aria-hidden="true"></i> Register</a>
                        </li>
                        <li>
                            <ul class="social-links">
                                <li>
                                    <a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </li>
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
                                    @foreach ($categories as $category)
                                        <li><a href="">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>

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
