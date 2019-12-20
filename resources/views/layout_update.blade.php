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
								<li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
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

		<div class="header-bottom" style="padding: 10px 0 0 0">
			<!--header-bottom-->
			<div class="container" >
				<div class="row">
					
					<div class="" style="align:right">
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

					@yield('content_update')

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
								<li><a style=" font-size:16px" href="#"><i class="fa fa-phone"></i>(+84) 97 854 2629 - (+84) 0903768379</a></li>
								<li><a style=" font-size:16px" href="#"><i class="fa fa-envelope-o"></i>1997store@gmail.com</a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-sm-2" style="padding: 0 0 0 50px">
						<div class="single-widget">
							<h2>Về chúng tôi</h2>
							<ul class="nav nav-pills nav-stacked" style="padding: 0 0 0 15px">
								<li><a style=" font-size:16px" href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
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

		<!-- Central Modal Medium Info -->
	<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <input class="modal-product-id" id="modal-product-id" type="text" readonly hidden/>
            <div class="col-5 col-md-7 col-lg-7 col-xl-7">
                <img id="modal-product-image" style="height:200px; width: 200px; margin-top: 30px; margin-left: 40px" alt="" />
            </div>
            <!--Body-->
            <div class="col-5 col-md-5 col-lg-5 col-xl-5">
                <p style="font-size: 20px; margin-top: 10px" id="modal-product-name"></p>
                <div class="">
                    <p style="margin-top: 10px" id="modal-product-brand"></p>
                    <p id="modal-product-category"></p>
                    <label for="product-size">Size: </label>
                    <select class="form-control modal-product-size" style="width: 85px" id="product-size">
                    </select>
                    <label for="quantity">Số lượng:</label>
                    <input style="width: 85px" class="form-control modal-product-quantity" id="quantity" name="qty"
                        type="number" min="0" max="" value="1" />
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer" style="margin-top: 0; border-bottom-right-radius: 1px">
                <a type="button" class="btn btn-primary btn-add-to-cart-modal">Thêm ngay <i class="far fa-gem ml-1 text-white"></i></a>
                <a type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 15px">Hủy </a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Central Modal Medium Info -->

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
		//login action
		$('.show-modal-login').click(function(e){
			$("#modal-product-detail").modal('show');
			
			$.ajax({
					url: "{{ url('/get-product') }}",
					method: 'get',
					data: {
						product_id: $(this).parents()[4].children[0].value
					},  
					success: function(data) {
						$("#modal-product-name").text(data.product[0].product_name);
						$("#modal-product-image").attr('src', '../public/uploads/product/'+data.product[0].product_image);
						$("#modal-product-brand").text(data.product[0].brand_name);
						$("#modal-product-category").text(data.product[0].category_name);
						$("#modal-product-id").val(data.product[0].product_id);
					}
				});
		});

	</script>
</body>

</html>