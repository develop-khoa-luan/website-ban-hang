@extends('layout_update')
@section('content_update')
<div id="contact-page" class="container" style="width:100%">
    <meta name="_token" content="{{csrf_token()}}" />
    <div class="bg">
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Quản lý thông tin</h2>
                    <?php
                        $message = Session::get('message_change_detail_customer');
                        if($message){
                        echo '<div class="status-change alert alert-success">'.$message.'</div>';
                        Session::put('message_change_detail_customer',null);
                        }
                     ?>
                    <div class="form-group col-md-12">
                        <label for="customer_email" style="font-size: 15px">Email:</label>
                        <input type="text" name="customer_email" id="customer_email" class="form-control"
                            required="required" readonly placeholder="Email" value="{{$view_customer->customer_email}}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="customer_name" style="font-size: 15px">Tên:</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control"
                            required="required" placeholder="Tên" value="{{$view_customer->customer_name}}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="customer_phone" style="font-size: 15px">Số điện thoại:</label>
                        <input type="text" name="customer_phone" id="customer_phone" class="form-control"
                            required="required" placeholder="Số điện thoại" value="{{$view_customer->customer_phone}}">
                    </div>
                    <div class="show-change-password"></div>
                    <div class="form-group col-md-12">
                        <a class="change-password">Thay đổi mật khẩu!</a>
                    </div>
                    <div class="form-group col-md-12">
                        <a class="dischange-password">Hủy thay đổi!</a>
                    </div>
                    <div class="row pull-right">
                        <div class="form-group col-md-6">
                            <input type="button" class="btn btn-primary btn-change-detail" value="Cập nhật">
                        </div>
                        <div class="form-group col-md-6">
                            <a href="{{URL::to('/trang-chu')}}" style="background-color: crimson"
                                class="btn btn-primary"> Hủy</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-form">
                    <h2 class="title text-center">Lịch sử mua hàng</h2>
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th>Mã HD</th>
                            <th>Ngày Mua Hàng</th>
                            <th>Trạng thái đơn hàng</th>
                        </tr>
                        @foreach ($all_order as $item)
                        <tr>
                            <td><a href="#" class="show-modal-order-detail">HD{{$item->order_id}}</a> <input type="text"
                                    value="{{$item->order_id}}" class="order-id" hidden readonly></td>
                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                            <td>{{$item->order_status}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-order-detail" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!--Header-->
            {{-- <input class="modal-product-id" id="modal-product-id" type="text" > --}}
            <div style="font-size:20px; margin: 5px 0 5px"
                class="card-header  text-primary border-botton border-primary text-center">
                <b>THÔNG TIN ĐƠN HÀNG</b>
            </div>
            <!--Body-->
            <div class="col-12 col-sm-6 col-md-6">
                <div style="font-size:16px; margin: 5px 0 5px"
                    class="card-header text-primary border-botton border-primary text-center">
                    THÔNG TIN KHÁCH HÀNG
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Tên khách hàng:
                </div>
                <div class="col-sm-12 text-dark" id="modal-cus-name">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Email:
                </div>
                <div class="col-sm-12 text-dark" id="modal-cus-email">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Số điện thoại:
                </div>
                <div class="col-sm-12 text-dark" id="modal-cus-phone">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Ngày đặt đơn:
                </div>
                <div class="col-sm-12 text-dark" id="modal-order-created">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Tình trạng đơn:
                </div>
                <div class="col-sm-12 text-dark" id="modal-order-status">
                </div>

            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div style="font-size:16px; margin: 5px 0 5px"
                    class="card-header text-primary border-botton border-primary text-center">
                    THÔNG TIN GIAO HÀNG
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Tên người nhận:
                </div>
                <div class="col-sm-12 text-dark" id="modal-ship-name">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Số điện thoại:
                </div>
                <div class="col-sm-12 text-dark" id="modal-ship-phone">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Địa chỉ giao:
                </div>
                <div class="col-sm-12 text-dark" id="modal-ship-address">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Ghi chú:
                </div>
                <div class="col-sm-12 text-dark" id="modal-ship-notes">
                </div>

                <div class="col-sm-12 text-danger" style="margin: 0 0 0 -20px">
                    Tổng tiền:
                </div>
                <div class="col-sm-12 text-dark" id="modal-order-total">
                </div>
            </div>
            <div style="paddi">
                <table class="table table-bordered m-4" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th class="text-primary">Tên sản phẩm</th>
                            <th class="text-primary">Số lượng</th>
                            <th class="text-primary">Size</th>
                            <th class="text-primary">Giá</th>
                            <th class="text-primary">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody class="show-oder-detail">
                    </tbody>
                </table>
            </div>
            <!--Footer-->
            <div class="modal-footer show-button-delete-order" style="margin-top: 0; border-bottom-right-radius: 1px">
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
</section>
<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script>
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    //action show modal order-detail
    $(document).ready(function () {
        $('.show-modal-order-detail').on('click', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('/cus-view-order') }}",

                method: 'post',
                data: {
                    order_id: $(this).parent().children()[1].value
                },
                success: function (result) {
                    $('#modal-order-detail').modal('show');
                    data1 = result.order_by_id;
                    $("#modal-cus-name").text(data1.customer_name);
                    $("#modal-cus-email").text(data1.customer_email);
                    $("#modal-cus-phone").text(data1.customer_phone);
                    $("#modal-order-created").text(data1.created_at);
                    $("#modal-order-status").text(data1.order_status);
                    $("#modal-ship-name").text(data1.shipping_name);
                    $("#modal-ship-phone").text(data1.shipping_phone);
                    $("#modal-ship-address").text(data1.shipping_address);
                    $("#modal-ship-notes").text(data1.shipping_notes);
                    $("#modal-order-total").text(formatNumber(data1.order_total)+" VNĐ");
                    data2 = result.order_detail;
                    var rows = "";
                    $('.row-for-order-detail').remove();
                    data2.forEach(element => {
                        rows = rows + `
                                            <tr class="row-for-order-detail">
                                                <td class="text-dark">` + element.product_name + `</td>
                                                <td class="text-dark">` + element.product_sales_quantity + `</td>
                                                <td class="text-dark">` + element.product_size + `</td>
                                                <td class="text-dark">` + formatNumber(element.product_price) + `</td>
                                                <td class="text-dark">` + formatNumber(parseFloat(element.product_price) *
                            parseFloat(element.product_sales_quantity)) + `</td>
                                            </tr>
                                            `
                    });
                    $('.show-oder-detail').append(rows);
                    $('.btn-delete-order').remove();
                    if (data1.order_status == 'Đang chờ xử lý') {
                        var button =
                            `<a type="button" href="{{ url('/cus-delete-order/`+data1.order_id+`') }}" class="btn btn-danger btn-delete-order" style="margin-top: 15px">Hủy đơn hàng</a>
                            <a type="button" class="btn btn-primary btn-delete-order" data-dismiss="modal" style="margin-top: 15px">Đóng</a>`;
                        $('.show-button-delete-order').append(button);
                    }else{
                        var button =
                            `<a type="button" class="btn btn-primary btn-delete-order" data-dismiss="modal" style="margin-top: 15px">Đóng</a>`;
                        $('.show-button-delete-order').append(button);
                    }
                },
                error: function (result) {
                    alert("Không thành công!");
                }
            });
        });
    })
    //action change info customer
    var changePassword = "no";
    $('.search_box').hide();
    $('.dischange-password').hide();
    $('.change-password').on('click', function () {
        let html = `<div class="form-group col-md-12 password-field">
                        <label for="customer_password" style="font-size: 15px">Mật khẩu cũ:</label>
                        <input type="password" name="customer_ex_password" id="customer_ex_password" class="form-control" required="required"
                            placeholder="Mật Khẩu cũ" value="">
                    </div>
                    <div class="form-group col-md-12 password-field">
                        <label for="customer_password" style="font-size: 15px">Mật khẩu mới:</label>
                        <input type="password" name="customer_new_password" id="customer_new_password" class="form-control" required="required"
                            placeholder="Mật Khẩu mới" value="">
                    </div>

                    <div class="form-group col-md-12 password-field">
                        <label for="customer_password" style="font-size: 15px">Nhập lại mật khẩu:<span style="font-size: 10px" class="text-danger not_the_same"></span></label>
                        <input type="password" name="customer_retype_password" id="customer_retype_password" class="form-control customer_retype_password" required="required"
                            placeholder="Nhập lại mật Khẩu" value="">
                    </div>`;
        $('.password-field').remove();
        $('.change-password').hide();
        $('.show-change-password').append(html);
        $('.dischange-password').show();
        changePassword = "yes";
    });
    $('.dischange-password').on('click', function () {
        changePassword = "no";
        $('.password-field').remove();
        $('.change-password').show();
        $('.dischange-password').hide();
    });

    $('.btn-change-detail').click(function (e) {
        var email = $('#customer_email').val();
        var name = $('#customer_name').val();
        var phone = $('#customer_phone').val();
        var ex_password = $('#customer_ex_password').val();
        var new_password = $('#customer_new_password').val();
        var retype_password = $('#customer_retype_password').val();
        if (new_password != retype_password) {
            $('.not_the_same').text(' Mật khẩu không khớp, vui lòng nhập lại!');
        } else {
            $('.not_the_same').text('');
            if (changePassword === "no") {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/update-customer') }}",
                    method: 'post',
                    data: {
                        customer_email: email,
                        customer_name: name,
                        customer_phone: phone,
                        change_password: 'no',
                        customer_ex_password: 'no',
                        customer_new_password: 'no'
                    },
                    success: function (result) {
                        location.reload();

                    },
                    error: function (result) {
                        alert("Không thành công!");
                    }
                });
            }
            if (changePassword === "yes") {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/update-customer') }}",
                    method: 'post',
                    data: {
                        customer_email: email,
                        customer_name: name,
                        customer_phone: phone,
                        change_password: 'yes',
                        customer_ex_password: ex_password,
                        customer_new_password: new_password
                    },
                    success: function (result) {
                        location.reload();
                    },
                    error: function (result) {
                        alert("Không thành công!");
                    }
                });
            }
        }

    });

</script>
@endsection
