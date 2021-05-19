

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashi | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/frontent/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/themify-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/frontent/style.css')}}" type="text/css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <!-- Page Preloder -->
    

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        hello.colorlib@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        +65 11.188.888
                    </div>
                </div>
                <div class="ht-right">
                    @if(Auth::check() && Auth::user()->email_verified_at !=null)
                    <a href="#" class="login-panel"><i class="fa fa-user"></i>{{Auth::user()->email}}</a>
                    @else
                
                    <a href="/login" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    @endif
                    <div class="lan-selector">
                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                            <option value='yt' data-image="img/flag-1.jpg" data-imagecss="flag yt"
                                data-title="English">English</option>
                            <option value='yu' data-image="img/flag-2.jpg" data-imagecss="flag yu"
                                data-title="Bangladesh">German </option>
                        </select>
                    </div>
                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="/">
                                <img src="{{asset('img/frontent/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <form id="search_form">
                                <input type="text" placeholder="What do you need?" id="da_search" value="" name="search">
                        
                                <button type="button" id="search"><i class="ti-search"></i></button>
                            </form>
                            </div>
                            <div class="searc_pop">
                                <ul class="append-area">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="/wishlist">
                                    <i class="icon_heart_alt" id="show_wishlisst"></i>
                                    <span>{{get_wishlist_count()}}</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="/cart">
                                    <i class="icon_bag_alt"></i>
                                    <span id="cart_show">{{get_cart_count()}}</span>
                                </a>
                               
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>Categories</span>
                        <ul class="depart-hover">
                           @foreach (get_all_categories() as $category)
                           <li><a href="/category/{{$category->slug}}">{{$category->category}}</a></li>
                           @endforeach
                         
                            
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li ><a href="/">Home</a></li>
                        <li><a href="/shop">Shop</a></li>
                        <li><a href="/shop">brands</a>
                            <ul class="dropdown">
                                
                                @foreach (get_all_brands() as $brand)
                                <li><a href="/{{$brand->id}}/brands">{{$brand->brand_name}}</a></li>
                                @endforeach
                                
                               
                            </ul>
                        </li>
                      
                        <li><a href="./contact.html">Contact</a></li>
                       
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->

@yield('content')
<!-- 
       Footer Section Begin -->
       <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                        <a href="#"><img src="{{asset('img/frontent/footer-logo.png')}}" alt=""></a>
                        </div>
                        @if(get_basic_details())
                        <ul>
                            <li>{{get_basic_details()->store_adress}}</li>
                            <li>{{get_basic_details()->support_number}}</li>
                            <li>{{get_basic_details()->support_email}}</li>
                        </ul>
                        @endif
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="{{asset('img/frontent/payment-method.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js" integrity="sha512-DjIQO7OxE8rKQrBLpVCk60Zu0mcFfNx2nVduB96yk5HS/poYZAkYu5fxpwXj3iet91Ezqq2TNN6cJh9Y5NtfWg==" crossorigin="anonymous"></script> -->
    <!-- Js Plugins -->
    <script src="{{asset('js/frontent/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/frontent/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/frontent/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/frontent/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('js/frontent/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/frontent/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('js/frontent/jquery.dd.min.js')}}"></script>
    <script src="{{asset('js/frontent/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/frontent/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/frontent/main.js')}}"></script>
    {{-- <script src="{{asset('js/frontent/search.js')}}"></script> --}}
    @yield('scripts')
</body>

</html>