@extends('layout_update')
@section('content_update')

<meta name="_token" content="{{csrf_token()}}" />
<section id="cart_items">
    <div class="" style="width: 100%">
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
                    <tr class="cart_menu" style="text-align:center">
                        <td></td>
                        <td class="description">Sản phẩm</td>
                        {{-- <td class="img">Hình ảnh</td> --}}
                        <td class="price">Giá</td>
                        <td class="size">Size</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_order = 0 ?>
                    @foreach ($content as $v_content)
                    <tr style="text-align:center">
                        <td><img src="public/uploads/product/{{ $v_content->options->image}}" width="75" height="75"></td>
                        <td class="cart_description">
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$v_content->id)}}"><h5>{{$v_content->name}}</h5></a>
                        </td>
                        {{-- <td class="cart_product">
                                <a href=""><img  src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="50px" height="50px"  alt="" /></a>    
                        </td> --}}
                        <td class="cart_price">
                            {{number_format($v_content->price).' '.'VND'}}
                        </td>
                        <td class="cart_size">&nbsp;&nbsp;{{$v_content->options->size}}
                        </td>
                        <td class="cart_quantity">
                                <input class="cart_quantity_input" type="number" min="0" max="" name="cart_qty" value="{{$v_content->qty}}">
                                <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="rowId_cart" id="">
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
    <div class="">

        <div class="row">

            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng Tiền ( Tạm tính ) <span>{{  number_format($total_order, 0).' '.'VND'}}</span></li>
                    </ul>
                        <?php
                            $customer_id = Session::get('customer_id');
                            if($customer_id != NULL){
                        ?>
                        <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Đặt hàng</a>
                        <?php
                        }else{	
                        ?>
                         <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a>
                        <?php
                        }
                        ?>
                        
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="{{asset('public/backend/apriori-js/jquery/jquery-1.7.2.min.js')}}"></script>
<script>
$('.cart_quantity_input').on('change', function(e){
        var quantity = $(this)[0].value;
        var rowId = $(this).parent()[0].children[1].value;
        e.preventDefault();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
        });
        $.ajax({
        url: "{{ url('/update-cart-quanlity') }}",
        method: 'post',
        data: {
                cart_qty: quantity,
                rowId_cart: rowId
            },
            success: function(result){
                location.reload();
            },
            error: function(result){
                alert("Cập nhập thất bại!");
            }});
        });
</script>
@endsection