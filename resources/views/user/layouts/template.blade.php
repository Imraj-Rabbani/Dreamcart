@php
    $categories = Illuminate\Support\Facades\DB::table('categories')->get();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext"
        rel="stylesheet">

</head>

<body>

    <div class="banner_bg_main">

        <div class="logo_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('home/images/logo.png') }}"
                                    style="height: 100px"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header_section">
            <div class="container">
                <div class="containt_main">

                    {{-- SIDEBAR STARTS --}}
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="{{ route('home') }}">Home</a>


                        @foreach ($categories as $category)
                            <a href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
                        @endforeach

                    </div>
                    <span class="toggle_icon" onclick="openNav()"><img
                            src="{{ asset('home/images/toggle-icon.png') }}"></span>

                    {{-- SIDEBAR ENDS --}}

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton">All
                            Category
                        </button>
                        <div class="dropdown-menu rounded bg-white mt-1" id="dropdown-menu">
                            @foreach ($categories as $category)
                                <a class="dropdown-item mb-1"
                                    href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="main">
                        <div class="input-group">
                            <input type="text" class="form-control" id="input-box" placeholder="Search Product"
                                autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button"
                                    style="background-color: #f26522; border-color:#f26522 ">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="header_box">

                        <div class="login_menu">
                            <ul>
                                <li><a href="{{ route('showcart') }}">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span class="padding_10">Cart</span></a>
                                </li>
                                @php
                                    $logged = Illuminate\Support\Facades\Auth::check();
                                @endphp
                                @if ($logged)
                                    <li class="nav-item">
                                        <a class="mx-2" href="{{ route('user.dashboard') }}">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <span class="padding_10">My Account</span></a>
                                        </a>
                                    </li>
                                    <li class="nav-item"><a class="mb-2" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    <li class="nav-item"><a class="mb-2 mx-2" href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li class="nav-item"><a class="mb-2" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            @yield('content')
        </div>

    </div>

    <div class="footer_section layout_padding">
        <div class="container">
            <div class="footer_logo"><a href="{{ route('home') }}"><img src="{{ asset('home/images/logo-2.png') }}"
                        style="height: 100px"></a>
            </div>
            <div class="input_bt">
                <input type="text" class="mail_bt" placeholder="Your Email" name="Your Email">
                <span class="subscribe_bt" id="basic-addon2"><a href="#">Subscribe</a></span>
            </div>
            <div class="footer_menu">
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Twitter</a></li>

                </ul>
            </div>
            <div class="location_main">Help Line Number : <a href="#">+1 1800 1200 1200</a></div>
        </div>
    </div>

    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">© 2024 All Rights Reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('home/js/script.js') }}"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>
