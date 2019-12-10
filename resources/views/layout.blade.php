<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Home | E-Shopper</title>
	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
	<header id="header">
		<!--header-->
		<div class="header_top">
			<!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> (+84) 0903768379</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> 1997Store@gmail.com</a></li>
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
		</div>
		<!--/header_top-->

		<div class="header-middle">
			<!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/trang-chu')}}"><img style="width:40%" src="{{asset('public/frontend/images/logo_1997store.png')}}"
									alt="" /></a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								{{-- <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li> --}}
								<?php
									// $customer_id = Session::get('customer_id');
									// $shippping_id = Session::get('shipping_id');
									// if($customer_id != NULL && $shippping_id == NULL){
								?>
								{{-- <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh
								toán</a> --}}
								</li>
								<?php
									// }elseif ($customer_id != NULL && $shippping_id != NULL) {
										?>
								{{-- <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh
								toán</a>
								</li> --}}
								<?php
								// }else{	
								?>
								{{-- <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh
								toán</a></li> --}}
								<?php
								// }


								?>
								<li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"><sup
												class="text-danger count_cart"
												style="font-size: 17px; font-weight:bold"></sup></i> Giỏ
										hàng</a>
								</li>

								<?php
									$customer_id = Session::get('customer_id');
									if($customer_id != NULL){
								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a>
								</li>
								<?php
								}else{	
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-middle-->

		<div class="header-bottom">
			<!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse"
								data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										@foreach($category as $key => $cate)
										<li><a
												href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
										</li>
										@endforeach

									</ul>
								</li>
								<li class="dropdown"><a href="{{URL::to('/blogs')}}">Tin tức<i class="fa fa-angle-down"></i></a>
								</li>
								{{-- <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li> --}}
								<li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-5">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							{{ csrf_field() }}
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phầm..." />
								<button class="btn btn-primary" type="submit" name="search_keywords"
									style="margin: 0%; margin-left: 0%"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--/header-bottom-->
	</header>
	<!--/header-->

	<section id="slider">
		<!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					
					<div  id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							{{-- @foreach($all_slide as $key => $tt)
							<li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active" @endif></li>
							@endforeach --}}

							
							
							
							
							
							
							
							@foreach($all_slide as $key => $tt)

								@if(!empty(Session::get('category_by_id_1')))
									<?php
											$cat_tt = Session::get('category_by_id_1');
											if($cat_tt){
												
												// echo '<li data-target="#slider-carousel" data-slide-to="0" @if($key==1) class="active" @endif></li>';
												
												Session::put('category_by_id_1',null);
											
												
											}	
									?>
	
									<li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active" @endif></li>
									
								@else
									<li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active" @endif></li>
								@endif

							@endforeach			

							
						</ol>

						<div style="height:410px" class="carousel-inner">


							@foreach($all_slide as $key => $tt)
							<div style="padding-left:1px"  class="item @if($key==0) active @endif">

								@if(!empty(Session::get('category_by_id_cover')))
									<?php
											$cat_t = Session::get('category_by_id_cover');
											if($cat_t){
												
												// echo '<img style="width:100%" src="../public/uploads/product/{{$tt->slide_image}}" /> '; 
												Session::put('category_by_id_cover',null);
												
											}	
									?>
									@foreach($all_slide_cover as $key => $ttt)
									<img style="width:100%" src="../public/uploads/product/{{$ttt->slide_image}}" alt="" />	
									@endforeach
								@else
									<img style="width:100%" src="public/uploads/product/{{$tt->slide_image}}" alt="" />
								@endif
								{{-- <img style="width:100%" src="public/uploads/product/{{$tt->slide_image}}" alt="" /> --}}
							</div>
							@endforeach
							<div class="item">	
								<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
										incididunt ut labore et dolore magna
										aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div>
								<div class="col-sm-6">
									<img src="{{asset('public/frontend/images/girl2.jpg')}}" class="girl img-responsive"
										alt="" />
									<img src="{{asset('public/frontend/images/pricing.png')}}" class="pricing" alt="" />
								</div>
							</div>

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
	</section>
	<!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phâm</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-productsr-->
							<div class="panel panel-default">

								@foreach($category as $key => $cate)
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a
												href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
										</h4>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<!--/category-products-->

						<div class="brands_products">
							<!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach($brand as $key => $brand)
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span
												class="pull-right"></span>{{$brand->brand_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
						<!--/brands_products-->


						<div class="price-sort">
								
								@if(!empty(Session::get('all_product')))
                                <?php
                                        // $cat = Session::get('all_product_asc');
                                        // if($cat){
										// 	echo '<h2>Lọc theo</h2>';
										// 	echo '<div class="brands-name">
										// 		<ul style="font-weight:bold" class="nav nav-pills nav-stacked">
										// 			<li><a href="/website-online/price-home-desc"> <span class="pull-right"></span>Giá giảm dần</a></li>
										// 			<li><a href="/website-online/price-home-asc"> <span class="pull-right"></span>Giá tăng dần</a></li>
										// 		</ul>
										// 	</div>';

										// 	Session::put('all_product_asc',null);
										// }

										$sort_title = Session::get('all_product_t');
                                        if($sort_title){
											echo '<h2>Lọc theo</h2>';
											
											Session::put('all_product_t',null);
										}
										
										$cat_desc = Session::get('all_product_desc_t');
                                        if($cat_desc){
											// echo '<h2>Lọc theo</h2>';
											echo '<div class="brands-name">
												<ul style="font-weight:bold" class="nav nav-pills nav-stacked">
													<li><a href="/website-online/price-home-desc"> <span class="pull-right"></span>Giá giảm dần</a></li>
												</ul>
											</div>';
											
											Session::put('all_product_desc',null);
										}
										
										$cat_asc = Session::get('all_product_asc_t');
                                        if($cat_desc){
											// echo '<h2>Lọc theo</h2>';
											echo '<div class="brands-name">
												<ul style="font-weight:bold" class="nav nav-pills nav-stacked">
													<li><a href="/website-online/price-home-asc"> <span class="pull-right"></span>Giá tăng dần</a></li>
												</ul>
											</div>';
											
											Session::put('all_product_asc',null);
										}
										
										$cat_desc = Session::get('all_product_desc');
                                        if($cat_desc){
											echo '<h2>Lọc theo</h2>';
											echo '<div class="brands-name">
												<ul style="font-weight:bold" class="nav nav-pills nav-stacked">
													<li><a href="/website-online/price-home-desc"> <span class="pull-right"></span>Giá giảm dần</a></li>
												</ul>
											</div>';
											
											Session::put('all_product_desc',null);
										}

                                        

                                ?>
                               
                                @else
									
                                @endif

										
								{{-- <h2>Price sort1111111</h2> --}}
						</div>


						{{-- <div class="price-range">
							<!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000000"
									data-slider-step="5" data-slider-value="[200000,800000]" id="sl2"><br />
								<b class="pull-left">0 VND</b> <b class="pull-right">1.000.000 VND</b>
							</div>
						</div> --}}
						<!--/price-range-->

						<div class="shipping text-center">
							<!--shipping-->
							<img src="{{asset('public/frontend/images/shipping.jpg')}}" alt="" />
						</div>
						<!--/shipping-->
					</div>
				</div>
				<div class="col-sm-9 padding-right">

					@yield('content')

				</div>
			</div>
		</div>
	</section>

	<footer id="footer">
		<!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/iframe1.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/iframe2.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/iframe3.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{asset('public/frontend/images/iframe4.png')}}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.067502534812!2d106.77973971446636!3d10.882470492249647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d88556fa38e7%3A0x9746dea7851b826a!2zS8OtIHTDumMgeMOhIGtodSBiIMSR4bqhaSBo4buNYyBxdeG7kWMgZ2lhIEhDTQ!5e0!3m2!1svi!2s!4v1574355966020!5m2!1svi!2s" width="300" height="200px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i
										class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2019 1997Store Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">1997Store</a></span></p>
				</div>
			</div>
		</div>

	</footer>
	<!--/Footer-->
	<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
	<script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/custom-js/custom-layout.js')}}"></script>
	<script>
		$(document).ready(function(){
			$.ajax({
				type:"GET",
				url:"{{url('/count-cart')}}",
				success: function(data) {
					if(data.count_cart>0){
						$(".count_cart").text(data.count_cart);
					}
				}
			});
		});
	</script>
</body>

</html>