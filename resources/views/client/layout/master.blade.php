<!DOCTYPE html>
<html lang="en">
<head>
	<base href="{{ asset('/') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') | Hoàng Nhất</title>
    <!---<script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">--->
    <link href="client/css/bootstrap.min.css" rel="stylesheet">
    <link href="client/css/font-awesome.min.css" rel="stylesheet">
    <link href="client/css/prettyPhoto.css" rel="stylesheet">
    <link href="client/css/price-range.css" rel="stylesheet">
    <link href="client/css/animate.css" rel="stylesheet">
	<link href="client/css/main.css" rel="stylesheet">
	<link href="client/css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="client/js/html5shiv.js"></script>
    <script src="client/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="client/images/home/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="client/images/home/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="client/images/home/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="client/images/home/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="client/images/home/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> hoangnhat@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href=""><img src="client/images/home/logo.png" alt="" width="100" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                                @if(Auth::check())
                                    <li><a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a></li>
                                    <li><a href="./account/my-order"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                    <li><a href="./cart/"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                    <li><a href="./account/logout" class="login-panel">
                                            Đăng xuất
                                        </a></li>
                                @else
                                    <li><a href="#"><i class="fa fa-user"></i> Tài khoản</a></li>
                                    <li><a href="./account/my-order"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                    <li><a href="./cart/"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                    <li><a href="./account/login"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="./" class="{{(request()->segment(1)=='') ? 'active': ''}}">Trang chủ</a></li>
								<li class="dropdown"><a href="./products">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($categories as $categories)
                                        <li><a href="products/category/{{$categories->category_name}}">{{$categories->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="./products">Hãng sản xuất<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($brands as $brands)
                                        <li><a href="products/brand/{{$brands->name}}">{{$brands->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="./account/my-order">Đơn hàng<i></i></a></li>
								<li><a href="#">Giới thiệu<i></i></a></li>
								<li><a href="#">Tin tức</a></li>
								<li><a href="#">Liên hệ</a></li>
							</ul>
						</div>
					</div>

                    @yield('search')
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
							<div class="item active">
                                <img src="client/images/slider/slider4.png" class="girl img-responsive" alt="" />
							</div>
                            @foreach($slider as $slider)
							<div class="item">
                                <img src="client/images/slider/{{$slider->path}}" class="girl img-responsive" alt="" />
							</div>
                            @endforeach

						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Chuyên mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($categories1 as $categories)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="products/category/{{$categories->category_name}}">{{$categories->category_name}}</a></h4>
                                    </div>

                                </div>
                            @endforeach

						</div><!--/category-products-->

						<!--price-range
                            <div class="price-range">
							<h2>Mức giá</h2>
							<div class="well text-center">
								 <input type="text" class="span2" data-min-value="0" data-max-value="{{str_replace("$",'',request('data-slider-value'))}}" data-slider-min="0" data-slider-max="20" data-slider-step="5" data-slider-value="[0,20000000]" id="sl2" ><br />
								 <b class="pull-left">0tr VNĐ</b> <b class="pull-right">20tr VNĐ</b>
							</div>
                            <h2><button type="submit">Tìm</button></h2>
						</div>
                        -->
						<div class="shipping text-center"><!--shipping-->
							<img src="client/images/home/shipping.jpg" alt=""/>
						</div><!--/shipping-->

					</div>
				</div>

				<div class="col-sm-9 padding-right">



				@yield('content')



				</div>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->
        @yield('top_footer')
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Giúp đỡ online</a></li>
								<li><a href="#">Liên hệ chúng tôi</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Mua sắm nhanh</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Xe đạp trẻ em</a></li>
								<li><a href="#">Xe đạp người lớn</a></li>
								<li><a href="#">Xe đạp nam</a></li>
								<li><a href="#">Xe đạp nữ</a></li>
								<li><a href="#">Xe đạp thể thao</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Chính sách thanh toán</a></li>
								<li><a href="#">Chính sách bảo mật</a></li>
								<li><a href="#">Chính sách hoàn trả</a></li>
								<li><a href="#">Chính sách vận chuyển</a></li>
								<li><a href="#">Chính sách thanh toán</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Về chúng tôi</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thông tin công ty</a></li>
								<li><a href="#"></a></li>
								<li><a href="#">Địa chỉ đại lý</a></li>
								<li><a href="#">Giờ hoạt động</a></li>
								<li><a href="#">Bản quyền</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Hoàng Nhất</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Địa chỉ email của bạn" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Nhận thông tin cập nhật mới nhất <br />dành cho bạn...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2023 Hoang Nhat Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Nhat</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->



    <script src="client/js/jquery.js"></script>
	<script src="client/js/bootstrap.min.js"></script>
	<script src="client/js/jquery.scrollUp.min.js"></script>
	<script src="client/js/price-range.js"></script>
    <script src="client/js/jquery.prettyPhoto.js"></script>
    <script src="client/js/main.js"></script>
</body>
</html>
