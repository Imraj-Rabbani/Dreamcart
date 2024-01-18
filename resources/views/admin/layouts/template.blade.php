<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/img/favicon/favicon.ico') }}" /> --}}

    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    

    
    <link rel="stylesheet" href="{{asset('dashboard/style.css')}}">
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme ">
                <div class="app-brand demo mt-4">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-text demo fs-2 menu-text fw-bolder ms-2 ">Dreamcart</span>
                    </a>
                </div>

                {{-- MENU --}}
                <ul class="menu-inner py-1">

                    <li class="menu-item active mt-4">
                        <a href="{{route('admin.dashboard')}}" class="menu-link">
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Category</span>
                    </li>

                    <li class="menu-item">
                        <a href="{{route('add.category')}}" class="menu-link">
                            <div data-i18n="Analytics">Add Category</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{route('all.category')}}" class="menu-link">
                            <div data-i18n="Analytics">All Category</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Products</span>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Analytics">Add Product</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Analytics">All Products</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Orders</span>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Analytics">Pending Orders</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div data-i18n="Analytics">Delivered</div>
                        </a>
                    </li>
                </ul>
            </aside>

            <div class="layout-page">

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                                    aria-label="Search..." />
                            </div>
                        </div>
                    </div>
                </nav>


                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>


        </div>
    </div>

</body>

</html>
