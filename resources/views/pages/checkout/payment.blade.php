@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
    </div>
    <div class="review-payment">
        <h2>Xem lại giỏ hàng</h2>
    </div>
    <div class="table-responsive cart_info">
        <?php
                    $content = Cart::content();
                    // echo '<pre>';
                    // print_r($content);
                    // echo '<pre>';
                ?>
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu" style="text-align:center">
                    {{-- <td class="image">Hình ảnh </td> --}}
                    <td class="description">Tên sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng tiền</td>
                    <td></td>
                </tr>
            </thead>
            <tbody style="text-align:center">
                @foreach ($content as $v_content)

                <tr>
                    {{-- <td class="cart_product">
                                <a href=""><img  src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}"
                    width="20" alt="" /></a>

                    </td> --}}
                    <td class="cart_description">
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$v_content->id)}}"><h5>{{$v_content->name}}</h5></a>
                    </td>
                    <td class="cart_price">
                        {{number_format($v_content->price).' '.'VND'}}
                    </td>
                    <td class="cart_quantity">
                        <form action="{{URL::to('/update-cart-quanlity')}}" method="POST">
                            {{ csrf_field() }}
                            <input style="border:none; font-weight: bold; font-size: 18px"  class="cart_quantity_input" type="text" name="cart_qty" value="{{$v_content->qty}}">
                            {{-- <input class="cart_quantity_input" type="text" name="cart_qty_update" value=""> --}}
                            <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" id="">
                            {{-- <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm"> --}}


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
                        <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i
                                class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area" style="    padding: 20px 25px 30px 0;margin-bottom: 20px">
                            <ul>
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li>Tổng Tiền <span>{{Cart::subtotal().' '.'VND'}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <h4>Chọn hình thức thanh toán</h4>
    <form action="{{URL::to('/order-place')}}" method="POST">
        {{ csrf_field() }}
        {{-- <div style="margin:40px 0; font-size: 20px" class="payment-options">
            <span>
                <label><input type="checkbox" name="payment_option" value="1"> Thanh toán qua thẻ ATM</label>
            </span>
            <span>
                <label><input type="checkbox" name="payment_option" value="2"> Thanh toán khi nhận hàng</label>
            </span>
            <span>
                <label><input type="checkbox" name="payment_option" value="3"> Thanh toán thẻ ghi nợ</label>
            </span>
            <input type="submit" value="Đặt hàng" style="width: 80px; height: 30px; margin-top: -10px" name="send_order_place" class="btn btn-primary btn-sm">
        </div> --}}

        <div style="margin:20px 10px; display: flex" class="payment-options">
            <select  name="payment_option" style="height: 40px; width: 40%">
                <option value="1" >
                    Thanh toán qua thẻ ATM
                </option>
                <option value="2" selected>
                    Thanh toán khi nhận hàng
                </option>
                <option value="3">
                    Thanh toán thẻ ghi nợ
                </option>
            </select>
            <input type="submit" value="Đặt hàng" style="width: 80px; height: 30px; font-size: 14px; margin: 5px 0 0 50px" name="send_order_place" class="btn btn-primary btn-sm">
            <button style=" width: auto; height: 30px; font-size: 14px; margin: 5px 0 0 20px; border: none; background-color: #FE980F" ><a style="color: white" href="{{URL::to('/trang-chu')}}">Tiếp tục mua sắm</a></button>
        </div>
    </form>
</section>



@endsection