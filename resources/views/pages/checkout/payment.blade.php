@extends('layout_update_v2')
@section('content_update_v2')
<section id="cart_items" style="margin: -50px 0 0 0">
    <meta name="_token" content="{{csrf_token()}}" />
    <div class="" style="width:100%">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>

        </div>
    </div>

    <form action="{{URL::to('/order-place')}}" method="POST">
        {{ csrf_field() }}
        <div style="display:flex; margin: -50px 0 0">
            <div>
                @if($shipping_info != "null")
                <div class="form-one" style="width:300px; margin: -10px 0 0 15px">
                    <p style="font-weight:bold; font-size: 18px">Điền thông tin giao hàng</p>
                    <textarea name="shipping_email" style="margin: 0 0 5px 0" required="required" placeholder="Email*"
                        rows="1">{{$shipping_info->shipping_email}}</textarea>
                    <textarea name="shipping_name" style="margin: 0 0 5px 0" required="required" placeholder="Tên*"
                        rows="1">{{$shipping_info->shipping_name}}</textarea>
                    <textarea name="shipping_address" style="margin: 0 0 5px 0" required="required"
                        placeholder="Địa chỉ*" rows="1">{{$shipping_info->shipping_address}}</textarea>
                    <textarea name="shipping_phone" style="margin: 0 0 5px 0" required="required"
                        placeholder="Số điện thoại*" rows="1">{{$shipping_info->shipping_phone}}</textarea>
                    <textarea name="shipping_notes" required="required" placeholder="Ghi chú đơn hàng"
                        rows="5"></textarea>
                </div>
                @else
                <div class="form-one" style="width:300px; margin: -10px 0 0 15px">
                    <p style="font-weight:bold; font-size: 18px">Điền thông tin giao hàng</p>
                    <textarea name="shipping_email" style="margin: 0 0 5px 0" required="required" placeholder="Email*"
                        rows="1"></textarea>
                    <textarea name="shipping_name" style="margin: 0 0 5px 0" required="required" placeholder="Tên*"
                        rows="1"></textarea>
                    <textarea name="shipping_address" style="margin: 0 0 5px 0" required="required"
                        placeholder="Địa chỉ*" rows="1"></textarea>
                    <textarea name="shipping_phone" style="margin: 0 0 5px 0" required="required"
                        placeholder="Số điện thoại*" rows="1"></textarea>
                    <textarea name="shipping_notes" required="required" placeholder="Ghi chú đơn hàng"
                        rows="5"></textarea>
                </div>
                @endif
                <div style="margin: 300px 0 0 15px">
                    <h4>Chọn hình thức thanh toán</h4>

                    <?php $total_order = 0 ?>
                    <?php $after_coupon = 0 ?>

                    <select name="payment_option" style="height: 40px; width: 100%">
                        <option value="1">
                            Thanh toán qua thẻ ATM
                        </option>
                        <option value="2" selected>
                            Thanh toán khi nhận hàng
                        </option>
                        <option value="3">
                            Thanh toán thẻ ghi nợ
                        </option>
                    </select>
                    <?php
                        $content = Cart::content();       
                    ?>
                    @foreach ($content as $v_content1)
                    <?php
                        $subtotal = $v_content1->price *  $v_content1->qty;
                        $total_order = $total_order + $subtotal;
                    ?>

                    @endforeach
                    @if(!empty(Session::get('CouponAmount')))

                    <?php
                            $coupon = Session::get('CouponAmount');
                            if($coupon){
                            }

                            $after_coupon = Session::get('total_after_discount');
                            if($after_coupon){
                            
                            }
                        ?>
                    <input type="number" name="total_order" value={{$after_coupon}} hidden>
                    @else
                    <input type="number" name="total_order" value={{$total_order}} hidden>
                    @endif
                    <div>
                        <input type="submit" value="Thanh toán" style=" height: 30px; font-size: 14px;margin: 0"
                            name="send_order_place" class="btn btn-primary btn-sm">

                        <button
                            style=" width: auto; height: 30px; font-size: 14px; margin: 20px 0 20px 20px; border: none; background-color: #FE980F"><a
                                style="color: white" href="{{URL::to('/trang-chu')}}">Tiếp tục mua sắm</a></button>
                    </div>
                </div>
            </div>
            <div style="margin-left:30px">

                <div class="review-payment">

                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<div style=" margin: -30px 0 10px;">';
                            echo '<span style="color:red;  ">' .$message. '</span>';
                            echo '</div>';
                            Session::put('message',null);
                        }
                    ?>

                    <h2 style="margin: -5px 0 8px 0;font-weight:bold">Thông tin đơn hàng</h2>
                </div>
                <div class="table-responsive cart_info">
                    <?php
                    $content = Cart::content();       
                ?>
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu" style="text-align:center">
                                <td class="image"></td>
                                <td class="description">Sản phẩm</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng tiền</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody style="text-align:center">
                            <?php $total_order = 0 ?>
                            <?php $after_coupon = 0 ?>
                            @foreach ($content as $v_content)

                            <tr>
                                <td><img src="public/uploads/product/{{ $v_content->options->image}}" width="60"
                                        height="60"></td>
                                <td class="cart_description">
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.$v_content->id)}}">
                                        <p>{{$v_content->name}}</p>
                                    </a>
                                </td>
                                <td class="cart_price">
                                    <p>{{number_format($v_content->price, 0).' '.'VND'}}</p>
                                </td>
                                <td class="cart_quantity">

                                    <p style="font-size:20px">{{$v_content->qty}}</p>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        <?php
                                        $subtotal = $v_content->price *  $v_content->qty;
                                        $total_order = $total_order + $subtotal;
                                        echo number_format($subtotal, 0).' '.'VND';
                                    ?>
                                    </p>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <section id="do_action">
                    <div class="" style="width:116vh">
                        <div class="row">

                            <div class="col-sm-5">

                                <div class="chose_area" style="padding:10px 0 10px 10px">

                                    <label for="">Nhập mã khuyến mãi</label>
                                    <div style="">
                                        <input type="text" name="coupon_name" id="coupon_name" style="height: 30px">
                                        <input style="margin: -2px 0 0 0; width: 80px" value="Áp dụng"
                                            class="btn btn-primary submit-coupon-btn">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="total_area" style="padding: 20px 25px 30px 0;margin-bottom: 20px">
                                    <ul>
                                        @if(!empty(Session::get('CouponAmount')))
                                        <li>Phí vận chuyển <span>Free</span></li>
                                        <?php
                                                $total_temp = Session::get('total_amount');
                                                if($total_temp){
                                                    
                                                    echo '<li> Tổng tiền ( Tạm tính )  <span>' .number_format($total_temp,0).' '.'VND'.  ' </span> </li>';
                                                    Session::put('total_amount',null);
                                                }

                                                $coupon = Session::get('CouponAmount');
                                                if($coupon){
                                                    
                                                    echo '<li> Tiền chiết khấu  <span>' .number_format($coupon,0).' '.'VND'.  ' </span> </li>';
                                                    Session::put('CouponAmount',null);
                                                }

                                                

                                                $after_coupon = Session::get('total_after_discount');
                                                if($after_coupon){
                                                    
                                                    echo '<li> Tổng tiền  <span>' .number_format($after_coupon,0).' '.'VND'.  ' </span> </li>';
                                                    Session::put('total_after_discount',null);
                                                }
                                        ?>

                                        @else
                                        <li>Phí vận chuyển <span>Free</span></li>
                                        <li>Tổng Tiền Thanh Toán
                                            <span>{{  number_format($total_order, 0).' '.'VND'}}</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </form>
</section>
<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script>
    $('.submit-coupon-btn').click(function(e){
		e.preventDefault();
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
        });
		$.ajax({
		url: "{{ url('/apply-coupon') }}",
		method: 'post',
		data: {
			coupon_name: $('#coupon_name').val()
		},
		success: function(result){
			location.reload();
		},
		error: function(result){
			alert("Áp dụng mã giảm giá thất bại!");
        }});
        });
</script>

@endsection