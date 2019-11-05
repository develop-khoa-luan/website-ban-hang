@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container" style="width: 100%">
        <div class="breadcrumbs" >
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}" >Home</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
 
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $v_content)
                    
                    <tr>
                        {{-- <td class="cart_product">
                            <a href=""><img  src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="20"  alt="" /></a>
                           
                        </td> --}}
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).' '.'VND'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <form action="{{URL::to('/update-cart-quanlity')}}" method="POST">
                                {{ csrf_field() }}
                                <input class="cart_quantity_input" type="text" name="cart_qty" value="{{$v_content->qty}}">
                                {{-- <input class="cart_quantity_input" type="text" name="cart_qty_update" value=""> --}}
                                <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" id="">
                                <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default">
                                
                                
                            </form>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $v_content->price *  $v_content->qty;
                                    echo number_format($subtotal).' '.'VND';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        {{-- <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div> --}}
        <div class="row">

            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::subtotal().' '.'VND'}}</span></li>
                        <li>Thuế <span>{{Cart::tax().' '.'VND'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng tiền <span>{{Cart::total().' '.'VND'}}</span></li>
                    </ul>
                        <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id != NULL){
                        ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                        <?php
                        }else{	
                        ?>
                         <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                        <?php
                        }
                        ?>
                        
                </div>
            </div>
        </div>
    </div>
</section>
@endsection