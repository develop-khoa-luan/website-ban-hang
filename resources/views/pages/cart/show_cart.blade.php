@extends('layout_update')
@section('content_update')

    <meta name="_token" content="{{csrf_token()}}"/>
    <section id="cart_items">
        <div class="" style="width: 100%">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            <div class="table-responsive cart_info" style="margin: -60px 0 20px 0">
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
                            <td><img src="public/uploads/product/{{ $v_content->options->image}}" width="75"
                                     height="75">
                            </td>
                            <td class="cart_description">
                                <a href="{{URL::to('/chi-tiet-san-pham/'.$v_content->id)}}">
                                    <h5>{{$v_content->name}}</h5>
                                </a>
                            </td>
                            {{-- <td class="cart_product">
                                    <a href=""><img  src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}"
                            width="50px" height="50px" alt="" /></a>
                            </td> --}}
                            <td class="cart_price">
                                {{number_format($v_content->price).' '.'VND'}}
                            </td>
                            <td class="cart_size">&nbsp;&nbsp;{{$v_content->options->size}}
                            </td>
                            <td class="cart_quantity">
                                <input class="cart_quantity_input text-center" style="width: 50px; margin-left: 20px"
                                       type="number" min="0" max="" name="cart_qty" value="{{$v_content->qty}}">
                                <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="rowId_cart"
                                       id="">
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?php
                                    $subtotal = $v_content->price * $v_content->qty;
                                    $total_order = $total_order + $subtotal;
                                    echo number_format($subtotal, 0) . ' ' . 'VND';
                                    ?>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete"
                                   href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section id="do_action">
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
    </section>
    <div class="recommended_items col-sm-12" style="margin: -120px 0 0 0">
        <!--recommended_items-->
        <h2 class="title text-center">Gợi ý sản phẩm</h2>

        <div id="recommended-item-carousel" class="carousel slide">
            {{--id="recommended-item-carousel" class="carousel slide" data-ride="carousel" --}}
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($related_product as $key => $relate)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <input name="product_id_hidden" id="product_id" type="hidden"
                                       value="{{$relate->product_id}}"/>
                                <input name="qty" type="hidden" min="0" value="1"/>
                                <a href="{{URL::to('/chi-tiet-san-pham/'.$relate->product_id)}}">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img style="height:250px"
                                                 src="public/uploads/product/{{$relate->product_image}}"
                                                 alt=""/>
                                            <h2>{{number_format($relate->product_price).' '.'VND'}}</h2>
                                            <p><strong>{{$relate->product_name}}<strong></strong></p>
                                            <p>{{$relate->brand_name}} </p>
                                            {{-- <p>{{$product->category_name}} </p> --}}
                                            <button class="btn btn-default show-modal-product-detail"
                                                    data-toggle="modal"
                                                    data-target="#{{$relate->product_id}}-modal">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm vào giỏ hàng
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12 text-center"> {{$related_product->links()}}</div>
                </div>
            </div>
            {{-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a> --}}
        </div>
        <!-- Central Modal Medium Info -->
        <div class="modal fade" id="modal-product-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <input class="modal-product-id" id="modal-product-id" type="text" readonly hidden/>
                    <div class="col-5 col-md-7 col-lg-7 col-xl-7">
                        <img id="modal-product-image"
                             style="height:200px; width: 200px; margin-top: 30px; margin-left: 40px" alt=""/>
                    </div>
                    <!--Body-->
                    <div class="col-5 col-md-5 col-lg-5 col-xl-5">
                        <p style="font-size: 20px; margin-top: 10px" id="modal-product-name"
                           class=""></p>
                        <div class="show-notification">
                            <p style="margin-top: 10px" id="modal-product-brand"></p>
                            <p id="modal-product-category"></p>
                            <label for="product-size">Size: </label>
                            <select class="form-control modal-product-size" style="width: 85px" id="product-size">
                            </select>
                            <label for="quantity">Số lượng:</label>
                            <input style="width: 85px" class="form-control modal-product-quantity" id="quantity"
                                   name="qty"
                                   type="number" min="0" max="" value="1"/>
                        </div>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer" style="margin-top: 0; border-bottom-right-radius: 1px">
                        <a type="button" class="btn btn-primary btn-add-to-cart-modal">Thêm ngay <i
                                class="far fa-gem ml-1 text-white"></i></a>
                        <a type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 15px">Hủy </a>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <script type="text/javascript" src="{{asset('public/backend/apriori-js/jquery/jquery-1.7.2.min.js')}}"></script>
        <script>
            $('.cart_quantity_input').on('change', function (e) {
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
                    success: function (result) {
                        location.reload();
                    },
                    error: function (result) {
                        alert("Cập nhập thất bại!");
                    }
                });
            });

        </script>

        <script>
            $(document).ready(function () {
                //add-to-cart at product relate
                $('.btn-add-to-cart-relate').click(function (e) {
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
                            product_id_hidden: $(this).parent()[0].children[2].value,
                            qty: $(this).parent()[0].children[1].value
                        },
                        success: function (result) {
                            $(".count_cart").text(result.cart_count);
                            alert("Thêm sản phẩm vô giỏ hàng thành công!");
                        },
                        error: function (result) {
                            alert("Thêm sản phẩm vô giỏ hàng thất bại!");
                        }
                    });
                });

                // JS for reccomment product
                $('.show-modal-product-detail').click(function (e) {
                    $("#modal-product-detail").modal('show');

                    $.ajax({
                        url: "{{ url('/get-product') }}",
                        method: 'get',
                        data: {
                            product_id: $(this).parents()[4].children[0].value
                        },
                        success: function (data) {
                            $("#modal-product-name").text(data.product[0].product_name);
                            $("#modal-product-image").attr('src', 'public/uploads/product/' +
                                data.product[0].product_image);
                            $("#modal-product-brand").text(data.product[0].brand_name);
                            $("#modal-product-category").text(data.product[0].category_name);
                            $("#modal-product-id").val(data.product[0].product_id);
                        }
                    });
                });

                $('.show-modal-product-detail').click(function (e) {
                    var count_products_quantity = 0;
                    $.ajax({
                        url: "{{ url('/get-product-detail') }}",
                        method: 'get',
                        data: {
                            product_id: $(this).parents()[4].children[0].value
                        },
                        success: function (data) {
                            $(".option-size").remove();
                            $('.notify-message').remove();
                            var products_detail = data.product_detail;
                            products_detail.forEach(element => {
                                if (element.product_quantity > 0) {
                                    count_products_quantity = count_products_quantity + 1;
                                    var html = `<option class = "option-size" value_quantity="` + element.product_quantity + `" value="` + element.product_size + `">` + element.product_size + `</option>`;
                                    $(".modal-product-size").append(html);
                                }
                            });
                            if (count_products_quantity == 0) {
                                $('.modal-product-quantity').val("0");
                                $('.btn-add-to-cart-modal').hide();
                                var notify = `<p class="text-danger notify-message" style="font-size: 15px">Sản phẩm hết hàng!</p>`;
                                $('.show-notification').append(notify)
                            }
                            if (count_products_quantity > 0) {
                                $('.modal-product-quantity').val("1");
                                $('.btn-add-to-cart-modal').show();

                            }
                        }
                    });
                });

                $('.modal-product-quantity').keyup(function () {
                    var product_quantity = $('.option-size').attr("value_quantity");
                    var inputCustomer = $('.modal-product-quantity').val();
                    if (parseInt(inputCustomer) >= parseInt(product_quantity)) {
                        $('.modal-product-quantity').val(product_quantity);
                    }
                    if (parseInt(inputCustomer) <= 0) {
                        $('.modal-product-quantity').val("0");
                    }
                })

                $('.modal-product-quantity').change(function () {
                    var product_quantity = $('.option-size').attr("value_quantity");
                    var inputCustomer = $('.modal-product-quantity').val();
                    if (parseInt(inputCustomer) >= parseInt(product_quantity)) {
                        $('.modal-product-quantity').val(product_quantity);
                    }
                    if (parseInt(inputCustomer) <= 0) {
                        $('.modal-product-quantity').val("0");
                    }
                })

                //add-to-cart
                $('.btn-add-to-cart-modal').click(function (e) {
                    debugger;
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ url('/save-cart-with-size') }}",
                        method: 'post',
                        data: {
                            product_id_hidden: $(this).parents().find("#modal-product-id").val(),
                            qty: $(this).parents().find(".modal-product-quantity").val(),
                            product_size: $(this).parents().find(".modal-product-size").val()
                        },
                        success: function (result) {
                            $("#modal-product-detail").modal('hide');
                            $(".count_cart").text(result.cart_count);
                            location.reload();
                        },
                        error: function (result) {
                            alert("Thêm sản phẩm vô giỏ hàng thất bại!");
                        }
                    });
                });
            });

        </script>
@endsection
