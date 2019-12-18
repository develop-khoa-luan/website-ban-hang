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
								<li><a href="#"><i class="fa fa-phone"></i> (+84) 97 854 2629 - (+84) 90 376 8379</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> 1997store@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube"></i></a></li>
							
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
				<div class="row" style="padding: 10px 0 0 0">
					<div class="">
						<div class="logo pull-left">
							<a href="{{URL::to('/trang-chu')}}"><img style="width:50%; margin:-10px" src="{{asset('public/frontend/images/logo_1997store.png')}}"
											alt="" /></a>
						</div>
					</div>
					<div class="mainmenu pull-left" style="margin: 10px 0 0 -150px">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="{{URL::to('/trang-chu')}}" >Trang chủ</a></li>
							<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									@foreach($category as $key => $cate)
										<li><a
											href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
										</li>
									@endforeach
		
								</ul>
							</li>
							<li class="dropdown"><a href="{{URL::to('/blogs')}}">Tin tức</a>
							</li>
								
							<li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
						</ul>
					</div>
		
					<div class="">
								
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
										
								<li ><a style="font-size:16px" href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"><sup
														class="text-danger count_cart"
														style="font-size: 17px; font-weight:bold"></sup></i> Giỏ
												hàng</a>
								</li>
		
								<?php
									$customer_id = Session::get('customer_id');
									if($customer_id != NULL){
								?>
								<li><a style="font-size:16px" href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a>
								</li>
									<?php
									}else{	
									?>
									<li><a style="font-size:16px" href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a>
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

		<div class="header-bottom" style="padding: 10px 0 5px 0">
			<!--header-bottom-->
			<div class="container">
				<div class="row">
					{{-- <div class="col-sm-7">
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
					
								<li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
							</ul>
						</div>
					</div> --}}
					<div class="" style="align:right; margin-right:15px">
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

							@foreach($all_slide as $key => $tt)					
									<li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active" @endif></li>
							@endforeach			
					
						</ol>

						<div style="height:410px" class="carousel-inner">

							@foreach($all_slide as $key => $tt)
							<div style="padding-left:1px"  class="item @if($key==0) active @endif">

									<img style="width:100%" src="public/uploads/product/{{$tt->slide_image}}" alt="" />
													
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
	</section>
	<!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
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
                                       

										$sort_title = Session::get('all_product_t');
                                        if($sort_title){
											echo '<h2>Lọc theo</h2>';
											echo '<div class="brands-name">
												<ul style="font-weight:bold" class="nav nav-pills nav-stacked">
													<li><a href="/website-online/price-home-desc"> <span class="pull-right"></span>Giá giảm dần</a></li>
													<li><a href="/website-online/price-home-asc"> <span class="pull-right"></span>Giá tăng dần</a></li>
												</ul>
											</div>';
											
											Session::put('all_product_t',null);
										}
										
									
										
										$cat_desc_t = Session::get('all_product_desc');
                                        if($cat_desc_t){
											echo '<h2>Lọc theo</h2>';
											echo '<div class="brands-name">
												<ul style="font-weight:bold" class="nav nav-pills nav-stacked">
													<li><a href="/website-online/price-home-desc"> <span class="pull-right"></span>Giá giảm dần</a></li>
													<li><a href="/website-online/price-home-asc"> <span class="pull-right"></span>Giá tăng dần</a></li>
												</ul>
											</div>';
											
											Session::put('all_product_desc',null);
										}

										$cat_asc_t = Session::get('all_product_asc');
                                        if($cat_asc_t){
											echo '<h2>Lọc theo</h2>';
											echo '<div class="brands-name">
												<ul style="font-weight:bold" class="nav nav-pills nav-stacked">
													<li><a href="/website-online/price-home-desc"> <span class="pull-right"></span>Giá giảm dần</a></li>
													<li><a href="/website-online/price-home-desc"> <span class="pull-right"></span>Giá tăng dần</a></li>

												</ul>
											</div>';
											
											Session::put('all_product_asc',null);
										}

                                        

                                ?>
                               
                                @else
									
                                @endif

									
						</div>

					
						<div style="margin: 30px 0 50px 0">
							
							<h2>Sản phẩm bán chạy</h2>
							<div  id="slider-carousel" class="carousel slide" data-ride="carousel">
		
								<div style="height:auto" class="carousel-inner">
		
									@foreach($selling_product as $key => $sell)
									<div style="padding-left:1px;height:300px"  class="item @if($key==0) active @endif">
										<a href="{{URL::to('/chi-tiet-san-pham/'.$sell->product_id)}}">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="height:220px;width:100%" src="public/uploads/product/{{$sell->product_image}}" alt="" />
													<h2>{{number_format($sell->product_price).' '.'VND'}}</h2>
													<p style="margin:-25px 0 0 0"><strong>{{$sell->product_name}}</strong></p>
												</div>
											</div>
										</a>				
									</div>
									@endforeach
	
								</div>
									
							</div>
								
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

			</div>
		</div>

		<div class="footer-widget" style="margin-bottom:20px">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Thông tin liên hệ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a style=" font-size:16px" href="#"><i class="fa fa-map-marker"></i>KTX Khu B - ĐHQG TPHCM,<br> Đông Hòa, Dĩ An, Bình Dương</a></li>
								<li><a style=" font-size:16px" href="#"><i class="fa fa-phone"></i>(+84) 97 854 2629 - (+84) 90 376 8379</a></li>
								<li><a style=" font-size:16px" href="#"><i class="fa fa-envelope-o"></i>1997store@gmail.com</a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-sm-2" style="padding: 0 0 0 50px">
						<div class="single-widget">
							<h2>Về chúng tôi</h2>
							<ul class="nav nav-pills nav-stacked" style="padding: 0 0 0 15px">
								<li><a style=" font-size:16px" href="#">Trang chủ</a></li>
								<li><a style=" font-size:16px" href="{{URL::to('/blogs')}}">Tin tức</a></li>	
								<li><a style=" font-size:16px" href="{{URL::to('/contact')}}">Liên hệ</a></li>
							</ul>
							
						</div>
					</div>

					<div class="col-sm-2" style="padding: 0 0 0 80px">
						<div class="single-widget">
							<h2>Mạng xã hội</h2>
							<ul style="padding: 0 0 0 10px" class="nav nav-pills nav-stacked">
								<li style="display:flex"><a style="font-size:22px" href="#"><i class="fa fa-facebook"></i></a>
									<a style="font-size:22px" href="#"><i class="fa fa-instagram"></i></a>
									<a style="font-size:22px" href="#"><i class="fa fa-youtube"></i></a>
								</li>
								
							</ul>
								
						</div>
					</div>

					<div class="col-sm-3 col-sm-offset-1" style="padding: 0 0 0 20px">
						<div class="single-widget">
							<h2>Bản đồ cửa hàng</h2>
							<div class="address">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.067502534812!2d106.77973971446636!3d10.882470492249647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d88556fa38e7%3A0x9746dea7851b826a!2zS8OtIHTDumMgeMOhIGtodSBiIMSR4bqhaSBo4buNYyBxdeG7kWMgZ2lhIEhDTQ!5e0!3m2!1svi!2s!4v1574355966020!5m2!1svi!2s" width="300" height="200px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
							</div>
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