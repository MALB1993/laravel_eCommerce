<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/home/assets/img/favicon.png" />

    <!-- CSS
============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/home/assets/css/bootstrap.min.css" />
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/home/assets/css/icons.min.css" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/home/assets/css/plugins.css" />
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="/home/assets/css/style.css" />
    <!-- Modernizer JS -->
    <!-- <script src="/home/assets/js/vendor/modernizr-2.8.3.min.js"></script> -->
    @yield('stylesheet')
</head>

<body>
    <div class="wrapper">

        {{-- header --}}
        @include('home.sections.header')
        @include('home.sections.mobileCanvas')

        @yield('content')

        {{-- footer --}}
        @include('home.sections.footer')

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
                                <div class="product-details-content quickview-content">
                                    <h2 class="text-right mb-4">لورم ایپسوم</h2>
                                    <div class="product-details-price">
                                        <span>
                                            50,000
                                            تومان
                                        </span>
                                        <span class="old">
                                            75,000
                                            تومان
                                        </span>
                                    </div>
                                    <div class="pro-details-rating-wrap">
                                        <div class="pro-details-rating">
                                            <i class="sli sli-star yellow"></i>
                                            <i class="sli sli-star yellow"></i>
                                            <i class="sli sli-star yellow"></i>
                                            <i class="sli sli-star"></i>
                                            <i class="sli sli-star"></i>
                                        </div>
                                        <span>3 دیدگاه</span>
                                    </div>
                                    <p class="text-right">
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها
                                        و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است
                                    </p>
                                    <div class="pro-details-list text-right">
                                        <ul class="text-right">
                                            <li>- لورم ایپسوم</li>
                                            <li>- لورم ایپسوم متن ساختگی</li>
                                            <li>- لورم ایپسوم متن</li>
                                        </ul>
                                    </div>
                                    <div class="pro-details-size-color text-right">
                                        <div class="pro-details-size">
                                            <span>سایز</span>
                                            <div class="pro-details-size-content">
                                                <ul>
                                                    <li><a href="#">s</a></li>
                                                    <li><a href="#">m</a></li>
                                                    <li><a href="#">l</a></li>
                                                    <li><a href="#">xl</a></li>
                                                    <li><a href="#">xxl</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                                value="2" />
                                        </div>
                                        <div class="pro-details-cart">
                                            <a href="#">افزودن به سبد خرید</a>
                                        </div>
                                        <div class="pro-details-wishlist">
                                            <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                        </div>
                                        <div class="pro-details-compare">
                                            <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                        </div>
                                    </div>
                                    <div class="pro-details-meta">
                                        <span>دسته بندی :</span>
                                        <ul>
                                            <li><a href="#">مردانه,</a></li>
                                            <li><a href="#">پالتو</a></li>
                                        </ul>
                                    </div>
                                    <div class="pro-details-meta">
                                        <span>تگ ها :</span>
                                        <ul>
                                            <li><a href="#">لباس, </a></li>
                                            <li><a href="#">Furniture,</a></li>
                                            <li><a href="#">Electronic</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="/home/assets/img/product/quickview-l1.svg" alt="" />
                                    </div>
                                    <div id="pro-2" class="tab-pane fade">
                                        <img src="/home/assets/img/product/quickview-l2.svg" alt="" />
                                    </div>
                                    <div id="pro-3" class="tab-pane fade">
                                        <img src="/home/assets/img/product/quickview-l3.svg" alt="" />
                                    </div>
                                    <div id="pro-4" class="tab-pane fade">
                                        <img src="/home/assets/img/product/quickview-l2.svg" alt="" />
                                    </div>
                                </div>
                                <!-- Thumbnail Large Image End -->
                                <!-- Thumbnail Image End -->
                                <div class="quickview-wrap mt-15">
                                    <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                        <a class="active" data-toggle="tab" href="#pro-1"><img
                                                src="/home/assets/img/product/quickview-s1.svg" alt="" /></a>
                                        <a data-toggle="tab" href="#pro-2"><img
                                                src="/home/assets/img/product/quickview-s2.svg" alt="" /></a>
                                        <a data-toggle="tab" href="#pro-3"><img
                                                src="/home/assets/img/product/quickview-s3.svg" alt="" /></a>
                                        <a data-toggle="tab" href="#pro-4"><img
                                                src="/home/assets/img/product/quickview-s2.svg" alt="" /></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->

    </div>

    <!-- All JS is here
============================================ -->

    <!-- jQuery JS -->
    <script src="/home/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Popper JS -->
    <script src="/home/assets/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/home/assets/js/bootstrap.min.js"></script>
    <!-- Plugins JS -->
    <script src="/home/assets/js/plugins.js"></script>
    <!-- Ajax Mail -->
    <script src="/home/assets/js/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="/home/assets/js/main.js"></script>
    @yield('javascript')
</body>

</html>
