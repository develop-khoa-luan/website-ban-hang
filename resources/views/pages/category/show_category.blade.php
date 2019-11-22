@extends('layout') 
@section('content')

<div class="features_items">
    <!--features_items-->
    @foreach ($category_name as $key =>$category_name_show)
    <h2 class="title text-center" style="margin-top: 10px">{{$category_name_show->category_name}}</h2>
    @endforeach
	
    @foreach($category_by_id as $key => $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                    <img  src="../public/uploads/product/{{$product->product_image}}" class="card-img-top" alt="" />
                        <h2>{{number_format($product->product_price).' '.'VND'}}</h2>
                        <p>{{$product->product_name}}</p>
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{number_format($product->product_price).' '.'VND'}}</h2>
                            <p>{{$product->product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div> --}}
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm so sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach

</div>

@endsection