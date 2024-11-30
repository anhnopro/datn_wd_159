<!-- LOGO -->
<div class="navbar-brand-box">
    <!-- Dark Logo-->
    <a href="{{route('guest.home')}}" class="logo logo-dark">
        <span class="logo-sm">
            <img src="/admin/assets/images/logo-sm.png" alt="" height="22">
        </span>
        <span class="logo-lg">
            <img src="/admin/assets/images/logo-dark.png" alt="" height="17">
        </span>
    </a>
    <!-- Light Logo-->
    <a href="{{route('guest.home')}}" class="logo logo-light">
        <span class="logo-sm">
            <img src="/admin/assets/images/logo-sm.png" alt="" height="22">
        </span>
        <span class="logo-lg">
            <img src="/admin/assets/images/logo-light.png" alt="" height="17">
        </span>
    </a>
    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
        <i class="ri-record-circle-line"></i>
    </button>
</div>

<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route('landlord_admin.dashboard') }}" aria-expanded="false"
                    aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i>
                    <span data-key="1">Bảng điều khiển</span>
                </a>
            </li> <!-- end Dashboard Menu -->


            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarApps">
                    <i class="ri-apps-2-line"></i><span data-key="1">Quản lý Phòng</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarApps">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('landlord_admin.room.list') }}" class="nav-link">
                                Danh sách phòng
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarApps">
                    <i class="ri-apps-2-line"></i><span data-key="1">Quản lý dịch vụ phòng</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarApps">
                    <ul class="nav nav-sm flex-column">

                        <li class="nav-item">
                            <a href="{{ route('landlord_admin.service.list') }}" class="nav-link">
                                Danh sách dịch vụ
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarPages">
                    <i class="ri-pages-line"></i><span data-key="1">Quản lý tin đăng</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarPages">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('landlord_admin.article.list')}}" class="nav-link" data-key="t-starter">
                                Danh sách tin đăng
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarMaps">
                    <i class="ri-map-pin-line"></i> <span data-key="t-maps">Quản lý đặt phòng</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarMaps">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{route('landlord_admin.booking.list')}}" class="nav-link" data-key="t-google">
                                Danh sách
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="maps-vector.html" class="nav-link" data-key="t-vector">
                                Chờ xác nhận
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="maps-leaflet.html" class="nav-link" data-key="t-leaflet">
                                Đã hủy
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>

<div class="sidebar-background"></div>
