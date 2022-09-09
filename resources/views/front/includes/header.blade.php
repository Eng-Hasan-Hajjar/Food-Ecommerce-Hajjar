<!doctype html>
<html lang="ar">
<head>
    <title>sofra</title>
    <meta charset="utf-8">
    @yield('head')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('front/librarys/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('front/librarys/all.css')}}">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/librarys/slick/slick.css')}}"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{asset('front/librarys/slick/slick-theme.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <!-- data Tables -->
    <link rel="stylesheet" href="{{url('adminlte')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    @stack('css')

</head>
<body>
<!-- start nav  -->
<header>
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h5 class="text-white h4">Collapsed content</h5>
                <span class="text-muted">Toggleable via the navbar brand.</span>
            </div>
        </div>
        <nav>

            <div class="container">
                <div class="row d-flex ">
                    <div class="d-flex pt-sm-4 icon-nav col col-sm-4 col-9 text-rightt">
                        @check()
                        <a href="{{url('/cart')}}" class="flex-fill pt-2">
                            <div class="d-inline-block num-shopping ">
                                <span>{{ session()->has('cart') ? session()->get('cart')->totalQty : 0  }}</span>
                            </div>

                            <i class=" align-fill fas fa-shopping-cart"></i>
                        </a>
                        @endcheck
                        <div class="flex-fill  pr-sm-5">
                            @guest()
                                <div class="btn-group">
                                    <button class="btn  dropdown-toggle" data-toggle="dropdown">
                                        <span><i class="fas pb-2 icon-menu  fa-sign-in-alt"></i></span>
                                    </button>

                                    <div class="dropdown-menu mt-5 ">
                                        <ul class="list-unstyled p-0 text-right m-0">
                                            <h6 class="px-4">تسجيل الدخول </h6>
                                            <li>
                                                <span><i class="fas  fa-hamburger"></i></span>
                                                <a class="d-inline dropdown-item" href="{{url('resturant/login')}}">كبائع</a>
                                            </li>
                                            <li>
                                                <span><i class="fas  fa-user"></i></span>
                                                <a class="d-inline dropdown-item" href="{{url('login')}}">كمشتري</a>
                                            </li>

                                        </ul>
                                    </div>

                                </div>
                            @endguest
                            @auth()
                            <!-- Example single danger button -->
                                <div class="btn-group @auth('resturant') float-right pt-3 @endauth">
                                    <button class="btn  dropdown-toggle" data-toggle="dropdown">
                                        <span><i class="fas pb-2 icon-menu  fa-user-circle"></i></span>
                                        {{auth()->user()->name}}
                                    </button>
                                    <div class="dropdown-menu mt-5 ">
                                        <ul class="list-unstyled p-0  text-right m-0">
                                        @auth('resturant')
                                            <!-- product resturant -->
                                                <li>
                                                    <span><i class="fas  fa-shopping-bag"></i></span>
                                                    <a class="d-inline dropdown-item" href="{{url('resturant')}}">منتجاتي</a>
                                                </li>
                                                <!-- offer resturant -->
                                                <li>
                                                    <span><i class="fas fa-gift"></i></span>
                                                    <a class="d-inline dropdown-item" href="{{url('resturant/offer')}}">عروضي </a>
                                                </li>
                                                <!-- order resturant -->
                                                <li>
                                                    <span><i class="fas  fa-sticky-note"></i></span>
                                                    <a class="d-inline dropdown-item" href="{{route('new')}}">الطلبات
                                                        المقدمة</a>
                                                </li>
                                                <!-- commission resturant -->
                                                <li>
                                                    <span><i class="fas  fa-calculator"></i></span>
                                                    <a class="d-inline dropdown-item" href="{{route('commission')}}">العمولة</a>
                                                </li>

                                                <li>
                                                    <span><i class="fas  fa-user"></i></span>
                                                    <a class="d-inline dropdown-item" href="{{url('resturant/edit')}}">حسابي</a>
                                                </li>
                                                <li>
                                                    <span><i class="fas fa-users"></i></span>
                                                    <a class="d-inline dropdown-item"
                                                       href="{{url('resturant/employee')}}">وظائف</a>
                                                </li>

                                            @endauth
                                            @auth('web')
                                                <li>
                                                    <span><i class="fas fa-gift"></i></span>
                                                    <a class="d-inline dropdown-item" href="{{url('offers')}}">العروض
                                                        الجديده </a>
                                                </li>
                                                <li>
                                                    <span><i class="fas  fa-sticky-note"></i></span>
                                                    <a class="d-inline dropdown-item" href="{{route('newOrder')}}">الطلبات </a>
                                                </li>
                                                <li>
                                                    <span><i class="fas  fa-user"></i></span>
                                                    <a class="d-inline dropdown-item"
                                                       href="{{url('profile')}}">حسابي</a>
                                                </li>
                                            @endauth
                                            <li>
                                                <span><i class="fas  fa-envelope-square"></i></span>
                                                <a class="d-inline dropdown-item" href="{{url('contact-us')}}">تواصل
                                                    معنا</a>
                                            </li>
                                            <li>
                                                <span><i class="fas fa-sign-out-alt"></i></span>
                                                <a class="d-inline dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                            @endauth
                        </div>
                        @check()
                        <span class="flex-fill pt-2 pr-sm-4">
                            <form method="get" action="{{url('search-product')}}">
                                @csrf
                                 <div class="icon pl-3">
                                    <span class="pl-1"><button type="submit"><li class="fa fa-search"></li></button></span>
                                    <input name="product" class=" input-img form-control" type="text"
                                           placeholder="ابحث عن منتج">
                                </div>
                            </form>
                        </span>
                        @endcheck
                    </div>


                    <div class=" text-center order-sm-2 order-3 col col-sm-4 col-12 img"><img
                            src="{{asset('front/images/sofra logo-1.png')}}"></div>
                    <div class="pt-sm-4 col col-sm-4 order-2 col-3">
                        <button class="navbar-toggler icon-color collapsed" type="button" data-toggle="collapse"
                                data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="p-sm-2 mt-2 d-inline-block"><i class=" fas fa-hamburger"></i></span>
                        </button>
                    </div>
                </div>
                <div class="navbar-collapse collapse" id="navbarsExample01">
                    <ul class="navbar-nav text-right mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link hvr-rotate " href="{{url('/')}}">الرئيسية <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        @check()
                        <li class="nav-item">
                            <a class="nav-link hvr-rotate" href="{{url('job')}}">الوظائف</a>
                        </li>
                        @endcheck
                    </ul>
                </div>

            </div>
        </nav>
    </div>
</header>
