@extends('layout')
@section('content')

<div class="features_items">
	<!--features_items-->
	<meta name="_token" content="{{csrf_token()}}" />
	<h2 class="title text-center" style="margin-top: 10px">Sản phẩm mới</h2>
	@foreach($all_product as $key => $product)
	<form>
		<div class="col-sm-4">
			<div class="product-image-wrapper">
				<input name="product_id_hidden" type="hidden" value="{{$product->product_id}}" />
				<input name="qty" type="hidden" min="0" value="1" />
				<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
					<div class="single-products">
						<div class="productinfo text-center">
							<img style="height:250px" src="public/uploads/product/{{$product->product_image}}" alt="" />
							<h2>{{number_format($product->product_price).' '.'VND'}}</h2>
							<p><strong>{{$product->product_name}}<strong></strong></p>
							<p>{{$product->brand_name}} </p>
            				{{-- <p>{{$product->category_name}} </p> --}}
							<button class="btn btn-default show-modal" data-toggle="modal"
								data-target="#{{$product->product_id}}-modal">
								<i class="fa fa-shopping-cart"></i>
								Thêm vào giỏ hàng
							</button>
						</div>
					</div>
				</a>

			</div>
		</div>
	</form>
	<!-- Central Modal Medium Info -->
	<div class="modal fade" id="{{$product->product_id}}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-notify modal-info" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<p style="font-size: 30px">{{$product->product_name}}</p>
				</div>
				<!--Body-->
				<div class="modal-body">
					<div class="text-center">
						<img style="height:250px" src="public/uploads/product/{{$product->product_image}}" alt="" />
						<p style="margin-top: 10px">{{$product->brand_name}} </p>
            			<p>{{$product->category_name}} </p>
					</div>
				</div>

				<!--Footer-->
				<div class="modal-footer justify-content-center">
					<a type="button" class="btn btn-primary">Buy now <i class="far fa-gem ml-1 text-white"></i></a>
					<a type="button" class="btn btn-primary">Get it now <i class="far fa-gem ml-1 text-white"></i></a>
					<a type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 15px">No, thanks</a>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>
	<!-- Central Modal Medium Info -->
	@endforeach
</div>

<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script>
	$(document).ready(function(){
		$('.btn-add-to-cart').click(function(e){
			e.preventDefault();
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
		});
		$.ajax({
		url: "{{ url('/save-cart') }}",
		method: 'post',
		data: {
			product_id_hidden: $(this).parents()[3].children[0].value,
			qty: $(this).parents()[3].children[1].value
		},
		success: function(result){
			$(".count_cart").text(result.cart_count);
			debugger;
			alert("Thêm sản phẩm vô giỏ hàng thành công!");
		},
		error: function(result){
			alert("Thêm sản phẩm vô giỏ hàng thất bại!");
		}});
		});
		});
</script>
<!--features_items-->

{{--

<!--/category-tab-->--}} {{--
<div class="recommended_items">
	<!--recommended_items-->
	<h2 class="title text-center">recommended items</h2>

	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="public/frontend/images/recommend1.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="public/frontend/images/recommend2.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="public/frontend/images/recommend3.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="public/frontend/images/recommend1.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="public/frontend/images/recommend2.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="public/frontend/images/recommend3.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
		<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>
	</div>
</div>
<!--/recommended_items-->--}}
@endsection